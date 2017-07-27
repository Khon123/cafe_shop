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
                                <table class="table table-responsive table-bordered" id="table-sold">

                                    <h4><a href="#">{{ config('constant.list') }}</a></h4>
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ config('constant.name') }}</th>
                                        <th class="text-center">{{ config('constant.quantity') }}</th>
                                        <th class="text-center">{{ config('constant.price') }}</th>
                                        <th class="text-center">{{ config('constant.total') }}</th>
                                        <th class="text-center"id="exclude">{{ config('constant.exclude') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product-sell">

                                    </tbody>

                                </table>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-xs-12">
                                        <div class="col-xs-6">
                                            <button class="btn btn-default" id="print-invoice">
                                                {{ config('constant.save_and_print_invoice') }}
                                            </button>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="total" id="total" placeholder="{{ config('constant.total_amount') }}" disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-8">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4><a href="javascript: void(0)" id="new-category">{{ config('constant.category') }}</a></h4>
                                        <div style="height: 150px; overflow: scroll" id="list-category">
                                            <div class="col-xs-2">
                                                <a href="#" id="allCategory"><img src="{{ asset('img/category') }}/all.jpg" class="img-responsive"></a>
                                                <span><h5 style="text-align: center">{{ config('constant.all') }}</h5></span>
                                            </div>
                                            @foreach($categories as $category)
                                                <div class="col-xs-2" id="categoryImage{{ $category->id }}">
                                                    <a href="#" class="imageCategory" id="{{ $category->id }}"><img src="{{ asset('img/category') }}/{{ $category->image }}" class="img-responsive"></a>
                                                    <span><h5 style="text-align: center" id="category_name{{ $category->id }}">{{ $category->name }}</h5></span>
                                                </div>
                                            @endforeach
                                            {{--<div class="col-xs-2">--}}
                                            {{--<a href="#"><img src="{{ asset('img/avatar') }}/avatar.png" class="img-responsive"></a>--}}
                                            {{--<span><h5>all</h5></span>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <h4><a href="javascript: void(0)" class="new-product" id="">{{ config('constant.all') }}</a></h4>
                                        <div style="height: 360px; overflow: scroll" id="product-list">
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
    @include('vendor.backpack.base.modal-product-dashboard')
    @include('vendor.backpack.base.modal-category')


    {{--invoice print--}}
    <div id='headerPrint' style="display: none;">
        <div style="width: 300px">
            <h3 style="text-align: center">Black Cafe</h3>
            <p>ផ្លូវ ២៧១, សង្កាត់ទឹកថ្លា <br>ក្រុងភ្នំពេញ <br>TEL: 098 370 873 <br>បេឡាករ: {{ $user}}<br>#{{ \Carbon\Carbon::now() }}
            </p>
            <hr>
        </div>

    </div>
    <div id="totalPrint" style="display: none">
        <div style="width: 300px">
            <hr>
            <label for=""><b>{{ config('constant.total_amount') }}:</b></label>
            <label for="" style="margin-left: 50px" id="total-amount-invoice"><b></b></label>
            <hr>
            <label for="">{{ config('constant.thanks') }}</label>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>

        var url = '{{ url('admin/dashboard') }}';
//        ==============add new product==========
        $(document).on('click', '.new-product', function () {

            var cat_id = $(this).attr('id');


            $('#frmProduct').trigger('reset');
            $('#imageDisplay').attr('src', '');
            $('#save').text('{{ config('constant.save') }}');
            $('#modal-product-dashboard').modal('show');
            $('#cat_id').val(cat_id);
        });


//    ==============click category =====
        $(document).on('click', '.imageCategory', function () {
       var cat_id = $(this).attr('id');

       $.get(url+'/'+cat_id, function (data) {

           $('.new-product').text($('#category_name'+ cat_id).text());

           var myNode = document.getElementById("product-list");

           while (myNode.firstChild) {
               myNode.removeChild(myNode.firstChild);
           }

           displayProduct(data);

       });

       $('.new-product').attr('id', cat_id);

    });

//    =============click edit product============
        $(document).on('click', '.edit_product', function () {
            var p_id = $(this).val();
            var urlEdit = '{{ url('admin/product') }}';
            $('#save').text('{{ config('constant.update') }}');
            $('#save').val(p_id);

            $.get(urlEdit+'/'+p_id, function (data) {
                console.log(data);
                $('#cat_id').val(data.cat_id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#imageDisplay').attr('src', '{{ asset('img/product').'/' }}'+data.image);
                $('#status').val(data.status);
            });


        });

//    click all category
        $('#allCategory').click(function (e) {
       e.preventDefault();
        $('.new-product').text('{{ config('constant.all') }}');
        $('#save').text('{{ config('constant.save') }}');

       $.get(url+'/'+'get/allProduct', function (data) {
           var myNode = document.getElementById("product-list");

           while (myNode.firstChild) {
               myNode.removeChild(myNode.firstChild);
           }

           displayProduct(data);

       });
    });

        //        ================ save product===========

        $('#frmProduct').submit(function (e) {
            var urlPost = '{{ url('admin/product') }}';
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
            var myUrl = urlPost ;
            if(state!='{{ config('constant.save') }}'){
                myUrl = myUrl+'/'+id;
            }

            $.ajax({
                url: myUrl,
                type: type,
                data: formData,
                async: false,
                success: function (data) {
                    if(state!='{{ config('constant.save') }}'){

                        var replace_row = '<tr id="product'+ data.id +'">';
                        replace_row+='<td class="text-center">'+ data.id +'</td>';
                        replace_row+='<td class="text-center">'+ $('#cat_id option:selected').text() +'</td>';
                        replace_row+='<td class="text-center">'+ data.name +'</td>';
                        replace_row+='<td class="text-center">'+ data.price +'</td>';
                        replace_row+='<td class="text-center">'+ data.status+'</td>';
                        replace_row+='<td class="text-center"> <button class="edit_product" id="edit-modal" value="'+ data.id +'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';
                        $('#product'+ id).replaceWith(replace_row);
                        $('#save').text('{{ config('constant.save') }}');
                    }else {
                        var new_row = '<tr id="product'+ data.id +'">';
                        new_row+='<td class="text-center">'+ data.id +'</td>';
                        new_row+='<td class="text-center">'+ $('#cat_id option:selected').text() +'</td>';
                        new_row+='<td class="text-center">'+ data.name +'</td>';
                        new_row+='<td class="text-center">'+ data.price +'</td>';
                        new_row+='<td class="text-center">'+ data.status+'</td>';
                        new_row+='<td class="text-center"> <button class="edit_product" id="edit-modal" value="'+ data.id +'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';
                        $('#product-table').append(new_row);
                    }

                    $('#imageDisplay').attr('src', '');
                    $('#frmProduct').trigger('reset');

                },
                error: function (data) {
                    console.log("Error:", data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

//============== click add category============
        $('#add-category').click(function (e) {
            e.preventDefault();
            $('#saveCategory').text('{{config('constant.save')}}');
            $('#modal-category').modal('show');
            $('#frmCategory').trigger('reset');
            $('#imageCategoryDisplay').attr('src', '');
        });


    // ===============function display product=============

        function displayProduct(data) {
            $.each(data, function (index, val) {
                var product = '<div class="col-xs-2"> <a href="javascript:void(0)" class="imageProduct" id="'+ val.id +'"><img src="{{ asset('img/product') }}/'+ val.image +'" class="img-responsive"></a> <span><h5 style="text-align: center">'+ val.name +'</h5></span> </div>';

                $('#product-list').append(product);
            });
        }


//        ====================modal category=========================

        //        ============click label category=========
        $('#new-category').click(function (e) {
            e.preventDefault();
            $('#saveCategory').text('{{config('constant.save')}}');
            $('#modal-category').modal('show');
            $('#frmCategory').trigger('reset');
            $('#imageCategoryDisplay').attr('src', '');
        });

        //==========click save category=========
        $('#frmCategory').submit(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            e.preventDefault();
            var id = $('#saveCategory').val();
            var state = $('#saveCategory').text();
            console.log(id);
            var type= 'POST';
            var formData = new FormData(this);
            var url = '{{ url('admin/category') }}';
            var myUrl = url;

            if(state!='{{ config('constant.save') }}'){
                myUrl = myUrl+'/'+id;
            }

            $.ajax({
                type: type,
                url: myUrl,
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(state!='{{ config('constant.update') }}'){
                        var new_row = '<tr id="category'+ data.id +'">';
                        new_row+='<td class="text-center">'+ data.id +'</td>';
                        new_row+='<td class="text-center">'+ data.name +'</td>';
                        new_row+='<td class="text-center">'+ data.status +'</td>';
                        new_row+='<td class="text-center"> <button class="edit_category" id="edit-modal" value="'+ data.id+'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';

                        $('#category-table').append(new_row);

                        var new_category = '<div class="col-xs-2"> <a href="#" class="imageCategory" id="'+ data.id +'"><img src="{{ asset('img/category') }}/'+ data.image +'" class="img-responsive"></a> <span><h5 style="text-align: center" id="category_name'+ data.id +'">'+ data.name +'</h5></span> </div>';

                        $('#list-category').append(new_category);

                        $('#frmCategory').trigger('reset');
                        $('#imageCategoryDisplay').attr('src', '');
                        var new_option = '<option value="'+ data.id +'">'+ data.name +'</option>'
                        $('#cat_id').append(new_option);
                    }else{
                        var replace_row = '<tr id="category'+ data.id +'">';
                        replace_row+='<td class="text-center">'+ data.id +'</td>';
                        replace_row+='<td class="text-center">'+ data.name +'</td>';
                        replace_row+='<td class="text-center">'+ data.status +'</td>';
                        replace_row+='<td class="text-center"> <button class="edit_category" id="edit-modal" value="'+ data.id+'"> <span class="glyphicon glyphicon-edit"></span> </button> </td> </tr>';

                        $('#category'+ id).replaceWith(replace_row);
                        $('#frmCategory').trigger('reset');
                        $('#imageCategoryDisplay').attr('src', '');
                        $('#saveCategory').text('{{ config('constant.save') }}');

                        var replace_category = '<option value="'+ data.id +'" id="select_category'+ data.id +'">'+ data.name+'</option>';
                        $('#select_category'+ id).replaceWith(replace_category);

                        var replace_categoryImage = '<div class="col-xs-2"> <a href="#" class="imageCategory" id="'+ data.id +'"><img src="{{ asset('img/category') }}/'+ data.image +'" class="img-responsive"></a> <span><h5 style="text-align: center" id="category_name'+ data.id +'">'+ data.name +'</h5></span> </div>';
                        $('#categoryImage'+ id).replaceWith(replace_categoryImage);
                    }
                },
                error: function (data) {
                    console.log("Error:", data);
                }
            });
        });

        //        ==========click edit category=======

        $(document).on('click', '.edit_category', function () {
            var urlCategory = '{{ url('admin/category') }}';

            var id = $(this).val();
            $('#saveCategory').val(id);

            $('#saveCategory').text('{{ config('constant.update') }}');

            $.get(urlCategory+'/'+id, function (data) {
                $('#name_category').val(data.name);
                $('#status_category').val(data.status);
                $('#imageCategoryDisplay').attr('src', '{{ asset('img/category') }}'+'/'+data.image);
            });
        });


//        ================================ about selling and print invoice=============================
        var products = new Array();
        var total_amount = 0;



        $(document).on('click', '.imageProduct', function () {
            var urlProduct = '{{ url('admin/product') }}';
            var id = $(this).attr('id');
            $('#exclude').show();

            $.get(urlProduct+'/'+id, function (data) {
                if(products.length!=0){
                    for( var i=0; i<products.length; i++){
                        if(data.id == products[i].id){

                            var qty = parseInt($('#col-qty'+ id).text());
                            qty+=1;

//                            products.qty = qty;
//                            console .log(products.qty);

                            var total = parseInt($('#col-total'+id).text());
                            total = total+data.price;

                            var col_qty = '<td class="text-center" id="col-qty'+ data.id +'">'+ qty +'</td>';
                            $('#col-qty'+ id).replaceWith(col_qty);

                            var col_total = '<td class="text-center" id="col-total'+ data.id +'">'+ total+'</td>';
                            $('#col-total'+ id).replaceWith(col_total);
                            total_amount +=data.price;
                            $('#total').val(total_amount+' ៛');
                            return;
                        }
                    }
                }

                var row_product_sell = '<tr id="product'+ data.id +'" class="products-sold">';
                row_product_sell+='<td class="text-center">'+ data.name +'</td>';
                row_product_sell+='<td class="text-center" id="col-qty'+ data.id +'">1</td>';
                row_product_sell+='<td class="text-center">'+ data.price+'</td>';
                row_product_sell+='<td class="text-center total" id="col-total'+ data.id +'">'+ data.price+'</td>';
                row_product_sell+='<td class="text-center"> <a href="#" class="clear" id="'+ data.id +'"><img src="{{ asset('icon/clear.png') }}" alt=""></a> </td> </tr>';

                $('#product-sell').append(row_product_sell);

                products.push(data);

                console.log(products);

                total_amount+=data.price;
                $('#total').val(total_amount+' ៛');

            });
        });

//        ==============click to clear product===============
        $(document).on('click', '.clear', function () {

            var id = $(this).attr('id');
            var total = parseInt($('#col-total'+id).text());

            total_amount -=total;
            $('#total').val(total_amount +' ៛');

            $('#product'+ id).remove();

            if(total_amount==0){
                $('#total').val('');
            }


            for(var i = 0; i < products.length; i++) {
                if(products[i].id == id) {
                    products.splice(i, 1);
                    break;
                }
            }
        });
//        ===============click print invoice=========
        $('#print-invoice').click(function () {
            var divToPrint=document.getElementById('table-sold');
            var divHeaderPrint = document.getElementById('headerPrint');
            var divTotalPrint = document.getElementById('totalPrint');

            $('#total-amount-invoice').text(total_amount+ ' ៛')

            $('#exclude').hide();
            $('#headerPrint').show();
            $('#totalPrint').show();


            var newWin=window.open('','Print-Window');

            newWin.document.open();

//            newWin.document.write('<html><body onload="window.print()">'+divToPrint.outerHTML+'</body></html>');
            newWin.document.write(divHeaderPrint.outerHTML+divToPrint.outerHTML+divTotalPrint.outerHTML);
            newWin.print();

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);



            $('.products-sold').remove();
            $('#total').val('');
            $('#headerPrint').hide();
            $('#totalPrint').hide();
            for(var i = 0; i < products.length; i++) {
                products.splice(i);
            }
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
@endsection






