@extends('layouts.masterAdmin')
@section('content')
    <div class="users">
        <div class="users-header">Add Users</div>
        <div class="users-body users-block">
            <form action="{{route('users.store')}}" method="post" class="">
                @csrf

                @foreach(json_decode($user) as $key => $value)
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                            </div>
                            <input type="text" id="usersname" name="{{$key}}" placeholder="{{$key}}" class="form-control">
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
