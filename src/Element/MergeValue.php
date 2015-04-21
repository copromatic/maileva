<?php
namespace Maileva\Element;

use Maileva\Element;

class MergeValue extends Element{

    /** @var ValueWithRef */
    protected $valueWithRef = '';
    /** @var ValueWithOrder */
    protected $valueWithOrder = '';

    function __construct()
    {
        $this->_definition = array(
            'valueWithRef' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'valueWithOrder' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return ValueWithOrder
     */
    public function getValueWithOrder()
    {
        return $this->valueWithOrder;
    }

    /**
     * @param ValueWithOrder $valueWithOrder
     */
    public function setValueWithOrder(ValueWithOrder $valueWithOrder)
    {
        $this->valueWithOrder = $valueWithOrder;
    }

    /**
     * @return ValueWithRef
     */
    public function getValueWithRef()
    {
        return $this->valueWithRef;
    }

    /**
     * @param ValueWithRef $valueWithRef
     */
    public function setValueWithRef(ValueWithRef $valueWithRef)
    {
        $this->valueWithRef = $valueWithRef;
    }


    function verifyLogic()
    {
        if($this->getValueWithOrder() === '' && $this->getValueWithRef() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no value specified');
        }
        if(!($this->getValueWithOrder() !== '' xor $this->getValueWithRef() !== '')){
            throw new \Maileva\Exception\Element(get_class($this).' can\'t specified two types of value');
        }
    }

}