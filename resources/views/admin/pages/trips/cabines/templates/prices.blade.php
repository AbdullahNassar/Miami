	<input type="hidden" name="trip_id" value="{{$prices->trip_id}}">
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Single Person Price</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="single" placeholder="Single Price" value="{{$prices->single}}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Double Price</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="second" placeholder="Double Price" value="{{$prices->second}}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Third Price</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="third" placeholder="Third Price" value="{{$prices->third}}">
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Fourth Price</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" name="fourth" placeholder="Fourth Price" value="{{$prices->fourth}}">
	        </div>
	    </div>
    </div>
    <div class="row">
	    <div class="form-group col-md-12 col-sm-12">
			<label class="col-md-3 control-label">Less Than 5</label>
			<div class="col-md-9 col-sm-6">
			    <input type="text" class="form-control input-circle" 
			    name="less5" value="{{$prices->less5}}" >
			</div>
		</div>
	</div>