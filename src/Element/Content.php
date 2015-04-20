<?php
namespace Maileva\Element;

use Maileva\Element;

class Content extends Element{

    protected $uri = '';
    protected $value = '';
    protected $encoding = '';

    const ISO_8859_1 = 'ISO-8859-1';
    const UTF_8 = 'UTF-8';

    function __construct()
    {
        $this->_definition = array(
            'uri' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 255,
                'compulsory' => false
            ),
            'value' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 255,
                'compulsory' => false
            ),
            'encoding' => array(
                'xml' => self::XML_ATTRIBUTE,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::ISO_8859_1, self::UTF_8),
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
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
        if($this->getUri() !== ''){
            $allowed = self::getAllowedExtension();
            $extension = substr(strrchr($this->getUri(), "."), 1);
            if(!in_array($extension, $allowed)){
                throw new \Maileva\Exception\Element(get_class($this).' extension not allowed: '.$extension);
            }
        }
    }

    public static function getAllowedExtension(){
        return array('pdf', 'xlsx', 'doc', 'docx', 'rtf', 'txt', 'xls' );
    }
}