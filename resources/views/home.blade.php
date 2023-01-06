@extends('layouts.masterApp')

@section('content')
    @include('partials.alert')
    @include('partials.searchbar')
    @include('partials.showcase')
    @include('partials.recentCards')
    @include('partials.promoCatXCards')
    @include('partials.lowStockDiscountCards')
    @endsection
