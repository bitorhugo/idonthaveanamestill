@extends('layouts.masterAdmin')
@section('desired_create_route')
    <button class="au-btn au-btn-icon au-btn--green au-btn--small"
            onclick="event.preventDefault();
        document.getElementById('additem-button').submit();">
        <i class="zmdi zmdi" href="{{route('categories.create')}}">Add category</i>
    </button>
@endsection


@section('content')
    @include('partials.adminSearchBar')
    @include('partials.datatable')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="tr-shadow">
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>

                                    <td>
                                        <div class="table-data-feature">
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('edit-form{{$category->id}}').submit();">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="event.preventDefault();
                                document.getElementById('delete-form{{$category->id}}').submit();">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                 <i class="zmdi zmdi-more"></i>
                                                 </button> -->
                                        </div>
                                    </td>
                                </tr>
                                <!-- add a slug to route to identify which category we want to alter -->
                                <form id="edit-form{{$category->id}}"
                                      action="{{ route('categories.edit', ['category' => $category->id]) }}"
                                      method="GET" class="d-none">
                                </form>
                                <form id="delete-form{{$category->id}}" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                                <form id="show-form{{$category->id}}" action="{{ route('categories.show', ['category' => $category->id]) }}" method="GET" class="d-none">
                                </form>
                                <form id="additem-button" action="{{ route('categories.create') }}" method="GET" class="d-none">
                                </form>

                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </section>
@endsection 
