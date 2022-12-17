@extends('layouts.masterAdmin')

@section('content')
    @include('partials.requestAlerts')
    <div class="card">
        <div class="card-header">Edit Card</div>
        <div class="card-body card-block">
            <form id="editCardForm" action="{{route('cards.update', ['card' => $card])}}" method="post" class="">
                @csrf
                @method('patch')
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Name</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-name" name="name" placeholder="{{$card->name}}" class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-email" class=" form-control-label">Description</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-description" name="description" placeholder="{{$card->description}}" class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-price" class=" form-control-label">Price</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="number" id="hf-price" name="price" placeholder="{{$card->price}}." class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-userdiscount" class=" form-control-label">Discount</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="number" id="hf-discount" discount="discount_amount" placeholder="{{$card->discount}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-userdiscount" class=" form-control-label">Quantity</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="number" id="hf-quantity" name="quantity" placeholder="{{$card->inventory->quantity}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-userdiscount" class=" form-control-label">Categories</label>
                    </div>

                    <div class="col col-md-9">
                        <div class="form-check-inline form-check">
                            @foreach($categories as $cat)
                                <label for="inline-checkbox1" class="form-check-label">
                                    @if($cardCategories->contains($cat))
                                        <input type="checkbox" id="category{{$cat->id}}" name="categories[]" value="{{$cat->id}}" class="form-check-input" checked>{{$cat->id}}
                                    @else
                                        <input type="checkbox" id="category{{$cat->id}}" name="categories[]" value="{{$cat->id}}" class="form-check-input">{{$cat->id}}
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label class=" form-control-label">Images</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="input-group">
                            <input type="file" name="image[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>                
                </div>

                <div class="card-footer">
                    <button form="editCardForm" type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button form="editCardForm" type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>                

            </form>
        </div>
    </div>
@endsection

