<?php
namespace Maileva\Element\Option\Page;

use Maileva\Element;

class Paper extends Element{

    protected $backgroundId = '';
    protected $insertPageId = '';

    function __construct()
    {
        $this->_definition = array(
            'backgroundId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'compulsory' => false
            ),
            'insertPageId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getBackgroundId()
    {
        return $this->backgroundId;
    }

    /**
     * @param string $backgroundId
     */
    public function setBackgroundId($backgroundId)
    {
        $this->backgroundId = $backgroundId;
    }

    /**
     * @return string
     */
    public function getInsertPageId()
    {
        return $this->insertPageId;
    }

    /**
     * @param string $insertPageId
     */
    public function setInsertPageId(InsertPageId $insertPageId)
    {
        $this->insertPageId = $insertPageId;
    }

    function verifyLogic()
    {
        if($this->getInsertPageId() === '' && $this->getBackgroundId() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no parameter specified');
        }
    }


}