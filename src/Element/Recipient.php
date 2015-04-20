<?php
namespace Maileva\Element;

use Maileva\Element;

class Recipient extends Element{

    /** @var string  */
    protected $id = '';
    /** @var string  */
    protected $trackId = '';
    /** @var Element\Address\Paper */
    protected $paperAddress = '';
    protected $smsAddress = '';
    protected $emailAddress = '';
    protected $digitalAddress = '';
    /** @var string  */
    protected $category = '';
    /** @var bool  */
    protected $hasDigitalId = '';

    const UNKNOWN = 'UNKNOWN';
    const INDIVIDUAL = 'INDIVIDUAL';
    const PROFESSIONAL = 'PROFESSIONAL';

    function __construct()
    {
        $this->_definition = array(
            'id' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'trackId' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 32,
                'compulsory' => false
            ),
            'paperAddress' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'smsAddress' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'emailAddress' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'digitalAddress' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'category' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::UNKNOWN, self::PROFESSIONAL, self::INDIVIDUAL),
                'compulsory' => false
            ),
            'hasDigitalId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
        );
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDigitalAddress()
    {
        return $this->digitalAddress;
    }

    /**
     * @param string $digitalAddress
     */
    public function setDigitalAddress($digitalAddress)
    {
        $this->digitalAddress = $digitalAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return boolean
     */
    public function hasDigitalId()
    {
        return $this->hasDigitalId;
    }

    /**
     * @param boolean $hasDigitalId
     */
    public function setHasDigitalId($hasDigitalId)
    {
        $this->hasDigitalId = $hasDigitalId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Address\Paper
     */
    public function getPaperAddress()
    {
        return $this->paperAddress;
    }

    /**
     * @param Address\Paper $paperAddress
     */
    public function setPaperAddress(Element\Address\Paper $paperAddress)
    {
        $this->paperAddress = $paperAddress;
    }

    /**
     * @return string
     */
    public function getSmsAddress()
    {
        return $this->smsAddress;
    }

    /**
     * @param string $smsAddress
     */
    public function setSmsAddress($smsAddress)
    {
        $this->smsAddress = $smsAddress;
    }

    /**
     * @return string
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @param string $trackId
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }

    function verifyLogic()
    {
        if($this->getDigitalAddress() === '' && $this->getSmsAddress() === '' && $this->getEmailAddress() === '' && $this->getPaperAddress() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no address specified');
        }
    }


}