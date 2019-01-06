<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Carbon\Carbon;

Route::get('/', function () {
    return redirect(url('/home'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-chatkit-users', 'ChatKit\ChatKitUserController@getUsers');

Route::get('/stk-test', function(\Illuminate\Http\Request $request){
    $CallBackURL = "https://test.uzahost.com/api/uzapoint/payment/daraja";

    $mpesa= new \Safaricom\Mpesa\Mpesa();

    $BusinessShortCode  =  env('BUSINESS_SHORTCODE');
    $AccountReference = 'THUKU00';

    $LipaNaMpesaPasskey = env('LIPANAMPESA_PASS_KEY');
    $TransactionType    = "CustomerPayBillOnline";
    $PartyA             = '254700012090';
    $PartyB             =  env('BUSINESS_SHORTCODE');
    $PhoneNumber        = '254700012090';
    $TransactionDesc    = "Test from Chat ". Carbon::now()->format('F/Y');
    $Remarks            = "remarks";

    return $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode,
        $LipaNaMpesaPasskey,
        $TransactionType,
        1,
        $PartyA,
        $PartyB,
        $PhoneNumber,
        $CallBackURL,
        $AccountReference,
        $TransactionDesc,
        $Remarks);
});
