@extends('layouts.masterAdmin')

@section('desired_create_route')
    <button class="au-btn au-btn-icon au-btn--green au-btn--small"
            onclick="event.preventDefault();
        document.getElementById('additem-button').submit();">
        <i class="zmdi zmdi" href="{{route('users.create')}}">Add User</i>
    </button>
@endsection


@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.datatable')

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ADMIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="tr-shadow">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->isAdmin)
                                        <td>TRUE</td>
                                    @else
                                        <td>FALSE</td>
                                    @endif
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                                    onclick="event.preventDefault();
                                document.getElementById('show-form{{$user->id}}').submit();">

                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form{{$user->id}}').submit();">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="event.preventDefault();
                                document.getElementById('delete-form{{$user->id}}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                 <i class="zmdi zmdi-more"></i>
                                                 </button> -->
                                        </div>
                                    </td>
                                </tr>
                                <!-- add a slug to route to identify which user we want to alter -->
                                <form id="edit-form{{$user->id}}"
                                      action="{{ route('users.edit', ['user' => $user->id]) }}"
                                      method="GET" class="d-none">
                                    @csrf
                                </form>
                                <form id="delete-form{{$user->id}}" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                                <form id="show-form{{$user->id}}" action="{{ route('users.show', ['user' => $user->id]) }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                                <form id="additem-button" action="{{ route('users.create') }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                                
                            @endforeach
                        </tbody>
                    </table>

                    {{$users->links('pagination::bootstrap-4')}}

                </div>
            </div>
        </div>
    </section>

@endsection 
