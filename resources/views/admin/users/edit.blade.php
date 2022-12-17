@extends('layouts.masterAdmin')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>EDIT USER</strong>
        </div>
        <div class="card-body card-block">
            <form id="addUserForm" action="{{route('users.update', ['user' => $user])}}" method="post" class="">
                @csrf
                @method('patch')
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Name</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-name" name="name" placeholder="{{$user->name}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="email" id="hf-email" name="email" placeholder="{{$user->email}}" class="form-control">
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Password</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="password-confirm" class=" form-control-label">Confirm Password</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-isAdmin" class=" form-control-label">isAdmin</label>
                    </div>
                    <div class="col-12 col-md-5">
                        @if($user->isAdmin)
                            <input class="p-l-10" type="checkbox" id="idAdmin" name="isAdmin"  class="form-check-input" checked>
                        @else
                            <input class="p-l-10" type="checkbox" id="idAdmin" name="isAdmin"  class="form-check-input">
                        @endif
                    </div>
                </div>
                
            </form>
        </div>

        <div class="card-footer">
            <button form="addUserForm" type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button form="addUserForm" type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>

    </div>

@endsection
