<?php

//function gets access token from PayPal
function apiContext(){
	$apiContext = new PayPal\Rest\ApiContext(new PayPal\Auth\OAuthTokenCredential(CLIENT_ID, CLIENT_SECRET));
	return $apiContext;
}

//create PayPal payment method
function create_paypal_payment($total, $currency, $desc, $my_items, $redirect_url, $cancel_url){
	$redirectUrls = new PayPal\Api\RedirectUrls();
	$redirectUrls->setReturnUrl($redirect_url);
	$redirectUrls->setCancelUrl($cancel_url);
	
	$payer = new PayPal\Api\Payer();
	$payer->setPaymentMethod("paypal");
	
	$amount = new PayPal\Api\Amount();
	$amount->setCurrency($currency);
	$amount->setTotal($total);
									
	$items = new PayPal\Api\ItemList();
	$items->setItems($my_items);
		
	$transaction = new PayPal\Api\Transaction();
	$transaction->setAmount($amount);
	$transaction->setDescription($desc);
	$transaction->setItemList($items);

	$payment = new PayPal\Api\Payment();
	$payment->setRedirectUrls($redirectUrls);
	$payment->setIntent("sale");
	$payment->setPayer($payer);
	$payment->setTransactions(array($transaction));
	
	$payment->create(apiContext());
	
	return $payment;
}

//executes PayPal payment
function execute_payment($payment_id, $payer_id){
	$payment = PayPal\Api\Payment::get($payment_id, apiContext());
	$payment_execution = new PayPal\Api\PaymentExecution();
	$payment_execution->setPayerId($payer_id);	
	$payment = $payment->execute($payment_execution, apiContext());	
	return $payment;
}


//pay with credit card
function pay_direct_with_credit_card($credit_card_params, $currency, $amount_total, $my_items, $payment_desc) {		
	
	$card = new PayPal\Api\CreditCard();
	$card->setType($credit_card_params['type']);
	$card->setNumber($credit_card_params['number']);
	$card->setExpireMonth($credit_card_params['expire_month']);
	$card->setExpireYear($credit_card_params['expire_year']);
	$card->setCvv2($credit_card_params['cvv2']);
	$card->setFirstName($credit_card_params['first_name']);
	$card->setLastName($credit_card_params['last_name']);
	
	$funding_instrument = new PayPal\Api\FundingInstrument();
	$funding_instrument->setCreditCard($card);

	$payer = new PayPal\Api\Payer();
	$payer->setPayment_method("credit_card");
	$payer->setFundingInstruments(array($funding_instrument));
	
	$amount = new PayPal\Api\Amount();
	$amount->setCurrency($currency);
	$amount->setTotal($amount_total);
	
	$transaction = new PayPal\Api\Transaction();
	$transaction->setAmount($amount);
	$transaction->setDescription("creating a direct payment with credit card");
	
	$payment = new PayPal\Api\Payment();
	$payment->setIntent("sale");
	$payment->setPayer($payer);
	$payment->setTransactions(array($transaction));

	$payment->create(apiContext());	
	
	return $payment;
}
