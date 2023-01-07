@extends('layouts.masterAdmin')
@section('content')
    @include('partials.requestAlerts')
    
    <div class="card">
        <div class="card-header">
            <strong>ADD USER</strong>
        </div>
        <div class="card-body card-block">
            <form id="addUserForm" action="{{route('users.store')}}" method="post" class="" enctype="multipart/form-data">
                @csrf

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-username" class=" form-control-label">Name</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="text" id="hf-name" name="name" value="{{old('name')}}" placeholder="Enter Name..." class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label for="hf-email" class=" form-control-label">Email</label>
                    </div>
                    <div class="col-12 col-md-5">
                        <input type="email" id="hf-email" name="email" value="{{old('email')}}" placeholder="Enter Email..." class="form-control">
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
                        <input class="p-l-10" type="checkbox" id="idAdmin" name="isAdmin" value="1"  class="form-check-input" {{old('isAdmin') ? 'checked = checked' : ''}}>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                        <label class=" form-control-label">Profile Image</label>
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
