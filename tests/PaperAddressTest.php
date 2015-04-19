<?php
namespace Maileva;

use Maileva\Element\Address\Paper;

class PaperAddressTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function test7Lines()
    {
        $paperAddress = new Paper();

        $paperAddress->addAddressLine('Company X');
        $paperAddress->addAddressLine('Gaetan Hautecoeur');
        $paperAddress->addAddressLine('5 Park St');
        $paperAddress->addAddressLine('3887 - Abbotsford');
        $paperAddress->addAddressLine('Melbourne');
        $paperAddress->addAddressLine('Melbourne');
        $paperAddress->addAddressLine('Melbourne');

        $paperAddress->setCountry('Australia');

        $paperAddress->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidFrenchAddress()
    {
        $paperAddress = new Paper();

        $paperAddress->addAddressLine('Company X');
        $paperAddress->addAddressLine('Gaetan Hautecoeur');
        $paperAddress->addAddressLine('5 rue de Milan');
        $paperAddress->addAddressLine('');
        $paperAddress->addAddressLine('');
        $paperAddress->addAddressLine('7500 Paris');

        $paperAddress->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoAddresses()
    {
        $paperAddress = new Paper();

        $paperAddress->setCountry('Australia');

        $paperAddress->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoAddresses2()
    {
        $paperAddress = new Paper();

        $paperAddress->addAddressLine('');
        $paperAddress->setCountry('Australia');

        $paperAddress->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testCountryTooLong()
    {
        $paperAddress = new Paper();

        $paperAddress->addAddressLine('Test Country');
        $paperAddress->setCountry('12345678901234567890123456789012345678901234567890');

        $paperAddress->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testAddressTooLong()
    {
        $paperAddress = new Paper();

        $paperAddress->addAddressLine('12345678901234567890123456789012345678901234567890');

        $paperAddress->setCountry('Australia');

        $paperAddress->verify();
        exit;
    }

    /**
     * @dataProvider validContent
     */
    public function testValidAddressContent($addressLine1, $addressLine2, $addressLine3, $addressLine4, $addressLine5, $addressLine6, $country, $countryCode){

        $paperAddress = new Paper();

        $paperAddress->addAddressLine($addressLine1);
        $paperAddress->addAddressLine($addressLine2);
        $paperAddress->addAddressLine($addressLine3);
        $paperAddress->addAddressLine($addressLine4);
        $paperAddress->addAddressLine($addressLine5);
        $paperAddress->addAddressLine($addressLine6);

        $paperAddress->setCountry($country);
        $paperAddress->setCountryCode($countryCode);

        $paperAddress->verify();
    }

    public function validContent(){
        return array(
            array(
                'Company Y',
                '',
                '6 Park St',
                '3000',
                'Melbourne',
                '',
                'Australia',
                'AU'
            ),
            array(
                'Company Y',
                '',
                '6 Park St',
                '3000',
                'Melbourne',
                '',
                'Australia',
                ''
            ),
            array(
                '',
                '',
                '6 Park St',
                '',
                'Melbourne',
                '',
                'Australia',
                ''
            ),
            array(
                '',
                'Gaetan Y',
                '6 rue de Milan',
                '',
                '',
                '75001 Paris',
                '',
                ''
            )
        );
    }
}