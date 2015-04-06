<?php

return [

	'microweber' => [
	    'client_id' => env('MW_CLIENT'),
	    'client_secret' => env('MW_SECRET'),
	    'redirect' => getenv('SITE_URL') . 'auth/callback'
	],

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'paypal' => [
		'client_id' => 'AZp1TV9bwG3Be5ojO4laj2_UPuSUTbFy9E_I9RD4tY0mzFwOwjoZfNv1kvPSzR1Sf7C4ofbutj0UPKsK',
		'secret' => 'EIkU7-DQpqps8XIfHUODi-tsb8U-sb7sCZ0o1YzG50E6sy2smx5SDrOm17MaEHsw1CaLyg9DrhWy_LJy'
	],

];
