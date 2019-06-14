	<input type="hidden" name="trip_id" value="{{$prices->trip_id}}">
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Business Price</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="b_price" placeholder=" Price" value="{{$prices->b_price}}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Tax </label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="tax" 
			    placeholder="Tax Price" value="{{$prices->tax}}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Insurance</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="insurance" placeholder="Insurance Price" value="{{$prices->insurance}}">
			</div>
		</div>
	</div>
    <div class="row">
	    <div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Deposit</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" 
			    name="deposit" value="{{$prices->deposit}}" >
			</div>
		</div>
	</div>