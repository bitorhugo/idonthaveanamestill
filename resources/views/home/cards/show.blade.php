@extends('layouts.masterApp')

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="card">

                        <img class="card-img-top" src={{asset("images/bg-title-01.jpg")}} alt="Card image cap">

                        <div class="card-body">
                            <h4 class="card-title mb-3">Description:</h4>

                            <p class="card-text">Product Description</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">

                    
                    <div class="card border border-secondary">
                        <div class="card-header">
                            <strong class="card-title">Product Name</strong>
                        </div>
                        <div class="card-body">

                            <div class="alert alert-warning" role="alert">
                                200$
                            </div>

                            <div class="alert alert-success" role="alert">
                                In stock
                            </div>
                            
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="event.preventDefault();
                                document.getElementById('purchase-form').submit();">
                                <i class="fa fa-star"></i>&nbsp; Buy Now
                            </button>

                            <button type="button" class="btn btn-outline-warning">
                                <i class="fas fa-shopping-basket"> Add to Cart</i>

                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="purchase-form"
              action="{{ route('checkout') }}"
              method="POST" class="d-none">
            @csrf
        </form>
    </section>
@endsection


