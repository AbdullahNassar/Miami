<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add new Testmonial</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.addTestmonial')}}" enctype="multipart/form-data" method="post" >
                    {!! csrf_field() !!}

                    <div class="modal-body">
                        <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>Title:</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div><!-- End form-group-->
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>Content:</label>
                                    <textarea name="content" rows="4" id="content" class="form-control"></textarea>
                                </div><!-- End form-group-->
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>User Name:</label>
                                    <input type="text" name="name" id="title" class="form-control">
                                </div><!-- End form-group-->
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>User Address:</label>
                                    <input type="text" name="address" id="title" class="form-control">
                                </div><!-- End form-group-->
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>UserImage:</label>
                                    <input type="file" name="image" id="content" class="form-control">
                                </div><!-- End form-group-->
                                <div class="form-group col-sm-6 col-md-9">
                                    <label>Languages:</label>
                                    <select name="lang" class="form-control input-circle">
                                        <option selected disabled> -- Choose Languages !! -- </option>
                                        @foreach($languages as $lang)
                                            <option value="{{$lang->code}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End form-group-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="addBTN btn green input-circle">
                            Save
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>