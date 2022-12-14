@extends('layouts.masterAdmin')
@section('content')

    <div class="card">
        <div class="card-header">
            <strong>ADD CARD</strong>
        </div>
        <div class="card-body card-block">
            <form id="addCardForm" action="{{route('cards.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Name</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-name" name="name" placeholder="Enter Name..." class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-email" class=" form-control-label">Description</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-description" name="description" placeholder="Enter Description..." class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-price" class=" form-control-label">Price</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="number" id="hf-price" name="price" placeholder="Enter Price..." class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-userdiscount" class=" form-control-label">Discount</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="number" id="hf-discount" discount="discount" placeholder="Enter Discount..." class="form-control">
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
            </form>                
        </div>
        <div class="card-footer">
            <button addCardForm="addCardForm" type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button addCardForm="addCardForm" type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>
    </div>
    
@endsection
