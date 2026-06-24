@extends('layouts.sidebar')

@section('content')

<h2>Dashboard Karyawan</h2>

<p>Selamat datang {{ auth()->user()->name }}</p>

@endsection