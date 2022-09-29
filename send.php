<?php

/* 
    php send.php 
*/

require_once __DIR__ .'/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$conn = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $conn->channel();

$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage('Hello World');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$conn->close();