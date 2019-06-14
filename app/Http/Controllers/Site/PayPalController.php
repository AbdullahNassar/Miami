<?php

namespace App\Http\Controllers\Site;

use App\Booking;
use App\CabinePrice;
use App\CarPrice;
use App\HotelPrice;
use App\Price;
use App\Tour;
use App\TripTrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal;
use Redirect;

class PayPalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
            ));

    }

    public function insertData(Request $request,$type=null)
    {
     $trip = TripTrans::where('slug' ,$request->slug)->first();
     $trip_id =$trip->trip_id;
     $totall_price = null;
     $num_persone = null;

     if ($request->type == 0)
     {
        $priceDay = Price::where('trip_id' ,$trip_id)->where('date' ,Carbon::parse($request->date)->format('Y-m-d'))->first();
        if ($request->bookType == 'economy'){
            if ($request->adult){
                $totall_price =($priceDay->e_adult * $request->adult)+($priceDay->e_children * $request->children)+($priceDay->e_infants * $request->infant);
                $num_persone= $request->adult + $request->children + $request->infant;
            }else{
                $totall_price =($priceDay->e_after * $request->after)+($priceDay->e_before * $request->before);
                $num_persone= $request->after + $request->before;
            }
        }elseif ($request->bookType == 'business'){
            if ($request->adult){
                $totall_price =($priceDay->b_adult * $request->adult)+($priceDay->b_children * $request->children)+($priceDay->b_infants * $request->infant);
                $num_persone= $request->adult + $request->children + $request->infant;
            }else{
                $totall_price =($priceDay->b_after * $request->after)+($priceDay->b_before * $request->before);
                $num_persone= $request->after + $request->before;
            }
        }
        if ($request->transport != null){
            $totall_price = $totall_price +($num_persone* $trip->trip->price );
        }
    }elseif ($request->type == 1)
    {
        $priceDay = Tour::where('trip_id' ,$trip_id)->where('date' ,Carbon::parse($request->date)->format('Y-m-d'))->first();
        $totall_price =($priceDay->adult * $request->adult)+($priceDay->children * $request->children);
        $num_persone= $request->adult + $request->children;
    }elseif ($request->type == 2)
    {
        $priceDay = CabinePrice::where('trip_id' ,$trip_id)->where('date' ,Carbon::parse($request->date)->format('Y-m-d'))->first();
        $totall_price =($priceDay->single * $request->single) + ($priceDay->second * $request->double) + ($priceDay->third * $request->three) + ($priceDay->fourth * $request->four) + ($priceDay->less5 * $request->five);
        $num_persone= $request->single + $request->double + $request->three + $request->four + $request->five;
    }elseif ($request->type == 3)
    {
        $priceDay = CarPrice::where('trip_id' ,$trip_id)->where('date' ,Carbon::parse($request->date)->format('Y-m-d'))->first();
        if ($priceDay->e_price != null){
            $totall_price =($priceDay->e_price * $request->number);
        }else{
            $totall_price =($priceDay->b_price +$priceDay->tax +$priceDay->insurance +$priceDay->deposit)* $request->number;
        }
        $num_persone= $request->number;
    }elseif ($request->type == 4)
    {
        $priceDay = HotelPrice::where('trip_id' ,$trip_id)->where('date' ,Carbon::parse($request->date)->format('Y-m-d'))->first();
        if ($request->num_day == 2){
            $totall_price =($priceDay->single2day * $request->sgl) + ($priceDay->double2day * $request->dbl) + ($priceDay->third2day * $request->third) + ($priceDay->fourth2day * $request->fourth) + ($priceDay->less5_2day * $request->under5);
        }elseif ($request->num_day == 3){
            $totall_price =($priceDay->single3day * $request->sgl) + ($priceDay->double3day * $request->dbl) + ($priceDay->third3day * $request->third) + ($priceDay->fourth3day * $request->fourth) + ($priceDay->less5_3day * $request->under5);
        }elseif ($request->num_day == 4){
            $totall_price =($priceDay->single4day * $request->sgl) + ($priceDay->double4day * $request->dbl) + ($priceDay->third4day * $request->third) + ($priceDay->fourth4day * $request->fourth) + ($priceDay->less5_4day * $request->under5);
        }elseif ($request->num_day == 5){
            $totall_price =($priceDay->single5day * $request->sgl) + ($priceDay->double5day * $request->dbl) + ($priceDay->third5day * $request->third) + ($priceDay->fourth5day * $request->fourth) + ($priceDay->less5_5day * $request->under5);
        }elseif ($request->num_day == 6){
            $totall_price =($priceDay->single6day * $request->sgl) + ($priceDay->double6day * $request->dbl) + ($priceDay->third6day * $request->third) + ($priceDay->fourth6day * $request->fourth) + ($priceDay->less5_6day * $request->under5);
        }
        $num_persone= $request->sgl + $request->dbl + $request->third + $request->fourth + $request->under5;
    }
//dd($num_persone);
    if ($type==null)
    {
        return $totall_price;
    }else{
        $data = new Booking();
        $data->user_id= auth()->guard('members')->user()->id;
        $data->f_name =implode(",", $request->f_name);
        $data->l_name =implode(",", $request->l_name);
        $data->phone =implode(",", $request->phone);
        $data->b_date =implode(",", $request->b_date);
        $data->country =implode(",", $request->country);
        $data->gender =implode(",", $request->gender);
        $data->email =implode(",", $request->email);
        $data->address =implode(",", $request->address);
        $data->city =implode(",", $request->city);
        $data->passport =implode(",", $request->passport);
        $data->pass_expire =implode(",", $request->pass_expire);
        $data->trip_id = $trip_id;
        $data->date = $request->date;
        $data->payment_type = $request->payment_type;
        $data->total_price = $totall_price;
        $data->num_persone = $num_persone;
        $data->save();
        return $data;
    }
}

public function getCheckout(Request $request)
{
    $price = $this->insertData($request);

    if ($price == 0 || $price == null){
        session()->flash('msgCancel', 'An error has occurred please try again later and chose person numbers');
        return redirect()->back();
    }

    if ($request->payment_type == 'card') {

        $gateway = \Omnipay\Omnipay::create('\Omnipay\eProcessingNetwork\Gateway');
        $gateway->setApiLoginId('0517560');
        $gateway->setApiRestrictKey('aeOV1vddXKhD4suF');
        $gateway->setDeveloperMode(true);
        $user = auth()->guard('members')->user();
        $cardData = [
            'firstName' => $user->f_name,
            'lastName' => $user->l_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'description' => "Trips Booking",
            'billingAddress1' => $user->address,
            'billingPostcode' => $request->card_postal,
            'number' => $request->card_number,
            'expiryMonth' => $request->expiry_month,
            'expiryYear' => $request->expiry_year,
            'cvv' => $request->card_cvv
        ];

        try{
            $request = $gateway->purchase([
                'amount' => number_format($price,2),
                'card' => $cardData
            ]);

            $response = $request->send();

            if ($response->isSuccessful()) {
                session()->flash('msgDone', 'The payment is done successfully ('.implode(', ', $response->getData()).').');
                return back();
            }else{
                session()->flash('msgCancel', 'An error has occurred please try again later and choose person numbers: ('.implode(', ', $response->getData()).').');
                return back();
            }

        }catch(\Exception $e){
            session()->flash('msgCancel', 'An error has occurred: '. $e->getMessage());
            return redirect()->back();
        }

    }else{
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($price); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('What are you selling?');

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(route('site.getDone'));
        $redirectUrls->setCancelUrl(route('site.getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to( $redirectUrl );

    }
}

public function getDone(Request $request)
{
    $id = $request->get('paymentId');
    $token = $request->get('token');
    $payer_id = $request->get('PayerID');

    $payment = PayPal::getById($id, $this->_apiContext);

    $paymentExecution = PayPal::PaymentExecution();

    $paymentExecution->setPayerId($payer_id);
    $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
    $data = $this->insertData($request,5);
        // Thank the user for the purchase
    session()->flash('msgDone', 'Reservation successfully completed');
    return redirect()->back();
}

public function getCancel()
{
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
    session()->flash('msgCancel', 'An error has occurred please try again later');
    return redirect()->back();
}
}
