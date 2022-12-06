@extends('layouts.masterApp')

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="card">

                        <img class="card-img-top" src={{asset("images/bg-title-01.jpg")}} alt="Card image cap">

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

                            <div class="alert alert-warning" role="alert">
                                {{$card->price}} EUR
                            </div>

                            <div class="alert alert-success" role="alert">
                                In stock
                            </div>
                            
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
            <input type="hidden" value="1" name="quantity">
        </form>
        <form id="add-to-cart-form"
              action="{{ route('cart.store', ['cart' => $card]) }}"
              method="POST" class="d-none">
            @csrf
            <input type="hidden" value="{{ $card->id }}" name="id">
            <input type="hidden" value="{{ $card->name }}" name="name">
            <input type="hidden" value="{{ $card->price }}" name="price">
            <input type="hidden" value="1" name="quantity">
        </form>
    </section>
@endsection


