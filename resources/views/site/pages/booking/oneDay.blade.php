@extends('site.layouts.master')
@section('title')
    Book now
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->
    <div class="page-content">
    <section class="booking-cruises has-background section-lg">
        <div class="container">
            @if(session()->has('msgDone'))
                <div class="alert alert-success">
                    {{ session()->get('msgDone') }}
                </div>
            @endif
            @if(session()->has('msgCancel'))
                <div class="alert alert-danger">
                    {{ session()->get('msgCancel') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="white-box-title">
                            <h3 class="title">Booking Form Wizard</h3>
                        </div><!--End white-box-title-->
                        <div id="form_wizard_1">
                         <form class="booking-form" id="submit_form" action="{{route('site.payment')}}" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$x}}" id="type">
                            <input type="hidden" name="slug" value="{{$slug}}" id="slug">

                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> initial info
                                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number"> 2 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Profile Setup
                                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                <span class="number"> 3 </span>
                                                <span class="desc">
                                                                        <i class="fa fa-check"></i> Billing Setup </span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-primary"> </div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                                        </div>

                                        <div class="tab-pane active" id="tab1">
                                            <div class="white-box-title">
                                                <h4 class="title">Booking Information</h4>
                                            </div><!--End White-box-title-->
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Sail Date</label>
                                                    <input data-token="{!! csrf_token() !!}" class="form-control datetimepicker" data-msg-required="Please enter the sail date" type="text" id="dateTime" name="date">
                                                </div><!--End Form-group-->
                                                @if($trip->cat_id == 3)
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Return Date</label>
                                                    <input data-token="{!! csrf_token() !!}" class="form-control datetimepicker" data-msg-required="Please enter the sail date" type="text">
                                                </div><!--End Form-group-->
                                                @endif
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Total Price</label>
                                                    <input class="form-control alert-success" value="0" disabled="disabled" id="total_price">
                                                </div><!--End Form-group-->

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Type</label>
                                                    <div class="radio-item">
                                                        <input type="radio" name="bookType" checked id="Economy" value="economy">
                                                        <label class="radio radio-inline" for="Economy">
                                                            Economy
                                                        </label>
                                                    </div>
                                                    <div class="radio-item">
                                                        <input type="radio" name="bookType" id="business" value="business">
                                                        <label class="radio radio-inline" for="business">
                                                            business
                                                        </label>
                                                    </div>
                                                </div><!--End Form-group-->
                                                <div id="date-type"></div>

                                            </div><!--End Row-->
                                        </div><!--End tab-pane-->

                                        <div class="tab-pane fullForm" id="tab2">
                                            <div id="form">
                                                <div class="white-box-title">
                                                    <h4 class="title">Provide passenger details</h4>
                                                </div><!--End White-box-title-->
                                                <div class="row" id="fullInputs">

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>first name</label>
                                                        <input class="form-control" type="text" name="f_name[]" data-msg-required="please enter your first name">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>last name</label>
                                                        <input class="form-control" type="text" name="l_name[]" data-msg-required="please enter your last name">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>phone number</label>
                                                        <input class="form-control" type="text" name="phone[]">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>Birth Date</label>
                                                        <input class="form-control datetimepicker" type="text" name="b_date[]" data-msg-required="please enter your birth day">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6 book-ui">
                                                        <label>country of citizenship</label>
                                                        <select class="menu-select" name="country[]">
                                                            <option value="AF">Afghanistan</option>
                                                            <option value="AX">Åland Islands</option>
                                                            <option value="AL">Albania</option>
                                                            <option value="DZ">Algeria</option>
                                                            <option value="AS">American Samoa</option>
                                                            <option value="AD">Andorra</option>
                                                            <option value="AO">Angola</option>
                                                            <option value="AI">Anguilla</option>
                                                            <option value="AQ">Antarctica</option>
                                                            <option value="AG">Antigua and Barbuda</option>
                                                            <option value="AR">Argentina</option>
                                                            <option value="AM">Armenia</option>
                                                            <option value="AW">Aruba</option>
                                                            <option value="AU">Australia</option>
                                                            <option value="AT">Austria</option>
                                                            <option value="AZ">Azerbaijan</option>
                                                            <option value="BS">Bahamas</option>
                                                            <option value="BH">Bahrain</option>
                                                            <option value="BD">Bangladesh</option>
                                                            <option value="BB">Barbados</option>
                                                            <option value="BY">Belarus</option>
                                                            <option value="BE">Belgium</option>
                                                            <option value="BZ">Belize</option>
                                                            <option value="BJ">Benin</option>
                                                            <option value="BM">Bermuda</option>
                                                            <option value="BT">Bhutan</option>
                                                            <option value="BO">Bolivia, Plurinational State of</option>
                                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="BA">Bosnia and Herzegovina</option>
                                                            <option value="BW">Botswana</option>
                                                            <option value="BV">Bouvet Island</option>
                                                            <option value="BR">Brazil</option>
                                                            <option value="IO">British Indian Ocean Territory</option>
                                                            <option value="BN">Brunei Darussalam</option>
                                                            <option value="BG">Bulgaria</option>
                                                            <option value="BF">Burkina Faso</option>
                                                            <option value="BI">Burundi</option>
                                                            <option value="KH">Cambodia</option>
                                                            <option value="CM">Cameroon</option>
                                                            <option value="CA">Canada</option>
                                                            <option value="CV">Cape Verde</option>
                                                            <option value="KY">Cayman Islands</option>
                                                            <option value="CF">Central African Republic</option>
                                                            <option value="TD">Chad</option>
                                                            <option value="CL">Chile</option>
                                                            <option value="CN">China</option>
                                                            <option value="CX">Christmas Island</option>
                                                            <option value="CC">Cocos (Keeling) Islands</option>
                                                            <option value="CO">Colombia</option>
                                                            <option value="KM">Comoros</option>
                                                            <option value="CG">Congo</option>
                                                            <option value="CD">Congo, the Democratic Republic of the</option>
                                                            <option value="CK">Cook Islands</option>
                                                            <option value="CR">Costa Rica</option>
                                                            <option value="CI">Côte dIvoire</option>
                                                            <option value="HR">Croatia</option>
                                                            <option value="CU">Cuba</option>
                                                            <option value="CW">Curaçao</option>
                                                            <option value="CY">Cyprus</option>
                                                            <option value="CZ">Czech Republic</option>
                                                            <option value="DK">Denmark</option>
                                                            <option value="DJ">Djibouti</option>
                                                            <option value="DM">Dominica</option>
                                                            <option value="DO">Dominican Republic</option>
                                                            <option value="EC">Ecuador</option>
                                                            <option value="EG">Egypt</option>
                                                            <option value="SV">El Salvador</option>
                                                            <option value="GQ">Equatorial Guinea</option>
                                                            <option value="ER">Eritrea</option>
                                                            <option value="EE">Estonia</option>
                                                            <option value="ET">Ethiopia</option>
                                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                                            <option value="FO">Faroe Islands</option>
                                                            <option value="FJ">Fiji</option>
                                                            <option value="FI">Finland</option>
                                                            <option value="FR">France</option>
                                                            <option value="GF">French Guiana</option>
                                                            <option value="PF">French Polynesia</option>
                                                            <option value="TF">French Southern Territories</option>
                                                            <option value="GA">Gabon</option>
                                                            <option value="GM">Gambia</option>
                                                            <option value="GE">Georgia</option>
                                                            <option value="DE">Germany</option>
                                                            <option value="GH">Ghana</option>
                                                            <option value="GI">Gibraltar</option>
                                                            <option value="GR">Greece</option>
                                                            <option value="GL">Greenland</option>
                                                            <option value="GD">Grenada</option>
                                                            <option value="GP">Guadeloupe</option>
                                                            <option value="GU">Guam</option>
                                                            <option value="GT">Guatemala</option>
                                                            <option value="GG">Guernsey</option>
                                                            <option value="GN">Guinea</option>
                                                            <option value="GW">Guinea-Bissau</option>
                                                            <option value="GY">Guyana</option>
                                                            <option value="HT">Haiti</option>
                                                            <option value="HM">Heard Island and McDonald Islands</option>
                                                            <option value="VA">Holy See (Vatican City State)</option>
                                                            <option value="HN">Honduras</option>
                                                            <option value="HK">Hong Kong</option>
                                                            <option value="HU">Hungary</option>
                                                            <option value="IS">Iceland</option>
                                                            <option value="IN">India</option>
                                                            <option value="ID">Indonesia</option>
                                                            <option value="IR">Iran, Islamic Republic of</option>
                                                            <option value="IQ">Iraq</option>
                                                            <option value="IE">Ireland</option>
                                                            <option value="IM">Isle of Man</option>
                                                            <option value="IL">Israel</option>
                                                            <option value="IT">Italy</option>
                                                            <option value="JM">Jamaica</option>
                                                            <option value="JP">Japan</option>
                                                            <option value="JE">Jersey</option>
                                                            <option value="JO">Jordan</option>
                                                            <option value="KZ">Kazakhstan</option>
                                                            <option value="KE">Kenya</option>
                                                            <option value="KI">Kiribati</option>
                                                            <option value="KP">Korea, Democratic Peoples Republic of</option>
                                                            <option value="KR">Korea, Republic of</option>
                                                            <option value="KW">Kuwait</option>
                                                            <option value="KG">Kyrgyzstan</option>
                                                            <option value="LA">Lao Peoples Democratic Republic</option>
                                                            <option value="LV">Latvia</option>
                                                            <option value="LB">Lebanon</option>
                                                            <option value="LS">Lesotho</option>
                                                            <option value="LR">Liberia</option>
                                                            <option value="LY">Libya</option>
                                                            <option value="LI">Liechtenstein</option>
                                                            <option value="LT">Lithuania</option>
                                                            <option value="LU">Luxembourg</option>
                                                            <option value="MO">Macao</option>
                                                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                            <option value="MG">Madagascar</option>
                                                            <option value="MW">Malawi</option>
                                                            <option value="MY">Malaysia</option>
                                                            <option value="MV">Maldives</option>
                                                            <option value="ML">Mali</option>
                                                            <option value="MT">Malta</option>
                                                            <option value="MH">Marshall Islands</option>
                                                            <option value="MQ">Martinique</option>
                                                            <option value="MR">Mauritania</option>
                                                            <option value="MU">Mauritius</option>
                                                            <option value="YT">Mayotte</option>
                                                            <option value="MX">Mexico</option>
                                                            <option value="FM">Micronesia, Federated States of</option>
                                                            <option value="MD">Moldova, Republic of</option>
                                                            <option value="MC">Monaco</option>
                                                            <option value="MN">Mongolia</option>
                                                            <option value="ME">Montenegro</option>
                                                            <option value="MS">Montserrat</option>
                                                            <option value="MA">Morocco</option>
                                                            <option value="MZ">Mozambique</option>
                                                            <option value="MM">Myanmar</option>
                                                            <option value="NA">Namibia</option>
                                                            <option value="NR">Nauru</option>
                                                            <option value="NP">Nepal</option>
                                                            <option value="NL">Netherlands</option>
                                                            <option value="NC">New Caledonia</option>
                                                            <option value="NZ">New Zealand</option>
                                                            <option value="NI">Nicaragua</option>
                                                            <option value="NE">Niger</option>
                                                            <option value="NG">Nigeria</option>
                                                            <option value="NU">Niue</option>
                                                            <option value="NF">Norfolk Island</option>
                                                            <option value="MP">Northern Mariana Islands</option>
                                                            <option value="NO">Norway</option>
                                                            <option value="OM">Oman</option>
                                                            <option value="PK">Pakistan</option>
                                                            <option value="PW">Palau</option>
                                                            <option value="PS">Palestinian Territory, Occupied</option>
                                                            <option value="PA">Panama</option>
                                                            <option value="PG">Papua New Guinea</option>
                                                            <option value="PY">Paraguay</option>
                                                            <option value="PE">Peru</option>
                                                            <option value="PH">Philippines</option>
                                                            <option value="PN">Pitcairn</option>
                                                            <option value="PL">Poland</option>
                                                            <option value="PT">Portugal</option>
                                                            <option value="PR">Puerto Rico</option>
                                                            <option value="QA">Qatar</option>
                                                            <option value="RE">Réunion</option>
                                                            <option value="RO">Romania</option>
                                                            <option value="RU">Russian Federation</option>
                                                            <option value="RW">Rwanda</option>
                                                            <option value="BL">Saint Barthélemy</option>
                                                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                            <option value="KN">Saint Kitts and Nevis</option>
                                                            <option value="LC">Saint Lucia</option>
                                                            <option value="MF">Saint Martin (French part)</option>
                                                            <option value="PM">Saint Pierre and Miquelon</option>
                                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                                            <option value="WS">Samoa</option>
                                                            <option value="SM">San Marino</option>
                                                            <option value="ST">Sao Tome and Principe</option>
                                                            <option value="SA">Saudi Arabia</option>
                                                            <option value="SN">Senegal</option>
                                                            <option value="RS">Serbia</option>
                                                            <option value="SC">Seychelles</option>
                                                            <option value="SL">Sierra Leone</option>
                                                            <option value="SG">Singapore</option>
                                                            <option value="SX">Sint Maarten (Dutch part)</option>
                                                            <option value="SK">Slovakia</option>
                                                            <option value="SI">Slovenia</option>
                                                            <option value="SB">Solomon Islands</option>
                                                            <option value="SO">Somalia</option>
                                                            <option value="ZA">South Africa</option>
                                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                            <option value="SS">South Sudan</option>
                                                            <option value="ES">Spain</option>
                                                            <option value="LK">Sri Lanka</option>
                                                            <option value="SD">Sudan</option>
                                                            <option value="SR">Suriname</option>
                                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                                            <option value="SZ">Swaziland</option>
                                                            <option value="SE">Sweden</option>
                                                            <option value="CH">Switzerland</option>
                                                            <option value="SY">Syrian Arab Republic</option>
                                                            <option value="TW">Taiwan, Province of China</option>
                                                            <option value="TJ">Tajikistan</option>
                                                            <option value="TZ">Tanzania, United Republic of</option>
                                                            <option value="TH">Thailand</option>
                                                            <option value="TL">Timor-Leste</option>
                                                            <option value="TG">Togo</option>
                                                            <option value="TK">Tokelau</option>
                                                            <option value="TO">Tonga</option>
                                                            <option value="TT">Trinidad and Tobago</option>
                                                            <option value="TN">Tunisia</option>
                                                            <option value="TR">Turkey</option>
                                                            <option value="TM">Turkmenistan</option>
                                                            <option value="TC">Turks and Caicos Islands</option>
                                                            <option value="TV">Tuvalu</option>
                                                            <option value="UG">Uganda</option>
                                                            <option value="UA">Ukraine</option>
                                                            <option value="AE">United Arab Emirates</option>
                                                            <option value="GB">United Kingdom</option>
                                                            <option value="US">United States</option>
                                                            <option value="UM">United States Minor Outlying Islands</option>
                                                            <option value="UY">Uruguay</option>
                                                            <option value="UZ">Uzbekistan</option>
                                                            <option value="VU">Vanuatu</option>
                                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                            <option value="VN">Viet Nam</option>
                                                            <option value="VG">Virgin Islands, British</option>
                                                            <option value="VI">Virgin Islands, U.S.</option>
                                                            <option value="WF">Wallis and Futuna</option>
                                                            <option value="EH">Western Sahara</option>
                                                            <option value="YE">Yemen</option>
                                                            <option value="ZM">Zambia</option>
                                                            <option value="ZW">Zimbabwe</option>
                                                        </select>
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>gender</label>
                                                        <div class="radio-item">
                                                            <input type="radio" name="gender[]" id="male" checked value="male">
                                                            <label class="radio radio-inline" for="male">
                                                                male
                                                            </label>
                                                        </div>
                                                        <div class="radio-item">
                                                            <input type="radio" name="gender[]" id="female" value="female">
                                                            <label class="radio radio-inline" for="female">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>email address</label>
                                                        <input class="form-control" type="email" name="email[]" >
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>address</label>
                                                        <input class="form-control" type="text" name="address[]" data-msg-required="please enter your address">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>city</label>
                                                        <input class="form-control" type="text" name="city[]" data-msg-required="please enter your city">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>passport number</label>
                                                        <input class="form-control" type="text" name="passport[]" data-msg-required="please enter your passport">
                                                    </div><!--End Form-group-->

                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label>Passport Expiration Date</label>
                                                        <input class="form-control datetimepicker" type="text" name="pass_expire[]" data-msg-required="please enter your passport expire date">
                                                    </div><!--End Form-group-->

                                                </div><!--End Row-->
                                            </div>
                                        </div><!--End tabpanel-->

                                        <div class="tab-pane" id="tab3">
                                            <div class="white-box-title">
                                                <h4 class="title">Transportation Information</h4>
                                            </div><!--End White-box-title-->
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Include Transportation (Optional)</label>
                                                    <div class="radio-item label-paypal">
                                                        <input type="checkbox" name="transport" id="transport" value="0">
                                                        <label class="radio radio-inline" for="transport">
                                                            Include Transportation
                                                        </label>
                                                    </div>
                                                    @if($trip->price != null)
                                                    <div class="alert alert-info">
                                                        {{$trip->price}} $ For one Person
                                                    </div>
                                                    @endif
                                                </div><!--End Form-group-->
                                            </div><!--End Row-->
                                            <div class="white-box-title">
                                                <h4 class="title">Billing Information</h4>
                                            </div><!--End White-box-title-->
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>Payment Method</label>
                                                    <div class="radio-item label-paypal">
                                                        <input type="radio" checked name="payment_type" id="Paypal" value="Paypal">
                                                        <label class="radio radio-inline" for="Paypal">
                                                            Paypal
                                                        </label>
                                                    </div>
                                                    <div class="radio-item label-card">
                                                        <input type="radio" name="payment_type" id="card" value="card">
                                                        <label class="radio radio-inline" for="card">
                                                            Credit card
                                                        </label>
                                                    </div>
                                                </div><!--End Form-group-->
                                            </div><!--End Row-->
                                            <div  id="app">
                                                <payment></payment>
                                            </div>
                                        </div><!--End tabpanel-->

                                    </div><!--End Tab-content-->
                                </div><!--End Form-body-->
                                <div class="form-action">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="wizard-btn button-previous">
                                                <i class="fa fa-angle-left"></i> Back </a>
                                            <a href="javascript:;" class="wizard-btn button-next"> Continue
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                            <button href="javascript:;" class="wizard-btn button-submit"> Submit
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div><!--End Form-Action-->
                            </div><!--End Form-wizard-->
                        </form><!--End Booking Form-->
                     </div>
                        <!--End Booking-Form-->
                    </div><!--End Wihte-box-->
                </div><!--End Col-md-12-->
            </div><!--End Row-->
        </div><!--End Contaner-->
    </section>
    </div>
@endsection
@section('foot')
    <script src="{{ asset('assets/global/js/app.js') }}"></script>
@endsection
