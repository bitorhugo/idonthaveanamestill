@extends('layouts.masterAdmin')
@section('content')
    <div class="card">
        <div class="card-header">Add Card</div>
        <div class="card-body card-block">
            <form action="{{route('cards.store')}}" method="post" class="" enctype="multipart/form-data">
                @csrf

                @foreach(json_decode($card) as $key => $value)

                    <div class="row form-group">
                        <div class="col col-md-2">
                            <label class=" form-control-label">{{$key}}</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group">
                                <input type="text" name="{{$key}}" placeholder="{{$key}}" class="form-control">
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label class=" form-control-label">Images</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="input-group">
                            <input type="file" name="image[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
        </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
