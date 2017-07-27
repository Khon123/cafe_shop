@extends('backpack::layout')

@section('after_styles')
    <style>

    </style>
@endsection
@section('header')
    <section class="content-header">
        <h1>{{ config('constant.product') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product') }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ config('constant.product') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">

                        {{-- ===========include modal========== --}}
                        <button class="btn btn-default" id="new-product">
                            {{ config('constant.new_product') }}
                        </button>


                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">{{ config('constant.id') }}</th>
                            <th class="text-center">{{ config('constant.category') }}</th>
                            <th class="text-center">{{ config('constant.product') }}</th>
                            <th class="text-center">{{ config('constant.price') }}</th>
                            <th class="text-center">{{ config('constant.status') }}</th>
                            <th class="text-center">{{ config('constant.action') }}</th>
                        </tr>
                        </thead>
                        <tbody id="product-table" name="product-table">

                        @foreach($products as $row)
                            <tr id="product{{$row->id}}">
                                <td class="text-center" id="col-id{{$row->id}}">{{ $row->id }}</td>
                                <td class="text-center">{{ $row->category->name }}</td>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->price }}</td>
                                <td class="text-center">{{ $row->status }}</td>
                                <td class="text-center">
                                    <button class="edit_data open-modal" id="edit-modal" value="{{$row->id}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
    @include('vendor.backpack.base.modal-product')
    @include('vendor.backpack.base.modal-category')
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('after_scripts')
    <script>

        var url = '{{ url('admin/product') }}';

//        ==================click add new product========
        $('#new-product').click(function () {
            $('#frmProduct').trigger('reset');
            $('#imageDisplay').attr('src', '');
            $('#save').text('{{ config('constant.save') }}');
            $('#modal-product').modal('show');
            $('#cat_id').val(0);
        });

//        ============click add new category=========
        $('#new-category').click(function (e) {
            e.preventDefault();
            $('#saveCategory').text('{{config('constant.save')}}');
            $('#modal-category').modal('show');
            $('#frmCategory').trigger('reset');
            $('#imageCategoryDisplay').attr('src', '');
        });

//        ==============click edit product==========
        $(document).on('click', '.open-modal', function () {
            var id = $(this).val();
            console.log(id);
            $('#save').val($(this).val());
            $('#save').text('{{ config('constant.update') }}');
            $.get(url+'/'+id, function (data) {
                $('#cat_id').val(data.cat_id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#imageDisplay').attr('src', '{{ asset('img/product') }}'+'/'+data.image);
                $('#status').val(data.status);
                console.log(data.image);
                $('#modal-product').modal('show');
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
                    }
                },
                error: function (data) {
                    console.log("Error:", data);
                }
            });
        });

//        ==========click edit category=======
        var urlCategory = '{{ url('admin/category') }}';
        $(document).on('click', '.edit_category', function () {
            var id = $(this).val();
            $('#saveCategory').val(id);

            $('#saveCategory').text('{{ config('constant.update') }}');

            $.get(urlCategory+'/'+id, function (data) {
                $('#name_category').val(data.name);
                $('#status_category').val(data.status);
                $('#imageCategoryDisplay').attr('src', '{{ asset('img/category') }}'+'/'+data.image);
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