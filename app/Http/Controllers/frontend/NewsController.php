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
    public function news()
    {
        try {
            $news = $this->fetchDataFromApi("new");
            $moreNews = $this->fetchDataFromApi("new?limit=5");
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $news = [];
            $moreNews = [];
        }
        return view('frontend.news.news', compact('news', 'moreNews'));
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
            $comments= [];
        }
        return view('frontend.news.new-detail', compact('news', 'moreNews','newComment'));
    }




}
