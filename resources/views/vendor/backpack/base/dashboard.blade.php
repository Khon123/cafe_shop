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
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">

                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <table class="table table-responsive table-bordered">

                                    <h4><a href="#">{{ config('constant.list') }}</a></h4>
                                    <thead>
                                    <tr>
                                        <th>{{ config('constant.name') }}</th>
                                        <th>{{ config('constant.quantity') }}</th>
                                        <th>{{ config('constant.price') }}</th>
                                        <th>{{ config('constant.total') }}</th>
                                        <th>{{ config('constant.exclude') }}</th>
                                    </tr>
                                    </thead>

                                </table>
                                <div class="row" style="margin-top: 450px;">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6">
                                            <button class="btn btn-default">
                                                {{ config('constant.save_and_print_invoice') }}
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
                                        <h4><a href="javascript: void(0)">{{ config('constant.category') }}</a></h4>
                                        <div style="height: 150px; overflow: scroll">
                                            <div class="col-xs-2">
                                                <a href=""><img src="{{ asset('img/category') }}/all.jpg" class="img-responsive"></a>
                                                <span><h5 style="text-align: center">{{ config('constant.all') }}</h5></span>
                                            </div>
                                            @foreach($categories as $category)
                                                <div class="col-xs-2">
                                                    <a href="#" class="imageCategory" id="{{ $category->id }}"><img src="{{ asset('img/category') }}/{{ $category->image }}" class="img-responsive"></a>
                                                    <span><h5 style="text-align: center">{{ $category->name }}</h5></span>
                                                </div>
                                            @endforeach
                                            {{--<div class="col-xs-2">--}}
                                            {{--<a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>--}}
                                            {{--<span><h5>all</h5></span>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <h4><a href="javascript: void(0)" id="new-product">{{ config('constant.product') }}</a></h4>
                                        <div style="height: 360px; overflow: scroll">
                                            @foreach($products as $product)
                                                <div class="col-xs-2">
                                                    <a href="javascript:void(0)" class="imageProduct" id="{{ $product->id }}"><img src="{{ asset('img/product') }}/{{ $product->image }}" class="img-responsive"></a>
                                                    <span><h5 style="text-align: center">{{ $product->name }}</h5></span>
                                                </div>
                                            @endforeach

                                            {{--<div class="col-xs-2">--}}
                                            {{--<a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>--}}
                                            {{--<span><h5>all</h5></span>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('vendor.backpack.base.modal-product')
    @include('vendor.backpack.base.modal-category')
@endsection

@section('after_scripts')
    <script>

        var url = '{{ url('admin/dashboard') }}';
//        ==============add new product==========
    $('#new-product').click(function () {
        $('#frmProduct').trigger('reset');
        $('#imageDisplay').attr('src', '');
        $('#save').text('{{ config('constant.save') }}');
        $('#modal-product').modal('show');
        $('#cat_id').val(0);
    });


//    ==============click category image=====
    $(document).on('click', '.imageCategory', function () {
       var cat_id = $(this).attr('id');

       $.get(url+'/'+cat_id, function (data) {

       });
    });
//        ================ save product===========
    $('#frmProduct').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        e.preventDefault();

        var id = $('#save').val();
        var state = $('#save').text();
        console.log(state);
        var type = 'POST';
        var formData = new FormData(this);
        console.log(formData);
        var myUrl = url;
        if(state!='{{ config('constant.save') }}'){
            myUrl = myUrl+'/'+id;
        }

        $.ajax({
            url: myUrl,
            type: type,
            data: formData,
            async: false,
            success: function (data) {
                console.log(data);
                if(state!='{{ config('constant.save') }}'){
                    var col_id = $('#col-id'+id).text();
                    var replace_row = '<tr id="product'+ data.id +'">';
                    replace_row+='<td class="text-center" id="col-id'+ data.id +'">'+ col_id +'</td>';
                    replace_row+='<td class="text-center">'+$('#cat_id option:selected').text()+'</td>';
                    replace_row+='<td class="text-center">'+ data.name +'</td>';
                    replace_row+='<td class="text-center">'+ data.price +'</td>';
                    replace_row+='<td class="text-center">'+ data.status +'</td>';
                    replace_row+='<td class="text-center"><button class="edit_data open-modal" id="edit-modal" value="'+ data.id +'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';

                    $('#product'+ id).replaceWith(replace_row);
                }else {
                    var new_row = '<tr id="product'+ data.id +'">';
                    new_row+='<td class="text-center" id="col-id'+ data.id +'">'+ data.id +'</td>';
                    new_row+='<td class="text-center">'+$('#cat_id option:selected').text()+'</td>';
                    new_row+='<td class="text-center">'+ data.name +'</td>';
                    new_row+='<td class="text-center">'+ data.price +'</td>';
                    new_row+='<td class="text-center">'+ data.status +'</td>';
                    new_row+='<td class="text-center"><button class="edit_data open-modal" id="edit-modal" value="'+ data.id +'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';

                    $('#product-table').append(new_row);
                }

                $('#modal-product').modal('hide');


            },
            error: function (data) {
                console.log("Error:", data);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    </script>


    {{--display image when choose image--}}
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageDisplay')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop