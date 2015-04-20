<?php
namespace Maileva\Element;

use Maileva\Element;

class PageInDoc extends Element{

    protected $number = '';
    protected $pageOptionId = '';

    function __construct()
    {
        $this->_definition = array(
            'number' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => true
            ),
            'pageOptionId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
        );
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getPageOptionId()
    {
        return $this->pageOptionId;
    }

    /**
     * @param string $pageOptionId
     */
    public function setPageOptionId($pageOptionId)
    {
        $this->pageOptionId = $pageOptionId;
    }

    function verifyLogic()
    {

    }


}