@extends('admin.layouts._layout')

@section('content')

Добро пожаловать в админку {{ Auth::user()->name }}

@stop