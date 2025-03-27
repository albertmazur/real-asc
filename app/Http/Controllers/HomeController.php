<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function changeLanguage($lang)
    {
        $user = Auth::user();
        if(Auth::check() && $user->language != $lang)
        {
            $user->language = $lang;
            $user->save();
        }
        session()->put('language', $lang);
        return back();
    }
}
