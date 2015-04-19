<?php
namespace Maileva\Element;

use Maileva\Element;

class MergeValue extends Element{

    protected $valueWithRef = '';
    protected $valueWithOrder = '';

    function __construct()
    {
        $this->_definition = array(
            'valueWithRef ' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            ),
            'valueWithOrder' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getValueWithOrder()
    {
        return $this->valueWithOrder;
    }

    /**
     * @param string $valueWithOrder
     */
    public function setValueWithOrder(ValueWithOrder $valueWithOrder)
    {
        $this->valueWithOrder = $valueWithOrder;
    }

    /**
     * @return string
     */
    public function getValueWithRef()
    {
        return $this->valueWithRef;
    }

    /**
     * @param string $valueWithRef
     */
    public function setValueWithRef(ValueWithRef $valueWithRef)
    {
        $this->valueWithRef = $valueWithRef;
    }


    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }

}