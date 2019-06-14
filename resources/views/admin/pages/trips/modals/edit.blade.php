<div id="edit" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit trip price</h4>
            </div>
            <form action="{{route('editTripPrice')}}" enctype="multipart/form-data" method="post" onsubmit="return false;">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="tripPriceId">
                <div class="modal-body">
                    <div class="scroller" style="height: 250px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 date-time ">
                                <label class="col-md-3 control-label">Edit Type</label>
                                <div class="col-md-9 col-sm-9">
                                    <div class="radio-item">
                                        <input type="radio" name="priceType" id="day" value="day">
                                        <label class="radio radio-inline" for="day">
                                            For One Day
                                        </label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="priceType" id="year" value="year">
                                        <label class="radio radio-inline" for="year">
                                            For Year
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-9 col-sm-6 date-time ">
                                <label class="col-md-3 control-label">Date</label>
                                <div class="col-md-9 col-sm-6">
                                    <input data-token="{!! csrf_token() !!}" class="form-control form-control-inline input-circle input-medium date-picker" id="datePricker" name="date" type="text" >
                                </div>
                            </div>
                            
                            <div id="Price-template">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline input-circle">Close</button>
                    <button type="button" class="btn green input-circle addBTN">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

