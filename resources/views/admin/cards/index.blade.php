@extends('layouts.masterAdmin')

@section('desired_create_route')
    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
        <a class="zmdi zmdi-plus" href="{{route('cards.create')}}">Add item </a>
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
            @foreach($cards as $card)
                <tr class="tr-shadow">
                    <td>
                        <label class="au-checkbox">
                            <input type="checkbox">
                            <span class="au-checkmark"></span>
                        </label>
                    </td>

                    @foreach(array_keys($card) as $key)
                        <td>{{$card[$key]}}</td>
                    @endforeach

                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                    onclick="event.preventDefault();
                                document.getElementById('show-form{{$card['id']}}').submit();">

                                <i class="zmdi zmdi-mail-send"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form{{$card['id']}}').submit();">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                    onclick="event.preventDefault();
                                document.getElementById('delete-form{{$card['id']}}').submit();">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                 <i class="zmdi zmdi-more"></i>
                                 </button> -->
                        </div>
                    </td>
                </tr>
                <!-- add a slug to route to identify which card we want to alter -->
                <form id="edit-form{{$card['id']}}" action="{{ route('cards.edit', ['card' => $card['id']]) }}" method="GET" class="d-none">
                    @csrf
                </form>
                <form id="delete-form{{$card['id']}}" action="{{ route('cards.destroy', ['card' => $card['id']]) }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                <form id="show-form{{$card['id']}}" action="{{ route('cards.show', ['card' => $card['id']]) }}" method="GET" class="d-none">
                    @csrf
                </form>

            @endforeach
        </tbody>
    </table>


@endsection 
