@extends('layouts.masterApp')

@section('content')
    @include('partials.searchbar')
    @include('partials.filters')

    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-data2">
                        <tbody>
                            @foreach($cards as $card)
                                @if(Storage::disk('media')->exists('App/Models/Card/' . $card->id))
                                    <td>
                                        <img src="{{asset('storage/media/App/Models/Card/'.$card->id.'/conversion/0-thumb.jpg')}}" alt='image'>
                                    </td>
                                @else
                                    <td>
                                        <img src="{{asset('storage/baseImage.jpg')}}" alt='image'>
                                    </td>
                                @endif
                                

                                <td> {{$card->name }}</td>
                                <td> {{$card->description }}</td>
                                <td> {{$card->price }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Shonw"
                                                onclick="event.preventDefault();
                                document.getElementById('show-form{{$card['id']}}').submit();">

                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                    </div>
                                </tr>
                                <!-- add a slug to route to identify which card we want to alter -->
                                <form id="show-form{{$card->id}}" action="{{ route('search.show', ['search' => $card->id]) }}" method="GET" class="d-none">
                                    
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$cards->appends(['q' => $q, 'category' => $category, 'sort' => $sort])->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </section>
@endsection
