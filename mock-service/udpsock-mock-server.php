#!/usr/bin/env php
<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 05:34
 */

$address = '127.0.0.1';
$port = 13010;


error_reporting (E_ALL);

/* Das Skript wartet auf hereinkommende Verbindungsanforderungen. */
set_time_limit (0);

/* Die implizite Ausgabe wird eingeschaltet, so dass man sieht,
 * was gesendet wurde. */
ob_implicit_flush ();

// Find autoloader
foreach (array(__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

$data_received = \tm\MockExternService\FilePath::udpsock_received();
$data_log      = \tm\MockExternService\FilePath::udpsock_log();
$data_pid      = \tm\MockExternService\FilePath::udpsock_pid();

function wlog($log) {
    global $data_log;
    file_put_contents($data_log, $log, FILE_APPEND);
}

if (file_exists($data_pid)) {
    $pid = file_get_contents($data_pid);
    $return = exec('ps -p '.escapeshellarg($pid));
    if (strpos($return, $pid) !== false) {
        echo "graylog_server is runinig: " . file_get_contents($data_pid) . PHP_EOL;
        exit(2);
    }
}

file_put_contents($data_pid, getmypid());

if (file_exists($data_received)) {
    unlink($data_received);
}

if (file_exists($data_log)) {
    unlink($data_log);
}

if (($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) === false) {
    wlog("socket_create() fehlgeschlagen: Grund: " . socket_strerror(socket_last_error()) . "\n");
    exit(2);
}

if (socket_bind($sock, $address, $port) === false) {
    wlog( "socket_bind() fehlgeschlagen: Grund: " . socket_strerror(socket_last_error($sock)) . "\n");
    exit(2);
}

wlog("[INFO] Erfolgreich gestartet");

do {

    if (false === ($buf = socket_read ($sock, 2048))) {
        wlog( "socket_read() fehlgeschlagen: Grund: " . socket_strerror(socket_last_error($sock)) . "\n");
        exit(2);
        break 1;
    }

    if (!$buf = trim ($buf)) {
        continue;
    }

    file_put_contents($data_received, $buf);


} while (true);

socket_close ($sock);
unlink($data_received);
wlog("[INFO] Beendet");
