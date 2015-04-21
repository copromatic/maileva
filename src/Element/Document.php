<?php
namespace Maileva\Element;

use Maileva\Element;

class Document extends Element{

    /** @var string  */
    protected $id = '';
    /** @var bool  */
    protected $shrink = '';
    /** @var Content */
    protected $content = '';
    /** @var int */
    protected $size = '';
    /** @var Hash */
    protected $hash = '';
    /** @var array  */
    protected $mergeFields = array();

    function __construct()
    {
        $this->_definition = array(
            'id' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 15,
                'compulsory' => true
            ),
            'shrink' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'content' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            ),
            'size' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => false
            ),
            'hash' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'mergeFields' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'xml_path' => 'MergeFields/MergeField',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param Hash $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getMergeFields()
    {
        return $this->mergeFields;
    }

    /**
     * @param MergeField $mergeFields
     */
    public function addMergeField(MergeField $mergeField)
    {
        $this->mergeFields[] = $mergeField;
    }

    /**
     * @return boolean
     */
    public function isShrink()
    {
        return $this->shrink;
    }

    /**
     * @param boolean $shrink
     */
    public function setShrink($shrink)
    {
        $this->shrink = $shrink;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    function verifyLogic()
    {
        if(count($this->getMergeFields()) > 40){
            throw new \Maileva\Exception\Element(get_class($this).' there are too many mergeField in the document');
        }
    }


}