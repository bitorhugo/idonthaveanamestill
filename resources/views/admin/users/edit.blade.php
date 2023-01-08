@extends('layouts.masterAdmin')
@section('content')
    @include('partials.requestAlerts')
    <div class="card">
        <div class="card-header">
            <strong>EDIT USER</strong>
        </div>
        <div class="card-body card-block">
            <form id="addUserForm" action="{{route('users.update', ['user' => $user])}}" method="post" class="" enctype="multipart/form-data">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-isAdmin" class=" form-control-label">isAdmin</label>
                    </div>
                    <div class="col col-md-9">
                        <div class="form-check-inline form-check">
                            <label for="inline-radio1" class="form-check-label p-r-5">
                                <input type="radio" id="inline-radio1" name="isAdmin" value="1" class="form-check-input" {{$user->isAdmin ? 'checked' : ''}}>TRUE
                            </label>
                            <label for="inline-radio2" class="form-check-label ">
                                <input type="radio" id="inline-radio2" name="isAdmin" value="0" class="form-check-input" {{$user->isAdmin ? '' : 'checked'}}>FALSE
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-2">
                        <label class=" form-control-label">Profile Picture</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="input-group">
                            <input type="file" name="image" class="form-control">
                        </div>
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
