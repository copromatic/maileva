<?php
namespace Maileva\Element\Option\Document;

use Maileva\Element;

class Paper extends Element{

    /** @var bool */
    protected $printDuplex = '';
    /** @var Element\Option\Page\Paper */
    protected $pageOption = '';
    /** @var bool */
    protected $staple = '';

    function __construct()
    {
        $this->_definition = array(
            'printDuplex' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'pageOption' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'staple' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            )
        );
    }

    /**
     * @return Element\Option\Page\Paper
     */
    public function getPageOption()
    {
        return $this->pageOption;
    }

    /**
     * @param Element\Option\Page\Paper $pageOption
     */
    public function setPageOption(Element\Option\Page\Paper $pageOption)
    {
        $this->pageOption = $pageOption;
    }

    /**
     * @return boolean
     */
    public function isPrintDuplex()
    {
        return $this->printDuplex;
    }

    /**
     * @param boolean $printDuplex
     */
    public function setPrintDuplex($printDuplex)
    {
        $this->printDuplex = $printDuplex;
    }

    /**
     * @return boolean
     */
    public function isStaple()
    {
        return $this->staple;
    }

    /**
     * @param boolean $staple
     */
    public function setStaple($staple)
    {
        $this->staple = $staple;
    }

    function verifyLogic()
    {
        if($this->getPageOption() === '' && $this->isStaple() === '' && $this->isPrintDuplex() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no option specified');
        }
    }


}