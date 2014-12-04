<?php
use ElephantIO\Client,
    ElephantIO\Engine\SocketIO\Version1X;

Route::get('/', function()
{
	return View::make('index');
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
				$client->emit('private message FROM CLIENT', $chat);
			break;
			default: 
			break;
		}

	}

	$client->close();
});
