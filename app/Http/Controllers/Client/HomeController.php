<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return "trang chu";

    }
    public function about(){
        return 'gioi thieu';

    }
    public function contact(){
        return 'lien he';
    }
}
