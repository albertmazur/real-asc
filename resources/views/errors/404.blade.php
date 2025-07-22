@extends('errors::minimal')

@section('title', __('error.404'))
@section('code', '404')
@section('message', __('error.404_message'))
@if(auth()->check())
    Zalogowany jako: {{ auth()->user()->email }}
@else
    NIEzalogowany
@endif

Session ID: {{ session()->getId() }}