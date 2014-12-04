<?php
use ElephantIO\Client,
    ElephantIO\Engine\SocketIO\Version1X;

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::post('/loginReceiver', function()
{
	/* Auth still fail, use cheating way for now.
	if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
	{
	    return Redirect::intended('/');
	} else {
		dd('failed');
	}
	*/

	Session::put('username', Input::get('username'));
	return Redirect::to('/');
});

Route::post('/clientReceiver', function()
{

	$client = new Client(new Version1X('http://192.168.10.10:9900'));

	$client->initialize();

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		switch($_POST['command']) {

			case 'private message FROM CLIENT':
				$chat['userIDDestination'] = $_POST['userIDDestination'];
				$chat['theMessage'] = $_POST['theMessage'];
				$chat['delay'] = $_POST['delay'];
				$chat['username'] = $_POST['username'];
				$client->emit('private message FROM CLIENT', $chat);
			break;

			default: 
			break;
		}

	}

	$client->close();
});
