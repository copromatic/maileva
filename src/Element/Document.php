<?php
namespace Maileva\Element;

use Maileva\Element;

class Document extends Element{

    protected $id = '';
    protected $shrink = false;
    protected $content = null;
    protected $size = '';
    protected $hash = '';
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
                'type' => Element::TYPE_BOOLEAN
            ),
            'content' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'size' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => false
            ),
            'mergeFields' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param null $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
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
     * @param array $mergeFields
     */
    public function addMergeFields($mergeField)
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
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    function verifyLogic()
    {

    }


}