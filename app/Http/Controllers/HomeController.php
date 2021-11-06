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
        return view('home');
    }

    public function search(Request $request)
    {
        $response = Http::get(config('app.api_url') . 'search?find=' . rawurlencode($request->title));

        if(!$response->json()['status'] || empty($response->json()['data'])){
            return view('home')->with('error', 'The item is not available.');
        } else {
            return view('home')->with( 'data', $response->json());
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
            return view('home')->with('error', 'The item\'s information is not available.');
        } else {
            return view('show')->with( 'data', $response->json());
        }
    }
}
