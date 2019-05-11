<?php
/**
 * Created by MockExternService.
 * Autor: Tobias Matthaiou <developer@tobimat.eu>
 * ModifiedBy: Eric Fortmeyer <e.fortmeyer01@gmail.com
 * Date: 05.10.19
 */
use Fortmeyer\MockExternService;

use PHPUnit\Framework\TestCase;

class MockSystemTest extends TestCase
{
    public function testIsPHPIniSetToSmtpMockServerScript()
    {
        $this->assertStringContainsString(
            "smtp-mock-server.php",
            ini_get('sendmail_path'),
            '#### Run PHPUnit with interpreter option `-d sendmail_path=tests/smtp-mock-server.php` ####');
    }

    public function testIsWorkMailSystem()
    {
        $mailto = "root@127.0.0.1";
        $msg = "Nachricht " . time();
        mail($mailto, "subject", $msg);
        $this->assertStringContainsString($msg, MockExternService\Result::MailInbox());
    }

    public function testGrayLogServer()
    {
        $data = "graylog_data " . time();
        $socket = fsockopen('udp://127.0.0.1:13010');
        fputs($socket, $data);

        $this->assertEquals($data, MockExternService\Result::UdpSockArrived());
    }
}
