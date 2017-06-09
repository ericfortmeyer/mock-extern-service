<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 09:10
 */

namespace tm\MockExternService;

/**
 * Class Service
 *
 * @package tm\MockExternService
 */
class Service
{
    /**
     * Start einige Services
     */
    public static function boot()
    {
        if (strpos(ini_get('sendmail_path'), 'smtp-mock-server.php') === false) {
            trigger_error('Run PHP with interpreter option `-d sendmail_path=vendor/bin/smtp-mock-server.php` ####');
            die(255);
        }

        $udpsock_server = __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . "mock-service" . DIRECTORY_SEPARATOR . 'udpsock-mock-server.php';
        exec("php $udpsock_server > /dev/null 2>&1 &", $output);
        sleep(1);

        register_shutdown_function('tm\MockExternService\Service::killUdpsockServer');
    }

    /**
     * Beendet die Services
     */
    public static function killUdpsockServer() {
        $pid = FilePath::udpsock_pid();

        if (file_exists($pid)) {
            exec('kill ' . escapeshellarg(file_get_contents($pid)));
        }
    }
}