@extends('layouts.masterAdmin')
@section('content')
    @include('partials.requestAlerts')
    <div class="card">
        <div class="card-header">
            <strong>EDIT CATEGORY</strong>
        </div>
        <div class="card-body card-block">
            <form id="editCategoryForm" action="{{route('categories.update', ['category' => $category])}}" method="post" class="">
                @csrf
                @method('patch')

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Name</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-name" name="name" placeholder="{{$category->name}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-description" class=" form-control-label">Description</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="description" id="hf-description" name="description" placeholder="{{$category->description}}" class="form-control">
                    </div>
                </div>
                
            </form>
        </div>

        <div class="card-footer">
            <button form="editCategoryForm" type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button form="editCategoryForm" type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>

    </div>

@endsection

