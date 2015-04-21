<?php
namespace Maileva\Element;

use Maileva\Element;

class Notification extends Element{

    protected $type = '';
    protected $format = '';
    protected $protocols = array();

    const NOTIF_GENERAL = 'GENERAL';
    const NOTIF_LRE = 'LRE';
    const NOTIF_PND = 'PND';

    const FORMAT_TXT = 'TXT';
    const FORMAT_XML = 'XML';
    const FORMAT_INI = 'INI';

    function __construct()
    {
        $this->_definition = array(
            'type' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::NOTIF_GENERAL, self::NOTIF_LRE, self::NOTIF_PND),
                'compulsory' => true
            ),
            'format' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::FORMAT_INI, self::FORMAT_TXT, self::FORMAT_XML),
                'compulsory' => true
            ),
            'protocols' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'Protocols/Protocol',
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return array
     */
    public function getProtocols()
    {
        return $this->protocols;
    }

    /**
     * @param Protocol $protocols
     */
    public function addProtocols(Protocol $protocol)
    {
        $this->protocols[] = $protocol;
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

    function verifyLogic()
    {
    }
}