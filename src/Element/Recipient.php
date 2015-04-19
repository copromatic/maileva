<?php
namespace Maileva\Element;

use Maileva\Element;

class Recipient extends Element{

    protected $id = '';
    protected $trackId = '';
    protected $paperAddress = '';
    protected $smsAddress = '';
    protected $emailAddress = '';
    protected $digitalAddress = '';
    protected $category = '';
    protected $hasDigitalId = false;

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
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'smsAddress' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'emailAddress' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'digitalAddress' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'category' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::UNKNOWN, self::PROFESSIONAL, self::INDIVIDUAL),
                'compulsory' => false
            ),
            'hasDigitalId' => array(
                'xml' => self::XML_ELEMENT,
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
     * @return null
     */
    public function getDigitalAddress()
    {
        return $this->digitalAddress;
    }

    /**
     * @param null $digitalAddress
     */
    public function setDigitalAddress($digitalAddress)
    {
        $this->digitalAddress = $digitalAddress;
    }

    /**
     * @return null
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param null $emailAddress
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
     * @return null
     */
    public function getPaperAddress()
    {
        return $this->paperAddress;
    }

    /**
     * @param null $paperAddress
     */
    public function setPaperAddress(Element\Address\Paper $paperAddress)
    {
        $this->paperAddress = $paperAddress;
    }

    /**
     * @return null
     */
    public function getSmsAddress()
    {
        return $this->smsAddress;
    }

    /**
     * @param null $smsAddress
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