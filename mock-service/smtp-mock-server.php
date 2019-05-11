#!/usr/bin/env php
<?php

namespace Fortmeyer\MockExternService;
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * ModifiedBy: Eric Fortmeyer <e.fortmeyer01@gmail.com>
 * Date: 05.10.19
 */

error_reporting (E_ALL);

// Find autoloader
foreach (
    [
        // __DIR__ . '/../../../autoload.php',
        __DIR__ . '/../vendor/autoload.php'
    ]
    as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

$mail = file_get_contents("php://stdin");
$inbox = FilePath::mail_inbox();

file_put_contents($inbox, $mail, FILE_APPEND);
