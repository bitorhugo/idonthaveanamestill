@extends('layouts.masterApp')

@section('content')
    @include('partials.alert')
    
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr class="tr-shadow">
                                        <td>{{$item->name}}</td>
                                        <td>
                                            {{$item->getPriceSumWithConditions()}}€</br>
                                            @if($item->model->discount_amount > 0)
                                                <span class="badge badge-dark">{{$item->conditions->getValue()}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="col col-sm-3">
                                                <input name="qty" type="number" min="1" placeholder="{{$item->quantity}}" class="form-control" form="updateQty-form{{$item->id}}">
                                                <span class="badge badge-info">
                                                    <a href="" style="color:white; text-decoration:none;"
                                                       onclick="event.preventDefault();
        document.getElementById('updateQty-form{{$item->id}}').submit();">
                                                        Update</a></span>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
                                                        onclick="event.preventDefault();
        document.getElementById('show-form{{$item->id}}').submit();">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </button>

                                                <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                        onclick="event.preventDefault();
        document.getElementById('delete-form{{$item->id}}').submit();">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <form id="updateQty-form{{$item->id}}" action="{{route('cart.update', ['cart' => $item->id])}}" method="post" class="">
                                        @csrf
                                        @method('patch')
                                    </form>
                                    <form id="show-form{{$item->id}}" action="{{ route('search.show', ['search' => $item->id]) }}" method="GET" class="d-none">
                                    </form>
                                    <form id="delete-form{{$item->id}}" action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--white">
                        <span class="desc">Total</span>
                        <h3 class="number" style="color:#0d6efd">{{$subTotal}}€</h3>
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="p-t-20">
                            <button type="button" class="btn btn-warning"
                                    onclick="event.preventDefault();
        document.getElementById('checkout-form').submit();">
                                <i class="fa fa-magic"></i>&nbsp; Checkout</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <form id="checkout-form"
          action="{{ route('checkout') }}"
          method="POST" class="d-none">
        @csrf
        <!-- <input type="hidden" value="Cart" name="name">
             <input type="hidden" value="{{ $subTotal }}" name="price">
             <input type="hidden" value="1" name="quantity">
             <input type="hidden" value="{{$cart}}" name="cart"> -->
    </form>
    
@endsection
