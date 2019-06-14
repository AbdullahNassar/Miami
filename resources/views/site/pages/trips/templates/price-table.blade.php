@if($car_price != null)
    @if($trip->trip_id == $car_price->trip_id)
        <table class="table-rate">
            <thead>
            <tr>
                @if($car_price->e_price !=NULL)
                    <th>Economy Price </th>
                @else
                    <th>Exotic Price </th>
                    <th>Tax </th>
                    <th>Insurance </th>
                    <th>Deposit </th>
                @endif
            </tr>
            </thead>
            <tbody>
            <tr>
                @if($car_price->e_price !=NULL)
                    <td>
                       $ {{$car_price->e_price}} 
                    </td>
                @else
                    <td>
                       $ {{$car_price->b_price}} 
                    </td>
                    <td>
                       $ {{$car_price->tax}} 
                    </td>
                    <td>
                       $ {{$car_price->insurance}} 
                    </td>
                    <td>
                      $  {{$car_price->deposit}} 
                    </td>
                @endif
            </tr>

            </tbody>
        </table>
    @endif
@elseif($cabine_price != null)
    @if($trip->trip_id == $cabine_price->trip_id)
        <table class="table-rate">
            <thead>
            <tr>
                <th>Single </th>
                <th>Double </th>
                <th>Third </th>
                <th>Fourth  </th>
                <th>Childern Under Than 5 Years</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                  $  {{$cabine_price->single}} 
                </td>
                <td>
                   $ {{$cabine_price->second}} 
                </td>
                <td>
                  $  {{$cabine_price->third}} 
                </td>
                <td>
                  $  {{$cabine_price->fourth}} 
                </td>
                <td>
                   $  {{$cabine_price->less5}}
                </td>
            </tr>
            </tbody>
        </table>
    @endif
@elseif($day_price != null)
    @if($trip->trip_id == $day_price->trip_id)
        @if($day_price->e_adult != null)
            <div class="cruises-capin">
                <div class="item-title">
                    <h4 class="title"> type :</h4>
                </div>
                <div class="item-cont">
                    <div class="type">
                        <div class="propety">
                            Economy
                        </div>
                        <div class="value">
                            ${{$day_price->e_adult}}
                        </div>
                    </div>
                    <div class="type">
                        <div class="propety">
                            business
                        </div>
                        <div class="value">
                            ${{$day_price->b_adult}}
                        </div>

                    </div>
                </div>
            </div><!--End Cruises-Capin-->
        @elseif($day_price->e_after != null)
            <div class="cruises-capin">
                <div class="item-title">
                    <h4 class="title"> type :</h4>
                </div>
                <div class="item-cont">
                    <div class="type">
                        <div class="propety">
                            Economy
                        </div>
                        <div class="value">
                            ${{$day_price->e_after}}
                        </div>
                    </div>
                    <div class="type">
                        <div class="propety">
                            business
                        </div>
                        <div class="value">
                            ${{$day_price->b_after}}
                        </div>

                    </div>
                </div>
            </div><!--End Cruises-Capin-->
        @endif
        <table class="table-rate">
            <thead>
            <tr>
                @if($day_price->e_adult != null)
                    <th class="island-view-lbl">Economy Adult </th>
                    <th class="island-view-lbl">Economy Child </th>
                    <th class="island-view-lbl">Economy Infants</th>
                    <th class="ocean-breess-suits-lbl">Business Adult </th>
                    <th class="ocean-breess-suits-lbl">Business Child </th>
                    <th class="ocean-breess-suits-lbl">Business Infants </th>
                @elseif($day_price->e_after != null)

                    <th class="island-view-lbl">Economy Under 5 years </th>
                    <th class="island-view-lbl">Economy Adult </th>
                    <th class="ocean-breess-suits-lbl">Business Under 5 years </th>
                    <th class="ocean-breess-suits-lbl">Business Adult </th>
                @endif
            </tr>
            </thead>
            <tbody>
            <tr>
                @if($day_price->e_adult != null)
                    <td>
                      $  {{$day_price->e_adult}} 
                    </td>
                    <td>
                      $  {{$day_price->e_children}} 
                    </td>
                    <td>
                      $  {{$day_price->e_infants}} 
                    </td>
                    <td>
                      $  {{$day_price->b_adult}} 
                    </td>
                    <td>
                      $  {{$day_price->b_children}} 
                    </td>
                    <td>
                      $  {{$day_price->b_infants}} 
                    </td>
                @elseif($day_price->e_after != null)
                    <td>
                      $  {{$day_price->e_before}} 
                    </td>
                    <td>
                      $  {{$day_price->e_after}} 
                    </td>
                    <td>
                      $  {{$day_price->b_before}} 
                    </td>
                    <td>
                      $  {{$day_price->b_after}} 
                    </td>
                @endif
            </tr>
            </tbody>
        </table>
    @endif
@elseif($tour_price != null)
    @if($trip->trip_id == $tour_price->trip_id)
        <div class="cruises-capin">
            <div class="item-title">
                <h4 class="title">type :</h4>
            </div>
            <div class="item-cont">
                <div class="type">
                    <div class="propety">
                        Adult
                    </div>
                    <div class="value">
                        $ {{$tour_price->adult}}
                    </div>
                </div>
                <div class="type">
                    <div class="propety">
                        Children
                    </div>
                    <div class="value">
                        $ {{$tour_price->children}}
                    </div>

                </div>
            </div>
        </div><!--End Cruises-Capin-->
        <table class="table-rate">
            <thead>
            <tr>
                <th>Price For Adult </th>
                <th>Price For Child </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                  $  {{$tour_price->adult}} 
                </td>
                <td>
                  $  {{$tour_price->children}} 
                </td>
            </tr>
            </tbody>
        </table>
    @endif
@elseif($hotel_price != null && $hotel_price!='[]')
    <div class="table-responsive">
        <table class="table-rate table-hotel">
            <thead>
           <tr>
                <th style="background-color: #fd0" colspan="5">2 Day , 1 Night </th>
                <th colspan="5">3 Day , 2 Night </th>
                <th style="background-color: #fd0" colspan="5">4 Day , 3 Night</th>
                <th colspan="5">5 Day , 4 Night </th>
                <th style="background-color: #fd0" colspan="5">6 Day , 5 Night </th>
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
            @foreach($hotel_price as $price)
                <tr class="{{$price->view->view_style}}" id="num{{$price->view_id}}">
                    <td>{{$price->single2day}}</td>
                    <td>{{$price->double2day}}</td>
                    <td>{{$price->third2day}}</td>
                    <td>{{$price->fourth2day}}</td>
                    <td>{{$price->less5_2day}}</td>
                    <td>{{$price->single3day}}</td>
                    <td>{{$price->double3day}}</td>
                    <td>{{$price->third3day}}</td>
                    <td>{{$price->fourth3day}}</td>
                    <td>{{$price->less5_3day}}</td>
                    <td>{{$price->single4day}}</td>
                    <td>{{$price->double4day}}</td>
                    <td>{{$price->third4day}}</td>
                    <td>{{$price->fourth4day}}</td>
                    <td>{{$price->less5_4day}}</td>
                    <td>{{$price->single5day}}</td>
                    <td>{{$price->double5day}}</td>
                    <td>{{$price->third5day}}</td>
                    <td>{{$price->fourth5day}}</td>
                    <td>{{$price->less5_5day}}</td>
                    <td>{{$price->single6day}}</td>
                    <td>{{$price->double6day}}</td>
                    <td>{{$price->third6day}}</td>
                    <td>{{$price->fourth6day}}</td>
                    <td>{{$price->less5_6day}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-foot">
        @foreach($hotel_price as $p)
            <div class="view-lbl {{$p->view->view_style}}-lbl">
                {{$p->view->translated()->name}}
            </div>
        @endforeach
    </div><!--End Table-foot-->
@else
    <div class="alert-block alert alert-info">
        This trip does not work today
    </div>
@endif