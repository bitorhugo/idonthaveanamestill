@extends('layouts.masterAdmin')

@section('content')
    @include('partials.alert')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="card">

                        @if(Storage::disk('media')->exists('App/Models/Card/' . $card->id))
                            <img src="{{asset('storage/media/App/Models/Card/'.$card->id.'/conversion/0-thumb.jpg')}}" alt='image'>
                        @else
                            <img src="{{asset('storage/baseImage.jpg')}}" alt='image'>
                        @endif

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

                            <div class="alert alert-info" role="alert">
                                <strong>
                                    @foreach($categories as $cat)
                                        {{$cat->name}}
                                    @endforeach
                                </strong>
                            </div>

                            <div class="alert alert-primary" role="alert">
                                @if($card->discount_amount > 0)
                                    <strong>{{$card->price - ($card->price * $card->discount_amount)}}</strong>
                                    <strong class="text-muted ml-2">
                                        <del>{{$card->price}}</del>
                                    </strong>
                                    EUR
                                @else 
                                    <strong>{{$card->price}}</strong>
                                    EUR
                                @endif
                            </div>

                            @if($card->inventory->quantity >= 25)
                                <div class="alert alert-success" role="alert">
                                    <strong>Quantity: {{$card->inventory->quantity}}</strong>
                                    <span class="badge badge-pill badge-success">In Stock</span>
                                </div>
                            @elseif($card->inventory->quantity < 25 && $card->inventory->quantity > 0)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



