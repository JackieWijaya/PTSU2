@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::user()->role == 'Manager' || Auth::user()->role == 'HRD')
        @include('dashboard.hrd')
    @else
        @include('dashboard.karyawan')
    @endif
@endsection
