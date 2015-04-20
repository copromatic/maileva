<?php
namespace Maileva\Element;

use Maileva\Element;

class ContentMergeField extends Element{

    /** @var string  */
    protected $value = '';
    /** @var string  */
    protected $id = '';
    /** @var string  */
    protected $automatic = '';

    const AUTOMATIC_AUTOMERGE = 'ComAutoMergeField';

    function __construct()
    {
        $this->_definition = array(
            'value' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 100,
                'compulsory' => false
            ),
            'id' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'compulsory' => false
            ),
            'automatic' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::AUTOMATIC_AUTOMERGE),
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getAutomatic()
    {
        return $this->automatic;
    }

    /**
     * @param string $automatic
     */
    public function setAutomatic($automatic)
    {
        $this->automatic = $automatic;
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    function verifyLogic()
    {
        if($this->getValue() === '' && $this->getId() === '' && $this->getAutomatic() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no element specified');
        }
        if(!($this->getValue() != '' xor $this->getId() != '' xor $this->getAutomatic() != '')){
            throw new \Maileva\Exception\Element(get_class($this).' too many element specified');
        }
    }

}