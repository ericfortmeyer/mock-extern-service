<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <devloper@tobimat.eu>
 * Date: 09.06.17
 * Time: 09:19
 */

namespace tm\MockExternService;

/**
 * Class Result
 * @package tm\MockExternService
 */
class Result
{
    /**
     * Holt die Mail von der Inbox ab
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
     * Das was Graylog emfangen wurden
     *
     * @return string
     */
    public static function UdpSockArrived() {
        $inbox = FilePath::udpsock_received();
        sleep(1); # bischen warten bis die Sachen auf der Platte gespeichert wurden

        if (file_exists($inbox)) {
            return (string)file_get_contents($inbox);
        }

        return '';
    }

}