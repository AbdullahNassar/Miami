<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>choose View</label>
    <div class="col-md-9 col-sm-6">
        <select class="form-control input-circle" id="view_id" name="view_id">
            @foreach($prices as $p)
                <option value="{{$p->view->id}}">{{$p->view->translated()->name}}</option>
            @endforeach
        </select>
    </div>
</div><!--End Form-group-->
<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>Number Of Days</label>
    <div class="col-md-9 col-sm-6">
        <select class="form-control input-circle" id="num_day" name="num_day">
            <option value="2">2 Day , 1 Night</option>
            <option value="3">3 Day , 2 Night</option>
            <option value="4">4 Day , 3 Night</option>
            <option value="5">5 Day , 4 Night</option>
            <option value="6">6 Day , 5 Night</option>
        </select>
    </div>
</div><!--End Form-group-->

<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>SGL</label>
    <div class="radio-item">
        <input class="form-control" type="number" name="sgl" id="single" value="0">
    </div>
</div><!--End Form-group-->

<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>DBL</label>
    <div class="radio-item">
        <input class="form-control" type="number" name="dbl" id="double" value="0">
    </div>
</div><!--End Form-group-->

<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>3rd</label>
    <div class="radio-item">
        <input class="form-control" type="number" name="third" id="three" value="0">
    </div>
</div><!--End Form-group-->

<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>4th</label>
    <div class="radio-item">
        <input class="form-control" type="number" name="fourth" id="four" value="0">
    </div>
</div><!--End Form-group-->

<div class="form-group col-md-3 col-sm-6 book-ui">
    <label>under 5 years</label>
    <div class="radio-item">
        <input class="form-control" type="number" name="under5" id="five" value="0">
    </div>
</div><!--End Form-group-->