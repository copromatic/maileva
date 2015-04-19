<?php
namespace Maileva\Element\Option;

use Maileva\Element;

class Request extends Element{

    protected $paperOption = '';
    protected $digitalOption = '';
    protected $smsOption = '';

    function __construct()
    {
        $this->_definition = array(
            'paperOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'digitalOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'smsOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getDigitalOption()
    {
        return $this->digitalOption;
    }

    /**
     * @param string $digitalOption
     */
    public function setDigitalOption($digitalOption)
    {
        $this->digitalOption = $digitalOption;
    }

    /**
     * @return string
     */
    public function getPaperOption()
    {
        return $this->paperOption;
    }

    /**
     * @param string $paperOption
     */
    public function setPaperOption($paperOption)
    {
        $this->paperOption = $paperOption;
    }

    /**
     * @return string
     */
    public function getSmsOption()
    {
        return $this->smsOption;
    }

    /**
     * @param string $smsOption
     */
    public function setSmsOption($smsOption)
    {
        $this->smsOption = $smsOption;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}