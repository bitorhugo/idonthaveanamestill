@extends('layouts.masterAdmin')

@section('desired_create_route')
    <button class="au-btn au-btn-icon au-btn--green au-btn--small"
            onclick="event.preventDefault();
        document.getElementById('additem-button').submit();">
        <i class="zmdi zmdi" href="{{route('users.create')}}">Add User</i>
    </button>
@endsection


@section('content')
    @include('partials.datatable')
    <table class="table table-data2">
        <thead>
            <tr>
                <th>
                    <label class="au-checkbox">
                        <input type="checkbox">
                        <span class="au-checkmark"></span>
                    </label>
                </th>
                <!-- get the first element and iter all cols -->
                @foreach($keys as $key)
                    <th>{{$key}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="tr-shadow">
                    <td>
                        <label class="au-checkbox">
                            <input type="checkbox">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>

                    @foreach(array_keys($user) as $key)
                        <td>{{$user[$key]}}</td>
                    @endforeach

                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                    onclick="event.preventDefault();
                                document.getElementById('show-form{{$user['id']}}').submit();">

                                <i class="zmdi zmdi-mail-send"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form{{$user['id']}}').submit();">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="event.preventDefault();
                                document.getElementById('delete-form{{$user['id']}}').submit();">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                 <i class="zmdi zmdi-more"></i>
                                 </button> -->
                        </div>
                    </td>
                </tr>
                <!-- add a slug to route to identify which user we want to alter -->
                <form id="edit-form{{$user['id']}}"
                      action="{{ route('user.edit', ['user' => $user['id']]) }}"
                      method="GET" class="d-none">
                    @csrf
                </form>
                <form id="delete-form{{$user['id']}}" action="{{ route('users.destroy', ['user' => $user['id']]) }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                <form id="show-form{{$user['id']}}" action="{{ route('users.show', ['user' => $user['id']]) }}" method="GET" class="d-none">
                    @csrf
                </form>
                <form id="additem-button" action="{{ route('users.create') }}" method="GET" class="d-none">
                    @csrf
                </form>
                
            @endforeach
        </tbody>
    </table>


@endsection 
