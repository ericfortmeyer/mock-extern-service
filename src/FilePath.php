<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 08:55
 */

namespace Fortmeyer\MockExternService;

/**
 * Class FilePath
 * 
 * @package Fortmeyer\MockExternService
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
     * Data arriving from the graylog server
     *
     * @return string
     */
    public static function udpsock_received()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_received.txt";
    }

    /**
     * Graylog service issues
     *
     * @return string
     */
    public static function udpsock_log()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_log.txt";
    }

    /**
     * The Process ID if the graylog service is working
     *
     * @return string
     */
    public static function udpsock_pid()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "udpsock_pid.txt";
    }

    /**
     * Emails that were received
     *
     * @return string
     */
    public static function mail_inbox()
    {
        return self::getbase() . DIRECTORY_SEPARATOR . "mail_inbox.txt";
    }
}
