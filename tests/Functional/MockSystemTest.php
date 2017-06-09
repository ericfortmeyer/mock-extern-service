<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * Date: 09.06.17
 * Time: 05:34
 */
use tm\MockExternService;

class MockSystemTest extends PHPUnit_Framework_TestCase
{
    public function testIsPHPIniSetToSmtpMockServerScript()
    {
        $this->assertContains(
            "smtp-mock-server.php",
            ini_get('sendmail_path'),
            '#### Run PHPUnit with interpreter option `-d sendmail_path=tests/smtp-mock-server.php` ####');
    }

    public function testIsWorkMailSystem()
    {
        $mailto = "root@127.0.0.1";
        $msg = "Nachricht " . time();
        mail($mailto, "subject", $msg);
        $this->assertContains($msg, MockExternService\Result::MailInbox());
    }

    public function testGrayLogServer()
    {
        $data = "graylog_data " . time();
        $socket = fsockopen('udp://127.0.0.1:13010');
        fputs($socket, $data);

        $this->assertEquals($data, MockExternService\Result::UdpSockArrived());
    }
}
