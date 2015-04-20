<?php
namespace Maileva\Element;

use Maileva\Element;

class Hash extends Element{

    protected $type = '';
    protected $hash = '';

    const MD5 = 'MD5';
    const SHA1 = 'SHA1';

    function __construct()
    {
        $this->_definition = array(
            'type' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::MD5, self::SHA1),
                'compulsory' => true
            ),
            'hash' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 64,
                'compulsory' => true
            ),
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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

    public function toXmlHash(\DOMElement $parent, $namespace){
        $parent->nodeValue = $this->getHash();
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }
}