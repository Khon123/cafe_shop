@extends('backpack::layout')

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

                        <button class="btn btn-default">
                            {{ config('constant.new_category') }}
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
                        <?php $id= 1; ?>
                        @foreach($products as $row)
                            <tr id="product{{$row->id}}">
                                <td class="text-center">{{ $id }}</td>
                                <td class="text-center">{{ $row->category->name }}</td>
                                <td class="text-center">{{ $row->name }}</td>
                                <td class="text-center">{{ $row->price }}</td>
                                <td class="text-center">{{ $row->status }}</td>
                                <td class="text-center">
                                    <button class="edit_data btn btn-info open-modal" id="edit-modal" value="{{$row->id}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                </td>
                            </tr>
                            <?php $id++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
    @include('vendor.backpack.base.modal-product')
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

//        ==============click edit product==========
        $(document).on('click', '.open-modal', function () {
            var id = $(this).val();
            $('#save').text('{{ config('constant.update') }}');


            $.get(url+'/'+id, function (data) {
                $('#cat_id').val(data.cat_id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#imageDisplay').attr('scr', 'img/');
                $('#modal-product').modal('show');
            });
        });

//        ================ save product===========

//        $('#save').click(function () {

            $('#frmProduct').submit(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                e.preventDefault();

                var state = $(this).text;
                var type = 'POST';
                var formData = new FormData(this);
                var myUrl = url;

                $.ajax({
                    url: myUrl,
                    type: type,
                    data: formData,
                    async: false,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log("Error:", data);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
//        });
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