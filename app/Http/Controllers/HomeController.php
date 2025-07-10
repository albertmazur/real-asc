<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Auth;
use Mail;

class HomeController extends Controller
{
    public function about(){
        return view('layout.about');
    }

    public function contact(){
        return view('layout.contact');
    }

    public function sendContact(ContactFormRequest $request)
    {
        $data = $request->validated();

        Mail::to(config('mail.from.address'))
            ->send(new ContactMail($data));

        return back()->with('success', __('app.contact.thanks'));
    }



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
