<?php
namespace Maileva;

use Maileva\Ftp\Command;

class CommandTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $command = new Command('testId', Command::GATEWAY_PAPER_XML);

        $filename = __DIR__.'/test_'.date('YmdHis').'.tmp';
        $command->saveInFile($filename);
        $this->assertGreaterThan(0, filesize($filename), 'The file of the commands can\'t be generated.');
        unlink($filename);
    }

}