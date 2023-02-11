<?php

$host = $_ENV['WEB_SERVER_HOST'];
$port = $_ENV['WEB_SERVER_PORT'];
$doc = $_ENV['WEB_SERVER_DOCROOT'];

// Define SIGKILL if pcntl is not found
if (!function_exists('pcntl_signal')) {
    define('SIGKILL', 9);
}

// Command that starts the built-in web server
$command = sprintf('php -S %s:%d -t %s >./server.log 2>&1 & echo $!', $host, $port, $doc);

// Execute the command and store the process ID
$output = [];
exec($command, $output, $exit_code);

// sleep for a second to let server come up
sleep(1);
$pid = (int) $output[0];

// check server.log to see if it failed to start
$server_logs = file_get_contents("./server.log");
if (str_contains($server_logs, "Fail")) {
    // server failed to start for some reason
    print "Failed to start server! Logs:" . PHP_EOL . PHP_EOL;
    print_r($server_logs);
    exit(1);
}

echo sprintf('%s - Web server started on %s:%d with PID %d', date('r'), $host, $port, $pid) . PHP_EOL;

register_shutdown_function(function() {
    // cleanup after ourselves -- remove log file, shut down server
    global $pid;
    unlink("./server.log");
    posix_kill($pid, SIGKILL);
});
