<!-- Modal -->
<div class="modal fade" id="modal-product" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 505px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">{{ config('constant.product') }}</h2>
            </div>
            <div class="modal-body">
                {{--=============--}}
                <form class="form-horizontal" id="frmProduct" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="category" class="control-label col-xs-3">{{ config('constant.category') }}:</label>
                                <div class="col-xs-8">
                                    <div class="row">
                                        <div class="col-xs-10">
                                            <select name="cat_id" id="cat_id" class="form-control"><span><button class="btn btn-default">...</button></span>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" id="select_category{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <button class="btn btn-default" id="new-category">...</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label col-xs-3">{{ config('constant.product_name') }}:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label col-xs-3">{{ config('constant.price') }}:</label>
                                <div class="col-xs-9">
                                    <input type="number" class="form-control" name="price" id="price">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-xs-offset-3">
                                    <img class="form-control" id="imageDisplay" src="" alt="" style="width: 120px; height: 120px;"/>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label col-xs-3">{{ config('constant.image') }}:</label>
                                <div class="col-xs-9">
                                    <input type='file' onchange="readURL(this);" class="form-control" id="image" name="image"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="control-label col-xs-3">{{ config('constant.status') }}:</label>
                                <div class="col-xs-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="{{ config('constant.active') }}">{{ config('constant.active') }}</option>
                                        <option value="{{ config('constant.inactive') }}">{{ config('constant.inactive') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-4 col-xs-offset-3">
                                    <button class="btn btn-default" id="save" type="submit" value="0">{{ config('constant.save') }}</button>
                                    <button type="button" class="btn btn-default pull-right " data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                {{--=============--}}
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button class="btn btn-default" id="save" type="submit">{{ config('constant.save') }}</button>--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        </div>

    </div>
</div>
  