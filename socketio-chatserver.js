var http = require('http'), fs = require('fs');
var httpServer = http.createServer(httphandler);
var socketio = require('socket.io')(httpServer);
var port = 8080;

// Connect to your MySQL database and fetch the list of registered users
var mysql = require('mysql');
var connection = mysql.createConnection({
  host: 'localhost',
  user: 'waph_team08',
  password: 'Pa$$w0rd',
  database: 'waph_team'
});

httpServer.listen(port);
console.log("WebSocket server is listening on port " + port);

function httphandler(request, response) {
  response.writeHead(200);
  var clientUI_stream = fs.createReadStream('./chat.html');
  clientUI_stream.pipe(response);
}

socketio.on('connection', function(socketclient) {
  console.log("A new socket.IO client is connected: " +
    socketclient.client.conn.remoteAddress + ": " +
    socketclient.id);

  // Fetch the list of registered users from the database
  connection.query('SELECT username FROM users', function(error, results, fields) {
    if (error) throw error;

    // Extract usernames from the results
    var users = results.map(result => result.username);

    // Send the list of users to the client
    socketclient.emit('userList', users);
  });

  // Listen for incoming messages
  socketclient.on('message', function(data, callback) {
    // Send the message to the receiver
    socketclient.to(data.receiver).emit('message', { sender: socketclient.id, message: data.message });

    // Optionally, you can send a response back to the sender
    callback({ success: true });
  });
});
