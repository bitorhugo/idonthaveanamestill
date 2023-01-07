@extends('layouts.masterAdmin')
@section('content')
    <div class="col-md-4">
        <aside class="profile-nav alt">
            <section class="card">
                <div class="card-header user-header alt bg-dark">
                    <div class="media">
                        <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/icon/avatar-01.jpg">
                        </a>
                        <div class="media-body">
                            <h2 class="text-light display-6">{{$user->name}}</h2>
                            @if($user->isAdmin)
                                <p>Admin User</p>
                            @else
                                <p>Basic User</p>
                            @endif
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p>ID: {{$user->id}}</p>
                    </li>
                    <li class="list-group-item">
                        <p>Email: {{$user->email}}</p>
                    </li>
                    <li class="list-group-item">
                        <p>Verified at: {{$user->email_verified_at}}</p>
                    </li>
                </ul>
            </section>
        </aside>
    </div>
@endsection
