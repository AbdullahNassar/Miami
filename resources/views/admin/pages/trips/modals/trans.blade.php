<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Your Translation</h4>
            </div>
            <form action="{{route('admin.dayCruiseTrip')}}" enctype="multipart/form-data" method="post" onsubmit="return false;">
                {!! csrf_field() !!}
                <input type="hidden" name="trip_id" id="tripId">
                <div class="modal-body">
                    <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-9">
                                <label class="col-md-3 control-label">Trip Name</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-circle" name="name" placeholder="Enter Trip Name">
                                </div>
                            </div>
                            <div class="form-group col-md-9 col-sm-6 ">
                                <label class="col-md-3 control-label">Language</label>
                                <div class="col-md-9 col-sm-6">
                                    <select class="form-control input-circle" name="lang">
                                        @foreach($languages as $language)
                                            <option value="{{$language->code}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-6 col-md-9">
                                <label class="col-md-3 control-label">Trip Description</label>
                                <div class="col-md-9 col-sm-6">
                                    <textarea class="form-control input-circle" name="desc" placeholder="Enter Trip Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-9 col-sm-6 ">
                                <label class="col-md-3 control-label">Keywords</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" name="keywords" class="form-control input-large input-circle" data-role="tagsinput">
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
