<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use JonnyW\PhantomJs\Client;

Route::get('/', function () {
    $url = Input::get('url');

    $client = Client::getInstance();
    $client->setBinDir('../bin');
    
    $request  = $client->getMessageFactory()->createCaptureRequest($url);
    $response = $client->getMessageFactory()->createResponse();
    
    $file = '../bin/file.jpg';
    
    $request->setCaptureFile($file);
    
    $client->send($request, $response);

    rename('../bin/file.jpg', 'screenshots/file.jpg');

    echo '<img src="screenshots/file.jpg" />';
});
