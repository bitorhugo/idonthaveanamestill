@extends('layouts.masterAdmin')
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
                @foreach($cards as $card)
                    @foreach(array_keys($card) as $col)
                        <th>{{$col}}</th>
                        @endforeach
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr class="tr-shadow">
                <td>
                    <label class="au-checkbox">
                        <input type="checkbox">
                        <span class="au-checkmark"></span>
                    </label>
                </td>
                <td>Lori Lynch</td>
                <td>
                    <span class="block-email">lori@example.com</span>
                </td>
                <td class="desc">Samsung S8 Black</td>
                <td>2018-09-27 02:12</td>
                <td>
                    <span class="status--process">Processed</span>
                </td>
                <td>$679.00</td>
                <td>
                    <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                            <i class="zmdi zmdi-mail-send"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                            <i class="zmdi zmdi-more"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr class="spacer"></tr>
            <tr class="tr-shadow">
                <td>
                    <label class="au-checkbox">
                        <input type="checkbox">
                        <span class="au-checkmark"></span>
                    </label>
                </td>
                <td>Lori Lynch</td>
                <td>
                    <span class="block-email">john@example.com</span>
                </td>
                <td class="desc">iPhone X 64Gb Grey</td>
                <td>2018-09-29 05:57</td>
                <td>
                    <span class="status--process">Processed</span>
                </td>
                <td>$999.00</td>
                <td>
                    <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                            <i class="zmdi zmdi-mail-send"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                            <i class="zmdi zmdi-more"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr class="spacer"></tr>
            <tr class="tr-shadow">
                <td>
                    <label class="au-checkbox">
                        <input type="checkbox">
                        <span class="au-checkmark"></span>
                    </label>
                </td>
                <td>Lori Lynch</td>
                <td>
                    <span class="block-email">lyn@example.com</span>
                </td>
                <td class="desc">iPhone X 256Gb Black</td>
                <td>2018-09-25 19:03</td>
                <td>
                    <span class="status--denied">Denied</span>
                </td>
                <td>$1199.00</td>
                <td>
                    <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                            <i class="zmdi zmdi-mail-send"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                            <i class="zmdi zmdi-more"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr class="spacer"></tr>
            <tr class="tr-shadow">
                <td>
                    <label class="au-checkbox">
                        <input type="checkbox">
                        <span class="au-checkmark"></span>
                    </label>
                </td>
                <td>Lori Lynch</td>
                <td>
                    <span class="block-email">doe@example.com</span>
                </td>
                <td class="desc">Camera C430W 4k</td>
                <td>2018-09-24 19:10</td>
                <td>
                    <span class="status--process">Processed</span>
                </td>
                <td>$699.00</td>
                <td>
                    <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                            <i class="zmdi zmdi-mail-send"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                            <i class="zmdi zmdi-more"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table> 
@endsection
