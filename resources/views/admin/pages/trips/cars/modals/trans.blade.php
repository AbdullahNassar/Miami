<div id="trans" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Your Translation</h4>
            </div>
            <form action="{{route('admin.cars.translate')}}" enctype="multipart/form-data trans" method="post" onsubmit="return false;">
                {!! csrf_field() !!}
                    <input type="hidden" id="hidden_id" name="trip_id" value="">
                    <input type="hidden" id="hidden_lang" name="lang" value="">
                <div class="modal-body">
                    <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-9 ">
                                <label class="col-md-3 control-label">Language</label>
                                <div class="col-md-9 col-sm-6">
                                    <select class="form-control input-circle select-lang" 
                                    name="lang">
                                        <option>--Select Language--</option>
                                        @foreach($languages as $lang)
                                          @if($lang->code != 'en')
                                            <option value="{{$lang->code}}">{{$lang->name}}
                                            </option>
                                           @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-9 ">
                                <label class="col-md-3 control-label">Trip Name</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-circle" name="name" value="">
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-9 ">
                                <label class="col-md-3 control-label">Trip Description</label>
                                <div class="col-md-9 col-sm-6">
                                    <textarea class="form-control input-circle" name="desc" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-6 ">
                                <label class="col-md-3 control-label">Keywords</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control input-large input-circle" data-role="tagsinput" name="keywords" 
                                    value=""> 
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

