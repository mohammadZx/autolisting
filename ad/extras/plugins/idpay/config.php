<?php

return [
	
	'idpay' => [
		'sandbox'         => env('IDPAY_SANDBOX', false),
		'apikey'     => env('IDPAY_APIKEY', '8988a132-0799-4001-b6b4-82f6dde3b912'),
		'payment' => env('IDPAY_URL_PAYMENT', 'https://api.idpay.ir/v1.1/payment'),
		'inquiry' => env('IDPAY_URL_INQUIRY', 'https://api.idpay.ir/v1.1/payment/inquiry'),
		'verify' => env('IDPAY_URL_VIRIFY', 'https://api.idpay.ir/v1.1/payment/verify'),
	],
	
];
