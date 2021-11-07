<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = Http::get(config('app.api_url') . 'recent-searches');

        return view('home')->with('searches', $response->json());
    }

    public function search($title)
    {
        $response = Http::get(config('app.api_url') . 'search?find=' . rawurlencode($title));
        $response2 = Http::get(config('app.api_url') . 'recent-searches');

        if(!$response->json()['status'] || empty($response->json()['data'])){
            return view('home', ['error' => 'Sorry, The item is not available.', 'searches' => $response2->json()]);
        } else {
            return view('home', [ 'data' => $response->json() , 'searches' => $response2->json()]);
        }
    }

    
    public function search2($data)
    {
        try {
            $data = Crypt::decryptString($data);
        } catch (DecryptException $e) {
            abort(404);
        }
        $response = Http::get(config('app.api_url') . 'search?title=' . rawurlencode($data));

        if(!$response->json()['status']){
            return view('show', ['error' => 'Sorry, The item\'s information is not available.']);
        } else {
            return view('show')->with( 'data', $response->json());
        }
    }
}
