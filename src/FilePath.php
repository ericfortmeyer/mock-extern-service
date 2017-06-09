<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 08:55
 */

namespace tm\MockExternService;

/**
 * Class FilePath
 * @package tm\MockExternService
 */
class FilePath
{
    /**
     * @return string
     */
    protected static function getbase() {
        $data = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "data";
        if (is_dir($data) == false) {
            mkdir($data, 0777);
        }
        return $data;
    }

    /**
     * Daten die ankommen vom graylog server
     *
     * @return string
     */
    public static function udpsock_received()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_received.txt";
    }

    /**
     * Ausgaben des Graylog Service
     *
     * @return string
     */
    public static function udpsock_log()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_log.txt";
    }

    /**
     * Die Process ID ob der graylog Service arbeitet
     *
     * @return string
     */
    public static function udpsock_pid()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_pid.txt";
    }

    /**
     * Das was per Mail angekommen ist
     *
     * @return string
     */
    public static function mail_inbox()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "mail_inbox.txt";
    }
}