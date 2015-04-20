<?php
namespace Maileva\Element\Option\Page;

use Maileva\Element;

class InsertPageId extends Element{

    protected $type = '';
    protected $value = '';

    const INSERTPAGEID_TYPE_RV = 'RV';
    const INSERTPAGEID_TYPE_SPL = 'SPL';

    function __construct()
    {
        $this->_definition = array(
            'type' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::INSERTPAGEID_TYPE_RV, self::INSERTPAGEID_TYPE_SPL),
                'compulsory' => true
            ),
            'value' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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