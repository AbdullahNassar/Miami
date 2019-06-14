<input type="hidden" name="trip_id" value="{{$prices->id}}">
<div class="form-group col-md-6 col-sm-6 ">
    <label class="col-md-3 control-label">Price For Adult</label>
    <div class="col-md-9 col-sm-6">
        <input type="text" class="form-control input-circle" value="{{$prices->adult}}" name="adult" placeholder="Enter Price For Adult">
    </div>
</div>
<div class="form-group col-md-6 col-sm-6 ">
    <label class="col-md-3 control-label">Price For Children</label>
    <div class="col-md-9 col-sm-6">
        <input type="text" class="form-control input-circle" value="{{$prices->children}}" name="children" placeholder="Enter Price For Children">
    </div>
</div>