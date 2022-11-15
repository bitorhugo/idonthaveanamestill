@extends('layouts.masterAdmin')
@section('content')
    <div class="card">
        <div class="card-header">Edit Card</div>
        <div class="card-body card-block">
            <form action="{{route('cards.update', ['card' => $card])}}" method="post" class="">
                @csrf
                @method('patch')

                @foreach(json_decode($card) as $key => $value)
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                            </div>
                            <input type="text" id="username" name="{{$key}}" placeholder="{{$key}} : {{$value}}" class="form-control">
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

