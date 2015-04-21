<?php
namespace Maileva\Element;

use Maileva\Element;

class DocInFold extends Element{

    protected $documentId = '';
    /** @var int */
    protected $firstPage = '';
    /** @var int */
    protected $lastPage = '';
    protected $pages = array();
    protected $documentOptionId = '';
    protected $staplingDetails = array();

    function __construct()
    {
        $this->_definition = array(
            'documentId' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'firstPage' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_INTEGER
            ),
            'lastPage' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_INTEGER
            ),
            'pages' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'xml_path' => 'Pages/Page',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'documentOptionId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'compulsory' => false
            ),
            'staplingDetails' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'xml_path' => 'StaplingDetails/Stapling',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @param string $documentId
     */
    public function setDocumentId($documentId)
    {
        $this->documentId = $documentId;
    }

    /**
     * @return string
     */
    public function getDocumentOptionId()
    {
        return $this->documentOptionId;
    }

    /**
     * @param string $documentOptionId
     */
    public function setDocumentOptionId($documentOptionId)
    {
        $this->documentOptionId = $documentOptionId;
    }

    /**
     * @return string
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * @param string $firstPage
     */
    public function setFirstPage($firstPage)
    {
        $this->firstPage = $firstPage;
    }

    /**
     * @return string
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * @param string $lastPage
     */
    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param array $pages
     */
    public function addPage(PageInDoc $page)
    {
        $this->pages[] = $page;
    }

    /**
     * @return Stapling
     */
    public function getStaplingDetails()
    {
        return $this->staplingDetails;
    }

    /**
     * @param Stapling $staplingDetails
     */
    public function addStaplingDetails(Stapling $staplingDetails)
    {
        $this->staplingDetails[] = $staplingDetails;
    }

    function verifyLogic()
    {
    }


}