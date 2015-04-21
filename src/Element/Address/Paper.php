<?php
namespace Maileva\Element\Address;

use Maileva\Country;
use Maileva\Element;

class Paper extends Element{
    protected $country = '';
    protected $countryCode = '';
    protected $addressLines = array();

    function __construct()
    {
        $this->_definition = array(
            'country' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 38,
                'compulsory' => false
            ),
            'countryCode' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => array_keys(Country::getCountries()),
                'compulsory' => false
            ),
            'addressLines' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 38,
                'compulsory' => true
            )
        );
    }

    public function setAddress($a1, $a2, $a3, $a4, $a5, $a6){
        $this->addressLines = array($a1, $a2, $a3, $a4, $a5, $a6);
    }

    public function setFrenchAddress($a1, $a2, $a3, $a4, $a5, $code_postal, $ville){
        $this->addressLines = array($a1, $a2, $a3, $a4, $a5, $code_postal.' '.$ville);
        $this->setCountry('FRANCE');
        $this->setCountryCode('FR');
    }

    public function setFrenchCompanyAddress($name_company, $name_recipient, $building, $street, $more, $code_postal, $ville, $cedex = ''){
        $this->setFrenchAddress($name_company, $name_recipient, $building, $street, $more, $code_postal, $ville.' CEDEX '.$cedex);
    }

    public function setFrenchIndividualAddress($name_recipient, $building, $more_building, $street, $more, $code_postal, $ville){
        $this->setFrenchAddress($name_recipient, $more_building, $building, $street, $more, $code_postal, $ville);
    }

    /**
     * @return array
     */
    public function getAddressLines()
    {
        return $this->addressLines;
    }

    /**
     * @param array $addressLines
     */
    public function addAddressLine($addressLine)
    {
        $this->addressLines[] = $addressLine;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    function verifyLogic()
    {
        if(count($this->getAddressLines()) > 6){
            throw new \Maileva\Exception\Element(get_class($this).':addressLines too many lines.');
        }
        if(count($this->getAddressLines()) < 1){
            throw new \Maileva\Exception\Element(get_class($this).':addressLines not enough lines.');
        }

        $complete = 0;
        foreach($this->getAddressLines() as $line){
            if($line != ''){
                $complete++;
            }
        }
        if($complete == 0){
            throw new \Maileva\Exception\Element(get_class($this).':addressLines the lines are empty.');
        }

        //cas d une adresse francaise
        if(
            (($this->getCountryCode() == '' && $this->getCountry() == '') //france par defaut
            || $this->getCountryCode() == 'FR' //country code sur france
            || (preg_match('/FRANCE/', strtoupper($this->getCountry())))) // Country sur France

            && !preg_match('/^[0-9]{5} .*$/', $this->addressLines[5]) //si par du format 77360 Vaires sur Marne
        ){
            throw new \Maileva\Exception\Element(get_class($this).':addressLines the 6 lines is not valid for a french address.');
        }
    }

    function toXmlAddressLines($parent, $namespace){
        $node = new \DOMElement('AddressLines', null, $namespace);
        $parent->appendChild($node);
        $parent = $node;
        foreach($this->getAddressLines() as $i => $line){
            $node = new \DOMElement('AddressLine'.($i+1), $line, Element::NAMESPACE_COM);
            $parent->appendChild($node);
        }
    }
}