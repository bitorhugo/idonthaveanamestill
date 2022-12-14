@extends('layouts.masterAdmin')
@section('content')
    <div class="card">
        <div class="card-header">Edit Card</div>
        <div class="card-body card-block">

            <form action="{{route('users.update', ['user' => $user])}}" method="post" class="">
                @csrf
                @method('patch')


                <input type="text" id="name" name="name" placeholder="name : {{$user->name}}" class="form-control">
                <input type="text" id="email" name="email" placeholder="email : {{$user->email}}" class="form-control">
                <input type="text" id="isAdmin" name="isAdmin" placeholder="isAdmin : {{$user->isAdmin}}" class="form-control">
                
                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
