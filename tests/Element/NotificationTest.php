<?php
namespace Maileva;

class NotificationTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $notification = new \Maileva\Element\Notification();
        $notification->setType(\Maileva\Element\Notification::NOTIF_GENERAL);
        $notification->setFormat(\Maileva\Element\Notification::FORMAT_XML);
        $protocol = new \Maileva\Element\Protocol();
        $protocol->setFtp(new \Maileva\Element\Protocol\Ftp());
        $notification->addProtocols($protocol);

        $notification->verify();
    }
}