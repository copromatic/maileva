<?php
namespace Maileva\Element;

use Maileva\Element;

class Option extends Element{

    protected $requestOption = '';
    protected $documentOptions = array();
    protected $pageOptions = array();

    function __construct()
    {
        $this->_definition = array(
            'requestOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'documentOptions' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'DocumentOptions/DocumentOption',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'pageOptions' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'PageOptions/PageOption',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getRequestOption()
    {
        return $this->requestOption;
    }

    /**
     * @param string $requestOption
     */
    public function setRequestOption($requestOption)
    {
        $this->requestOption = $requestOption;
    }

    /**
     * @return array
     */
    public function getDocumentOptions()
    {
        return $this->documentOptions;
    }

    /**
     * @param array $documentOptions
     */
    public function addDocumentOptions($documentOptions)
    {
        $this->documentOptions[] = $documentOptions;
    }

    /**
     * @return string
     */
    public function getPageOptions()
    {
        return $this->pageOptions;
    }

    /**
     * @param string $pageOptions
     */
    public function addPageOptions($pageOptions)
    {
        $this->pageOptions[] = $pageOptions;
    }


    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}