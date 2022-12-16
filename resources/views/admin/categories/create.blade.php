@extends('layouts.masterAdmin')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>ADD CATEGORY</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{route('categories.store')}}" method="post" class="">
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
                        <label for="hf-description" class=" form-control-label">Description</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="description" id="hf-description" name="description" placeholder="Enter Description..." class="form-control">
                    </div>
                </div>
                
            </form>
        </div>

        <div class="card-footer">
            <button form="addCategoryForm" type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button form="addCategoryForm" type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>

    </div>

@endsection
