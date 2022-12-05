@extends('layouts.masterApp')

@section('content')

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>descritpion</th>
                                    <th>price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <td> {{$item->name}}</td>
                                    <td> {{$item->description}}</td>
                                    <td> {{$item->price}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                                    onclick="event.preventDefault();
                                document.getElementById('show-form{{$item['id']}}').submit();">

                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                        </div>
                                </tr>
                                <!-- add a slug to route to identify which item we want to alter -->
                                <form id="show-form{{$item->id}}" action="{{ route('search.show', ['search' => $item->id]) }}"
                                      method="GET" class="d-none">
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--white">
                        <span class="desc">Total</span>
                        <h2 class="number">{{$subTotal}}</h2>
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
@endsection
