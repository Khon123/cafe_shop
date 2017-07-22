<!-- Modal -->
<div class="modal fade" id="modal-category" role="dialog">
    <div class="modal-dialog" style="width: 800px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">{{ config('constant.category') }}</h2>
            </div>
            <div class="modal-body">
                {{--=============--}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-6" style="border-right: 1px solid #616161">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>{{ config('constant.id') }}</th>
                                    <th>{{ config('constant.name') }}</th>
                                    <th>{{ config('constant.status') }}</th>
                                    <th>{{ config('constant.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="height: 400px; overflow: scroll">

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-6">
                            <form class="form form-horizontal" id="frmCategory" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name" class="control-label col-xs-3">{{ config('constant.name') }}</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-xs-offset-3">
                                        <img class="form-control" id="imageCategoryDisplay" src="" alt="" style="width: 120px; height: 120px;"/>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label col-xs-3">{{ config('constant.image') }}:</label>
                                    <div class="col-xs-9">
                                        <input type='file' onchange="readURLImageCategory(this);" class="form-control" id="image" name="image"/>
                                    </div>
                                    <script>
                                        function readURLImageCategory(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function (e) {
                                                    $('#imageCategoryDisplay')
                                                        .attr('src', e.target.result)
                                                        .width(100)
                                                        .height(100);
                                                };

                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="control-label col-xs-3">{{ config('constant.status') }}:</label>
                                    <div class="col-xs-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active">{{ config('constant.active') }}</option>
                                            <option value="Inactive">{{ config('constant.inactive') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-4 col-xs-offset-3">
                                        <button class="btn btn-default" id="save" type="submit" value="0">{{ config('constant.save') }}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{--=============--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right " data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
