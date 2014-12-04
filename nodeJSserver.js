// Default Modules from nodeJS, etc
var http  = require('http');
var colors = require('colors');

//this is connection server listen on port
var server = http.createServer(function(request, response){
  console.log('Server NodeJS for Index2.html created.');
}).listen(9900, function(){
  console.log('listening on *:9900');
});

// Make the server into Socket IO enabled
var io = require('socket.io').listen(server);
var users_connected_user_agents = [];

// When there is a user that is connected
io.on('connection', function(socket){	

	// Get data from CLIENT and send back data to ONLY that client
	// And then SEND data to ONLY one CLIENT
	socket.on('giveUserComputerData FROM CLIENT', function(user_browser_user_agent) {

		// Storing the user data to the array, the key is the user's session
		users_connected_user_agents[socket.id] = user_browser_user_agent;
		// DEBUG
		console.log('DEBUG, current array content is: '.underline.red); 
		console.log(users_connected_user_agents); 

		console.log('user connected! ' + ' the session ID is: ' + socket.id + ' the user browser is ' + user_browser_user_agent);
		// SEND data to ONLY one CLIENT
		io.to(socket.id).emit('giveUserHisBrowserAgent FROM SERVER', user_browser_user_agent, socket.id);
	});

	// User disconnected
	socket.on('disconnect', function(){
		console.log('user with ID of ' + socket.id + ' is disconnected, his browser is ' + users_connected_user_agents[socket.id]);
		// Send data to ALL CLIENT
		io.emit('user disconnected FROM SERVER', socket.id, users_connected_user_agents[socket.id]);
		delete users_connected_user_agents[socket.id];
		// DEBUG
		console.log('DEBUG, current array content is: '.underline.red); 
		console.log(users_connected_user_agents);
	});

	socket.on('private message FROM CLIENT', function (data) {

		console.log('UserID ' + socket.id + ' wanted to send message to ' + data.userIDDestination + ' , the content is ' + data.theMessage + ' , delay is ' + data.delay);
		
		// SEND data to ONLY one CLIENT
		if(data.delay == 0 || data.delay == null) {
			setTimeout(function(){
				io.to(data.userIDDestination).emit('private message FROM SERVER', data.userIDDestination, data.theMessage, 0);
			}, 0);
		} else {
			setTimeout(function(){
				io.to(data.userIDDestination).emit('private message FROM SERVER', data.userIDDestination, data.theMessage, data.delay);
			}, data.delay * 1000);
		}

	});

});