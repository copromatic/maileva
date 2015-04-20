<?php
namespace Maileva\Element\Option\Request;

use Maileva\Element;

class Paper extends Element{

    /** @var bool  */
    protected $removeInvalidReturnEnvelope = '';
    /** @var bool  */
    protected $stampAdjust = '';

    /** @var Element\Option\Fold\Paper */
    protected $foldOption = '';

    function __construct()
    {
        $this->_definition = array(
            'removeInvalidReturnEnvelope' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'stampAdjust' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'foldOption' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return Element\Option\Fold\Paper
     */
    public function getFoldOption()
    {
        return $this->foldOption;
    }

    /**
     * @param Element\Option\Fold\Paper $foldOption
     */
    public function setFoldOption(Element\Option\Fold\Paper $foldOption)
    {
        $this->foldOption = $foldOption;
    }

    /**
     * @return boolean
     */
    public function isRemoveInvalidReturnEnvelope()
    {
        return $this->removeInvalidReturnEnvelope;
    }

    /**
     * @param boolean $removeInvalidReturnEnvelope
     */
    public function setRemoveInvalidReturnEnvelope($removeInvalidReturnEnvelope)
    {
        $this->removeInvalidReturnEnvelope = $removeInvalidReturnEnvelope;
    }

    /**
     * @return boolean
     */
    public function isStampAdjust()
    {
        return $this->stampAdjust;
    }

    /**
     * @param boolean $stampAdjust
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