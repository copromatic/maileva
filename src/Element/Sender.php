<?php
namespace Maileva\Element;

use Maileva\Element;

class Sender extends Element{

    protected $id = '';
    protected $paperAddress = '';
    protected $smsAddress = '';

    function __construct()
    {
        $this->_definition = array(
            'id' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 15,
                'compulsory' => true
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
            )
        );
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

    function verifyLogic()
    {
        if($this->getSmsAddress() === '' && $this->getPaperAddress() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no address specified');
        }
    }

}