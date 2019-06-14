<div class="col-md-12">
    <div class="table-responsive">
        <table class="table-rate table-hotel">
            <thead>
            <tr>
                <th colspan="5">2 Day , 1 Night </th>
                <th colspan="5">3 Day , 2 Night </th>
                <th colspan="5">4 Day , 3 Night</th>
                <th colspan="5">5 Day , 4 Night </th>
                <th colspan="5">6 Day , 5 Night </th>
            </tr>
            </thead>
            <tbody id="insert-view-price">
            <tr>
                <td>
                    SGL
                </td>
                <td>
                    DBL
                </td>
                <td>
                    third
                </td>
                <td>
                    fourth
                </td>
                <td>
                    Under 5 Years
                </td>

                <td>
                    SGL
                </td>
                <td>
                    DBL
                </td>
                <td>
                    third
                </td>
                <td>
                    fourth
                </td>
                <td>
                    Under 5 Years
                </td>

                <td>
                    SGL
                </td>
                <td>
                    DBL
                </td>
                <td>
                    third
                </td>
                <td>
                    fourth
                </td>
                <td>
                    Under 5 Years
                </td>

                <td>
                    SGL
                </td>
                <td>
                    DBL
                </td>
                <td>
                    third
                </td>
                <td>
                    fourth
                </td>
                <td>
                    Under 5 Years
                </td>

                <td>
                    SGL
                </td>
                <td>
                    DBL
                </td>
                <td>
                    third
                </td>
                <td>
                    fourth
                </td>
                <td>
                   Under 5 Years
                </td>
            </tr><!--End tr of SGL & DBL & Child-->
            @foreach($prices as $price)
            <tr class="{{$price->view->view_style}}" id="num{{$price->view_id}}">
                <input type="hidden" value="{{$price->view_id}}" name="view_id[]">
                <td>
                    <input type="text" name="single2day[]" value="{{$price->single2day}}" />
                </td>
                <td>
                    <input type="text" name="double2day[]" value="{{$price->double2day}}" />
                </td>
                <td>
                    <input type="text" name="third2day[]" value="{{$price->third2day}}" />
                </td>
                <td>
                    <input type="text" name="fourth2day[]" value="{{$price->fourth2day}}" />
                </td>
                <td>
                    <input type="text" name="less5_2day[]" value="{{$price->less5_2day}}" />
                </td>
                <td>
                    <input type="text" name="single3day[]" value="{{$price->single3day}}" />
                </td>
                <td>
                    <input type="text" name="double3day[]" value="{{$price->double3day}}" />
                </td>
                <td>
                    <input type="text" name="third3day[]" value="{{$price->third3day}}" />
                </td>
                <td>
                    <input type="text" name="fourth3day[]" value="{{$price->fourth3day}}" />
                </td>
                <td>
                    <input type="text" name="less5_3day[]" value="{{$price->less5_3day}}" />
                </td>
                <td>
                    <input type="text" name="single4day[]" value="{{$price->single4day}}" />
                </td>
                <td>
                    <input type="text" name="double4day[]" value="{{$price->double4day}}" />
                </td>
                <td>
                    <input type="text" name="third4day[]" value="{{$price->third4day}}" />
                </td>
                <td>
                    <input type="text" name="fourth4day[]" value="{{$price->fourth4day}}" />
                </td>
                <td>
                    <input type="text" name="less5_4day[]" value="{{$price->less5_4day}}" />
                </td>

                <td>
                    <input type="text" name="single5day[]" value="{{$price->single5day}}" />
                </td>
                <td>
                    <input type="text" name="double5day[]" value="{{$price->double5day}}" />
                </td>
                <td>
                    <input type="text" name="third5day[]" value="{{$price->third5day}}" />
                </td>
                <td>
                    <input type="text" name="fourth5day[]" value="{{$price->fourth5day}}" />
                </td>

                <td>
                    <input type="text" name="less5_5day[]" value="{{$price->less5_5day}}" />
                </td>
                <td>
                    <input type="text" name="single6day[]" value="{{$price->single6day}}" />
                </td>
                <td>
                    <input type="text" name="double6day[]" value="{{$price->double6day}}" />
                </td>
                <td>
                    <input type="text" name="third6day[]" value="{{$price->third6day}}" />
                </td>
                <td>
                    <input type="text" name="fourth6day[]" value="{{$price->fourth6day}}" />
                </td>
                <td>
                    <input type="text" name="less5_6day[]" value="{{$price->less5_6day}}" />
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-foot">
        @foreach($prices as $p)
            <div class="view-lbl {{$p->view->view_style}}-lbl">
                {{$p->view->translated()->name}}
            </div>
        @endforeach
    </div><!--End Table-foot-->
</div>