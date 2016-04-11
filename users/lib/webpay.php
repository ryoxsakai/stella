<?php

require_once("lib/Stripe.php");
Stripe::setApiKey("live_secret_6xr5bE8Dt32B7VqaNMa2gcRF");
Stripe::$apiBase = "https://api.webpay.jp";

define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

//---Customer---

function WebPayCreateCustomer($data){
  $customer = Stripe_Customer::create(array(
   "currency"=>"jpy",
   "card"=>
      array("number"=>"{$data['cardNum1']}-{$data['cardNum2']}-{$data['cardNum3']}-{$data['cardNum4']}",
        "exp_month"=>"{$data['cardExMonth']}",
        "exp_year"=>"20{$data['cardExYear']}",
        "cvc"=>"{$data['cardCVC']}",
        "name"=>"{$data['cardName']}"),
      "description"=>"[STELLA] {$data['cardName']} ({$_COOKIE['userid']})",
      "email"=>"{$_COOKIE['mail']}"
  ));
  return $customer->id;
}

function WebPayDeleteCustomer($customerid){
  $customer = Stripe_Customer::retrieve($customerid);
  $customer->delete();
  return $customer->deleted;  // true OR false
}

function WebPayCustomerInformation($id){
  $magazineSecret = @file_get_contents(FULLPATH.'magazineSecret.txt');
  if($magazineSecret!=""){
    $customer = Stripe_Customer::retrieve($magazineSecret);
    return $customer;
  }
}

function WebPayCustomerCharge($data){
  try{
    Stripe_Charge::create(array(
      "amount"=>$data['amount'],
      "currency"=>"jpy",
      "customer"=>"{$data['customer']}",
      "description"=>"{$data['description']}"
    ));
  } catch(Stripe_CardError $e) {
  // カードが拒否された場合
  $body = $e->getJsonBody();
  $err = $body['error'];
  print('Status is:' . $e->getHttpStatus() . "\n");
  print('Type is:' . $err['type'] . "\n");
  print('Code is:' . $err['code'] . "\n");
  print('Param is:' . $err['param'] . "\n");
  print('Message is:' . $err['message'] . "\n");
  }catch(Stripe_InvalidRequestError $e) {
    //
  }
}

?>