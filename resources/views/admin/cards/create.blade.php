@extends('layouts.masterAdmin')


@section('content')
    <div class="card">
        <div class="card-header">Add Card</div>
        <div class="card-body card-block">
            <form action="{{route('cards.store')}}" method="post" class="">
                @csrf

                @foreach(json_decode($card) as $key => $value)
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                            </div>
                            <input type="text" id="username" name="{{$key}}" placeholder="{{$key}}" class="form-control">
                        </div>
                    </div>
                @endforeach

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
