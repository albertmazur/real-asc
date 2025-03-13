<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function changeLanguage($lang)
    {
        session(['locale' => $lang]);
        return back();
    }
}
