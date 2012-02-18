var http = require('http');
http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/plain'});
  console.log(req.url);
  res.end();
}).listen(7346, "127.0.0.1");
console.log("klappt");
