@extends('errors::minimal')

@section('title', $exception->getmessage())
@section('code', '404')
@section('message',$exception->getmessage())
