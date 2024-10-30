<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $config = $this->config();
        return view('client.pages.account.index', compact('config'));
    }


    private function config()
    {
        return [
            'css' => [
                'client_asset/custom/css/account.css'
            ],
            'js' => [],
            'model' => 'user'
        ];
    }
}
