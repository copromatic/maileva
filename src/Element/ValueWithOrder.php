<?php
namespace Maileva\Element;

use Maileva\Element;

class ValueWithOrder extends Element{

    protected $order = '';
    protected $value = '';

    function __construct()
    {
        $this->_definition = array(
            'order' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'value' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 100,
                'compulsory' => true
            ),
        );
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
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

    public function toXmlValue(\DOMElement $parent, $namespace){
        $parent->nodeValue = $this->getValue();
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }
}