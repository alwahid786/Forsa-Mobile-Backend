
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
// var db = require('./db.js');
// var mydb = new db();

// app.get('/', function (req, res) {
//     res.send('Working Fine');
// });
var sockets = {};
var arr = [];

io.socket.on('connection', function (socket) {
    console.log(`[${socket.id}] socket connected`);

    // socket.on('send_message', function (data) {
    //     // console.log(JSON.stringify(data));
    //     io.emit('react_received', {
    //         'key': data.key,
    //         'post_obj': data.post_obj,
    //     });
    socket.on("send_message", msg => {
        console.log(msg);
        io.emit("send_message", msg);
    });

    socket.on("notification", msg => {
        console.log(msg);
        io.emit("notification", msg);
    });
});
// socket.on('disconnect', function () {
//     if (sockets[socket.id] != undefined) {
//         mydb.releaseRequest(sockets[socket.id].user_id).then(function (result) {
//             console.log('disconected: ' + sockets[socket.id].request_id);
//             io.emit('request-released', {
//                 'request_id': sockets[socket.id].request_id
//             });
//             delete sockets[socket.id];
//         });
//     }
// });

// });
console.log('socket running');
http.listen(1040, function () {
    console.log('working fine my socket');
});
