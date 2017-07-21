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
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Invoice</th>
                            <th colspan="4">Product</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Detail</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>cancel</th>
                                    </tr>
                                </table>
                            </td>
                            {{-- show product all--}}
                            <td colspan="4">
                                <div class="row" style="height: 160px; overflow: scroll;">
                                    <div class="col-md-12" >
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr >
                        {{-- show detail--}}
                        <tr>
                            <th colspan="4">Detail</th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row" style="height: 250px; overflow: scroll;">
                                    <div class="col-md-12" >
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                        <div class="col-md-3" >
                                            <a href="#"><img src="{{ asset('vendor/adminlte/') }}/bootstrap/images/1.jpg" class="img-responsive"></a>
                                            <span><h5>all</h5></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Save</th>
                                        <th>Total</th>
                                    </tr>
                                </table>
                            </th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>

    </script>
@stop


