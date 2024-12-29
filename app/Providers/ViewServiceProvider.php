<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Kiểm tra người dùng
            if (Session::has('user') && Session::get('user') !== null) {
                $userId = Session::get('user')->id;
            } else {
                $userId = 0;
            }

            $checkCompany=0;
            if ($userId !== 0) {
                $client = new \GuzzleHttp\Client();
                $apiUrlCheckCompanyByUser = env('API_URL') . "checkCompany/" . $userId;

                $response = $client->get($apiUrlCheckCompanyByUser);


                $result = json_decode($response->getBody(), true);


                if (isset($result['status']) && $result['status'] === 1) {
                    $checkCompany = 1;
                }

            }
            // Địa chỉ API
            $apiUrlCategory = env('API_URL') . "getAllCategory";
            $apiUrlCompanyByUser = env('API_URL') . "company/" . $userId;


            // Lấy dữ liệu từ cache, nếu không có thì gọi API
            $category = cache()->remember('category_data', now()->addMinutes(30), function () use ($apiUrlCategory) {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', $apiUrlCategory);
                $data = json_decode($response->getBody()->getContents());
                return $data->data ?? [];
            });

            $company_id = 0;
            if ($userId !== 0 && $checkCompany==1) {
                $company_id = cache()->remember('company_data_' . $userId, now()->addMinutes(30), function () use ($apiUrlCompanyByUser) {
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('GET', $apiUrlCompanyByUser);
                    $data = json_decode($response->getBody()->getContents());
                    return $data->data->id ?? 0;
                });
            }

            // Chia sẻ dữ liệu với view
            $view->with('category', $category)
                 ->with('company_id', $company_id);
        });
    }
}
