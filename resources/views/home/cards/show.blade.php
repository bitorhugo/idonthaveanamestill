@extends('layouts.masterApp')

@section('content')
    @include('partials.alert')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="card">

                        <img class="card-img-top" src="{{$card->getFirstMediaUrl()}}" alt="image">

                        <div class="card-body">
                            <p class="card-text">{{$card->description}}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    
                    <div class="card border border-secondary">
                        <div class="card-header">
                            <strong class="card-title">{{$card->name}}</strong>
                        </div>
                        <div class="card-body">

                            <div class="alert alert-primary" role="alert">
                                <strong>{{$card->price - ($card->price * $card->discount_amount)}}</strong><strong class="text-muted ml-2"><del>{{$card->price}}</del></strong>
                            </div>

                            @if($card->inventory->quantity >= 10)
                                <div class="alert alert-success" role="alert">
                                    <strong>Quantity: {{$card->inventory->quantity}}</strong>
                                    <span class="badge badge-pill badge-success">In Stock</span>
                                </div>
                            @elseif($card->inventory->quantity < 10 && $card->inventory->quantity > 0)
                                <div class="alert alert-warning" role="alert">
                                    <strong>Quantity: {{$card->inventory->quantity}}</strong>
                                    <span class="badge badge-pill badge-warning">Low Stock</span>
                                </div>
                                
                            @else
                                <div class="alert alert-danger" role="alert">
                                    <strong>Quantity: {{$card->inventory->quantity}}</strong>
                                    <span class="badge badge-pill badge-danger">No Stock</span>
                                </div>
                            @endif
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="event.preventDefault();
                                document.getElementById('purchase-form').submit();">
                                <i class="fa fa-star"></i>&nbsp; Buy Now
                            </button>

                            <button type="button" class="btn btn-outline-warning"
                                    onclick="event.preventDefault();
                                document.getElementById('add-to-cart-form').submit();">
                                <i class="fas fa-shopping-basket"> Add to Cart</i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="purchase-form"
              action="{{ route('payNow') }}"
              method="POST" class="d-none">
            @csrf
            <input type="hidden" value="{{ $card->id }}" name="id">
            <input type="hidden" value="{{ $card->name }}" name="name">
            <input type="hidden" value="{{ $card->price }}" name="price">
            <input type="hidden" value="{{ $card->discount_amount }}" name="discount">
            <input type="hidden" value="{{ $card->inventory->quantity }}" name="stock">
            <input type="hidden" value="1" name="quantity">
        </form>
        <form id="add-to-cart-form"
              action="{{ route('cart.store') }}"
              method="POST" class="d-none">
            @csrf
            <input type="hidden" value="{{ $card->id }}" name="id">
            <input type="hidden" value="{{ $card->name }}" name="name">
            <input type="hidden" value="{{ $card->price }}" name="price">
            <input type="hidden" value="{{ $card->inventory->quantity }}" name="stock">
            <input type="hidden" value="{{ $card->discount_amount }}" name="discount">
            <input type="hidden" value="1" name="quantity">
        </form>
    </section>
@endsection


