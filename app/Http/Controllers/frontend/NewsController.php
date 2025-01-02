<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsController extends BaseController
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }

    /**
     * Display the news
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function news(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $limit = 10;

        try {
            $url = env('API_URL') . "new?limit={$limit}&page={$currentPage}";
            $response = $this->client->request('GET', $url);
            $newsResponse = json_decode($response->getBody());
            $news = $newsResponse->data;
            $paginate = $newsResponse->paginate;

            $moreNews = $this->fetchDataFromApi("new?limit=5");
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $news = [];
            $paginate = [
                'current_page' => 1,
                'total_page' => 1,
                'total_items' => 0,
                'items_per_page' => $limit
            ];
        }

        return view('frontend.news.news', compact('news', 'paginate', 'moreNews'));
    }

    /**
     * Display the details of a specific news item.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function newsDetail(string $slug)
    {
        try {
            $news = $this->fetchDataFromApi("new/slug/{$slug}");
            $moreNews = $this->fetchDataFromApi("new?limit=5");
            $newComment = $this->fetchDataFromApi("new/comment/{$slug}");
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $news = [];
            $moreNews = [];
            $newComment = [];
        }
        return view('frontend.news.new-detail', compact('news', 'moreNews', 'newComment'));
    }

    public function search(Request $request)
    {
        try {
            $news = $this->fetchDataFromApi("new/search/search_query={$request->search_query}");
            $moreNews = $this->fetchDataFromApi("new?limit=5");
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $news = [];
            $moreNews = [];
        }
        return view('frontend.news.search', compact('news', 'moreNews'));
    }
}
