<?php

namespace App\Http\Controllers\BacKend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BacKendController extends Controller
{
    function dashboard(){
        return view("bend.dashboard");
    }
}