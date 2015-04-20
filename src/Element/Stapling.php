<?php
namespace Maileva\Element;

use Maileva\Element;

class Stapling extends Element{

    /** @var int */
    protected $firstPageOffset = '';
    /** @var int */
    protected $lastPageOffset = '';

    function __construct()
    {
        $this->_definition = array(
            'firstPageOffset' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => false
            ),
            'lastPageOffset' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => false
            ),
        );
    }

    /**
     * @return int
     */
    public function getFirstPageOffset()
    {
        return $this->firstPageOffset;
    }

    /**
     * @param int $firstPageOffset
     */
    public function setFirstPageOffset($firstPageOffset)
    {
        $this->firstPageOffset = $firstPageOffset;
    }

    /**
     * @return int
     */
    public function getLastPageOffset()
    {
        return $this->lastPageOffset;
    }

    /**
     * @param int $lastPageOffset
     */
    public function setLastPageOffset($lastPageOffset)
    {
        $this->lastPageOffset = $lastPageOffset;
    }

    function verifyLogic()
    {

    }
}