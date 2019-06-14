<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add new Slider</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.slider.add')}}" enctype="multipart/form-data" method="post" >
                    {!! csrf_field() !!}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Video:</label>
                            <input type="file" name="image_name" id="image" class="form-control">
                        </div><!-- End form-group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-circle addBTN">
                            Save <span class="glyphicon glyphicon-save"> </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>