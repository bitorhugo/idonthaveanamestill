@extends('layouts.masterApp')

@section('content')
    @include('partials.datatable')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-data2">
                        <tbody>
                            @foreach($cards as $card)

                                @foreach($card->getAttributes() as $key)
                                    <td> {{$key}}</td>
                                @endforeach
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Show"
                                                onclick="event.preventDefault();
                                document.getElementById('show-form{{$card['id']}}').submit();">

                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                    </div>
                                </tr>
                                <!-- add a slug to route to identify which card we want to alter -->
                                <form id="show-form{{$card->id}}" action="{{ route('cards.show', ['card' => $card['id']]) }}" method="GET" class="d-none">
                                    
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$cards->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
