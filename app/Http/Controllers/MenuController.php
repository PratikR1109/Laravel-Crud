<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index () {
        return "hello !";
    }

    public function show () {
        return "hello hi bye bye !";
    }   
}
