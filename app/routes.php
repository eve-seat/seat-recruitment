<?php

use Pheal\Pheal;
use Pheal\Core\Config as PhealConfig;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {

	return View::make('hello');
});

Route::get('/apply', function() {

	return View::make('form');
});

Route::post('/apply', function() {

	// No point in getting an overly elaborate form validation going here.
	// Lets do this caveman style
	if ((strlen(Input::get('keyID') <=0 )) || !is_numeric(Input::get('keyID')))
		return View::make('ajax-form-errors')
			->withErrors(array('error' => 'The supplied keyID is invalid as its empty or not numeric!'));

	if ((strlen(Input::get('vCode')) <=0 ) || (strlen(Input::get('vCode')) <>64 ))
		return View::make('ajax-form-errors')
			->withErrors(array('error' => 'The supplied vCode must be exactly 64 characters long'));

	// Ok, looks like the key is valid! So, lets process it.
	PhealConfig::getInstance()->cache = new \Pheal\Cache\FileStorage( storage_path(). '/cache/phealcache/' );
	PhealConfig::getInstance()->access = new \Pheal\Access\StaticCheck();
	PhealConfig::getInstance()->log = new \Pheal\Log\FileStorage( storage_path() . '/logs/' );
	PhealConfig::getInstance()->http_user_agent = 'SeAT Recruitment Tool API Fetcher';
	PhealConfig::getInstance()->api_customkeys = true;
	PhealConfig::getInstance()->http_method = 'curl';

	$pheal = new Pheal(Input::get('keyID'), Input::get('vCode'));

	// Get API Key Information
	try {
		$key_info = $pheal->accountScope->APIKeyInfo();

	} catch (\Pheal\Exceptions\PhealException $e) {

		return View::make('ajax-form-errors')
			->withErrors(array('error' => $e->getCode() . ': ' . $e->getMessage()));
	}

	// Here, based on the type of key, we will either call some further information,
	// or just display what we have learned so far.
	if ($key_info->key->type == 'Corporation') {

		return View::make('ajax-form-errors')
			->withErrors(array('error' => 'It looks like you are trying to apply with a corporation key which simply wont work out.'));
	}

	// Get API Account Status Information
	try {
		$status_info = $pheal->accountScope->AccountStatus();

	} catch (\Pheal\Exceptions\PhealException $e) {

		return View::make('ajax-form-errors')
			->withErrors(array('error' => $e->getCode() . ': ' . $e->getMessage()));
	}

	// Lastly, store the keyID & vCode in the session
	$application_reference = str_random(40);
	Session::put($application_reference, array('keyID' => Input::get('keyID'), 'vCode' => Input::get('vCode')));

	// Return the view
	return View::make('ajax-form')
		->with('keyID', Input::get('keyID'))
		->with('vCode', Input::get('vCode'))
		->with('key_info', $key_info)
		->with('status_info', $status_info)
		->with('application_reference', $application_reference);
});

Route::post('/apply/process', function() {

	if (!Session::has(Input::get('reference')))
		return View::make('error')
			->withErrors(array('error' => 'Your application was not found'));

	$key_data_array = Session::get(Input::get('reference'));
	$keyID = $key_data_array['keyID'];
	$vCode = $key_data_array['vCode'];

	// We have the application and everything *seems* ok.
	// Store the key in the database
	$key_data = SeatKey::withTrashed()->where('keyID', $keyID)->first();

	if (!$key_data)
		$key_data = new SeatKey;

	$key_data->keyID = $keyID;
	$key_data->vCode = $vCode;
	$key_data->isOk = 1;
	$key_data->lastError = null;
	$key_data->deleted_at = null;
	$key_data->user_id = 1; // TODO: Fix this when the proper user management occurs
	$key_data->save();

	$data = array('application_content' => Input::all());

	Mail::send('emails.newapplication', $data, function($message) {

		foreach (Config::get('recruitment.notifications') as $name => $email)
			$message->to($email, $name)->subject('New Application Received by ' . $data['application_content']['character_name']);
	});

	return View::make('success');
});