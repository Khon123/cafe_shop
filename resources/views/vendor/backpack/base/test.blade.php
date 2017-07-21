<?php

?>
@extends('backpack::layout')

@section('header')
    <section class="content-header">
        {{--<ol class="breadcrumb">--}}
        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>--}}
        {{--<li class="active">{{ trans('backpack::base.dashboard') }}</li>--}}
        {{--</ol>--}}
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-4">
                    <table class="table table-responsive">
                        <tr>
                            <th><b>Invoice</b></th>
                        </tr>
                        <tr>
                            <td>Detail</td>
                            <td>qty</td>
                            <td>price</td>
                            <td>total</td>
                            <td>cancel</td>
                        </tr>
                    </table>
                    <div class="row" style="margin-top: 450px;">
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <button class="btn btn-default">
                                    Save & Print Invoice
                                </button>
                            </div>
                            <div class="col-xs-6">
                                <label for="">Total...</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-8">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Categories</h3>
                            <div style="height: 150px; overflow: scroll">
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <h3>Products</h3>
                            <div style="height: 350px; overflow: scroll">
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                                <div class="col-xs-2">
                                    <a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>
                                    <span><h5>all</h5></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>

    </script>
@stop