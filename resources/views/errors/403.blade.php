@extends('errors::minimal')

@section('title', __('error.403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'error.403_message'))
