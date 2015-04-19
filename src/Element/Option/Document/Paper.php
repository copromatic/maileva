<?php
namespace Maileva\Element\Option\Document;

use Maileva\Element;

class Paper extends Element{

    protected $printDuplex = '';
    protected $pageOption = '';
    protected $staple = '';

    function __construct()
    {
        $this->_definition = array(
            'printDuplex' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'pageOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'staple' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getPageOption()
    {
        return $this->pageOption;
    }

    /**
     * @param string $pageOption
     */
    public function setPageOption(Element\Option\Page\Paper $pageOption)
    {
        $this->pageOption = $pageOption;
    }

    /**
     * @return string
     */
    public function isPrintDuplex()
    {
        return $this->printDuplex;
    }

    /**
     * @param string $printDuplex
     */
    public function setPrintDuplex($printDuplex)
    {
        $this->printDuplex = $printDuplex;
    }

    /**
     * @return string
     */
    public function isStaple()
    {
        return $this->staple;
    }

    /**
     * @param string $staple
     */
    public function setStaple($staple)
    {
        $this->staple = $staple;
    }


    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}