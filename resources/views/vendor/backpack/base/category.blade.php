<?php

?>
@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>{{ config('constant.category') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/category') }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ config('constant.category') }}</li>
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
                            <th class="text-center">{{ config('constant.status') }}</th>
                            <th class="text-center">{{ config('constant.action') }}</th>
                        </tr>
                        </thead>
                        <tbody id="category-table" name="category-table">
                        <?php $id= 1; ?>
                        @foreach($categories as $row)
                            <tr id="category{{$row->id}}">
                                <td class="text-center">{{ $id }}</td>
                                <td class="text-center">{{ $row->name }}</td>
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
                    {{ $categories->links() }}

                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('after_scripts')
    <script>

    </script>
@stop