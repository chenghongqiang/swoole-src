<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC); //异步非阻塞

$client->on("connect", function($cli) {
    $cli->send("GET / HTTP/1.1\r\n\r\n");
});

$client->on("receive", function($cli, $data){
    echo "Receive: $data";
	sleep(1);
	$cli->send("GET / HTTP/1.1\r\n\r\n");
});

$client->on("error", function($cli){
    exit("error\n");
});

$client->on("close", function($cli){
    echo "Connection close";
});

$client->connect('127.0.0.1', 9501, 0.5);

//for PHP5.3-
//swoole_event_wait();
