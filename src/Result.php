<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <devloper@tobimat.eu>
 * Date: 09.06.17
 * Time: 09:19
 */

namespace Fortmeyer\MockExternService;

/**
 * Class Result
 * 
 * @package Fortmeyer\MockExternService
 */
class Result
{
    /**
     * Collects the mail from the inbox
     *
     * @return bool|string
     */
    public static function MailInbox(){

        $inbox = FilePath::mail_inbox();
        if (file_exists($inbox)) {
            return (string)file_get_contents($inbox);
        }

        return '';
    }

    /**
     * Graylog entry
     *
     * @return string
     */
    public static function UdpSockArrived() {
        $inbox = FilePath::udpsock_received();
        sleep(1); # wait until data is received

        if (file_exists($inbox)) {
            return (string)file_get_contents($inbox);
        }

        return '';
    }

}
