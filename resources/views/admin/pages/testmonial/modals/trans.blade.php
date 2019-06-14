<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Your Testmonial</h4>
            </div>
            <form action="{{route('admin.transTestmonial')}}" enctype="multipart/form-data trans" method="post" onsubmit="return false;">
                {!! csrf_field() !!}
                <input type="hidden" name="testmonial_id" id="hidden_id">
                <div class="modal-body">
                    <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-circle" name="title" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">Content</label>
                                <div class="col-md-9 col-sm-6">
                                    <textarea class="form-control input-circle" name="content" placeholder="Enter Content"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">User Name</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-circle" name="name" placeholder="Enter User Name">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">User Address</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-circle" name="address" placeholder="Enter User Address">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 ">
                                <label class="col-md-3 control-label">Language</label>
                                <div class="col-md-9 col-sm-6">
                                    <select name="lang" class="form-control input-circle">
                                        <option selected disabled> -- Choose Languages !! -- </option>
                                        @foreach($languages as $lang)
                                            <option value="{{$lang->code}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline input-circle">Close</button>
                    <button type="button" class="btn green input-circle addBTN">Save Translation</button>
                </div>
            </form>
        </div>
    </div>
</div>

