<?php
namespace Maileva\Element\Option\Request;

use Maileva\Element;

class Paper extends Element{

    protected $removeInvalidReturnEnvelope = '';
    protected $stampAdjust = '';
    protected $foldOption = '';

    function __construct()
    {
        $this->_definition = array(
            'removeInvalidReturnEnvelope' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'stampAdjust' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'foldOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getFoldOption()
    {
        return $this->foldOption;
    }

    /**
     * @param string $foldOption
     */
    public function setFoldOption($foldOption)
    {
        $this->foldOption = $foldOption;
    }

    /**
     * @return string
     */
    public function isRemoveInvalidReturnEnvelope()
    {
        return $this->removeInvalidReturnEnvelope;
    }

    /**
     * @param string $removeInvalidReturnEnvelope
     */
    public function setRemoveInvalidReturnEnvelope($removeInvalidReturnEnvelope)
    {
        $this->removeInvalidReturnEnvelope = $removeInvalidReturnEnvelope;
    }

    /**
     * @return string
     */
    public function isStampAdjust()
    {
        return $this->stampAdjust;
    }

    /**
     * @param string $stampAdjust
     */
    public function setStampAdjust($stampAdjust)
    {
        $this->stampAdjust = $stampAdjust;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}