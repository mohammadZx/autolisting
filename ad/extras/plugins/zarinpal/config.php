<?php

return [
	
	'zarinpal' => [
		'merchant_id'     => env('ZARINPAL_APIKEY', '0fe2aff0-e39d-4587-b811-e5b3f38efd8e'),
		'payment' => env('ZARINPAL_URL_PAYMENT', 'https://api.zarinpal.com/pg/v4/payment/request.json'),
		'inquiry' => env('ZARINPAL_URL_INQUIRY', 'https://www.zarinpal.com/pg/StartPay/{code}'),
		'verify' => env('ZARINPAL_URL_VIRIFY', 'https://api.zarinpal.com/pg/v4/payment/verify.json'),
	],
	
];
