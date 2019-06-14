<div class="item-cont">
    <div class="item-cont-head">
        <h5>{{$data->username}}</h5>
        <ul class="rating">
            @for($i=0;$i< 5;$i++)
                <li @if($i <$data->rate) class="active" @endif>
                    <i class="fa fa-star"></i>
                </li>
            @endfor
        </ul>
    </div>
    <div class="item-cont-body">
        <p>
            {{$data->comment}}
        </p>
    </div>
</div><!--End Item-cont-->