<?php

require(__DIR__ . '/../bootstrap.php');

use src\Request;

// Get event details for a public event
$uri = "http://api.showclix.com/Event/8175";
$response = Request::get($uri)
    ->expectsType('json')
    ->send();

// Print out the event details
echo "The event {$response->body->event} will take place on {$response->body->event_start}\n";

// Example overriding the default JSON handler with one that encodes the response as an array
src\Httpful::register(src\Mime::JSON, new \src\Handlers\JsonHandler(array('decode_as_array' => true)));

$response = Request::get($uri)
    ->expectsType('json')
    ->send();

// Print out the event details
echo "The event {$response->body['event']} will take place on {$response->body['event_start']}\n";