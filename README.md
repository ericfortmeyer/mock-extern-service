Mock Extern Service
===================

[![Build Status](https://travis-ci.org/tmloberon/mock-extern-service.svg?branch=master)](https://travis-ci.org/tmloberon/mock-extern-service)

To mock service like mail or UDP socket for functional Tests.
The result will be saved in a file and that can you assert.

Installation
------------

_composer require --dev "tumtum/mock-extern-service"_

Booting
-------

At first to you must booting this system, that can you do in the bootstrap file [see](tests/bootstrap.php).

    \tm\MockExternService\Service::boot();
    
Than you must start PHPUnit with PHP interpreter option `-d sendmail_path=[vendor/]bin/smtp-mock-server.php`
This script will mock the Mail System.

Assert
------

#### Mock Mails System

with `tm\MockExternService\Result::MailInbox()` get you the mail Content

###### Sample:

    public function testMockMailSystem()
    {
        $msg = "Content " . time();
        mail('root@@127.0.0.1', "subject", $msg);
        
        $this->assertContains($msg, MockExternService\Result::MailInbox());
    }
    
#### Mock UDP Socket

with `tm\MockExternService\Result::UdpSockArrived()` get you 2048 Bit of Content.
Socket will be listen on:

|   host    |  port |
|:---------:|:-----:|
| 127.0.0.1 | 13010 |
    

###### Sample:

    public function testGrayLogServer()
    {
        $data = "graylog_data " . time();
        $socket = fsockopen('udp://127.0.0.1:13010');
        fputs($socket, $data);

        $this->assertEquals($data, MockExternService\Result::UdpSockArrived());
    }
    
Sample:
-------

See [PHPUnitTest](tests/) command: `php -d sendmail_path=mock-service/smtp-mock-server.php ./vendor/bin/phpunit`. 

Chanelog
--------

- v0.1 First Idea
