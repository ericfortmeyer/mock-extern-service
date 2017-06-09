#!/usr/bin/env php
<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 05:34
 */

error_reporting (E_ALL);

// Find autoloader
foreach (array(__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

$mail = file_get_contents("php://stdin");
$inbox = \tm\MockExternService\FilePath::mail_inbox();

file_put_contents($inbox, $mail);
