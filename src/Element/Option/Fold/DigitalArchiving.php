<?php
namespace Maileva\Element\Option\Fold;

use Maileva\Element;

class DigitalArchiving extends Element{

    const DURATION_12_MOIS = '12';
    const DURATION_36_MOIS = '36';
    const DURATION_72_MOIS = '72';
    const DURATION_120_MOIS = '120';

    protected $online = '';
    protected $standard = '';

    function __construct()
    {
        $this->_definition = array(
            'online' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::DURATION_12_MOIS, self::DURATION_36_MOIS, self::DURATION_72_MOIS, self::DURATION_120_MOIS),
                'compulsory' => true
            ),
            'standard' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::DURATION_12_MOIS, self::DURATION_36_MOIS, self::DURATION_72_MOIS, self::DURATION_120_MOIS),
                'compulsory' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param string $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return string
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * @param string $standard
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}