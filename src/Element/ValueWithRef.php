<?php
namespace Maileva\Element;

use Maileva\Element;

class ValueWithRef extends Element{

    protected $ref = '';
    protected $value = '';

    function __construct()
    {
        $this->_definition = array(
            'ref' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'value' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 100,
                'compulsory' => true
            ),
        );
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
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
        // TODO: Implement verifyLogic() method.
    }
}