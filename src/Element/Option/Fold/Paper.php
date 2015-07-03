<?php
namespace Maileva\Element\Option\Fold;

use Maileva\Element;

class Paper extends Element{

    const ENVELOPETYPE_C4 = 'C4';
    const ENVELOPETYPE_C6 = 'C6';

    const ENVELOPEWINDOWTYPE_DBL = 'DBL';
    const ENVELOPEWINDOWTYPE_SMPL = 'SMPL';

    const POSTAGECLASS_STANDARD = 'STANDARD';
    const POSTAGECLASS_SLOW = 'SLOW';
    const POSTAGECLASS_RECOMMANDE = 'RECOMMANDE';
    const POSTAGECLASS_RECOMMANDE_AR = 'RECOMMANDE_AR';
    const POSTAGECLASS_SLOW_NB = 'SLOW_NB';
    const POSTAGECLASS_DESTINEO_EL_STD_S1 = 'DESTINEO_EL_STD_S1';
    const POSTAGECLASS_DESTINEO_EL_STD_S2 = 'DESTINEO_EL_STD_S2';
    const POSTAGECLASS_DESTINEO_EL_MECA_S1 = 'DESTINEO_EL_MECA_S1';
    const POSTAGECLASS_DESTINEO_EL_MECA_S2 = 'DESTINEO_EL_MECA_S2';
    const POSTAGECLASS_LETTRE_GRAND_COMPTE = 'LETTRE_GRAND_COMPTE';
    const POSTAGECLASS_ECOPLI_GRAND_COMPTE = 'ECOPLI_GRAND_COMPTE';
    const POSTAGECLASS_LETTRE_VERTE = 'LETTRE_VERTE';
    const POSTAGECLASS_LETTRE_VERTE_NB = 'LETTRE_VERTE_NB';
    const POSTAGECLASS_LRE = 'LRE';
    const POSTAGECLASS_LRE_AR = 'LRE_AR';
    const POSTAGECLASS_LRE_TE = 'LRE_TE';
    const POSTAGECLASS_LRE_TE_AR = 'LRE_TE_AR';

    const SENDINGMODE_DEFAULT = 'DEFAULT';
    const SENDINGMODE_DIGITAL = 'DIGITAL';
    const SENDINGMODE_PAPER = 'PAPER';

    const SWITCHINGPOLICY_AUTOMATIC = 'AUTOMATIC';
    const SWITCHINGPOLICY_REQUIRE_CHECKED_IDENTITY = 'REQUIRE_CHECKED_IDENTITY';
    const SWITCHINGPOLICY_FORCE_DIGITAL_SENDING = 'FORCE_DIGITAL_SENDING';
    const SWITCHINGPOLICY_DISABLED = 'DISABLED';

    protected $envelopeType = '';
    protected $envelopeWindowType = '';
    protected $postageClass = '';
    /** @var bool  */
    protected $foldPrintColor = '';
    /** @var bool  */
    protected $printSenderAddress = '';
    /** @var bool  */
    protected $printRecipTrackId = '';
    /** @var bool  */
    protected $treatUndeliveredMail = '';
    /** @var bool  */
    protected $treatAR = '';
    /** @var DigitalArchiving */
    protected $digitalArchiving = '';
    /** @var bool  */
    protected $useFlyLeaf = '';
    protected $logoRef = '';
    protected $returnEnvelopeRef = '';
    /** @var Element\Option\Document\Paper */
    protected $documentOption = '';
    protected $depositTitle = '';
    protected $depositDescription = '';
    protected $switchingPolicy = '';
    protected $forceSendingMode = '';

    function __construct()
    {
        $this->_definition = array(
            'envelopeType' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::ENVELOPETYPE_C4, self::ENVELOPETYPE_C6),
                'compulsory' => false
            ),
            'envelopeWindowType' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::ENVELOPEWINDOWTYPE_DBL, self::ENVELOPEWINDOWTYPE_SMPL),
                'compulsory' => false
            ),
            'postageClass' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(
                    self::POSTAGECLASS_STANDARD,
                    self::POSTAGECLASS_SLOW,
                    self::POSTAGECLASS_RECOMMANDE,
                    self::POSTAGECLASS_RECOMMANDE_AR,
                    self::POSTAGECLASS_SLOW_NB,
                    self::POSTAGECLASS_DESTINEO_EL_MECA_S1,
                    self::POSTAGECLASS_DESTINEO_EL_MECA_S2,
                    self::POSTAGECLASS_DESTINEO_EL_STD_S1,
                    self::POSTAGECLASS_DESTINEO_EL_STD_S2,
                    self::POSTAGECLASS_LETTRE_GRAND_COMPTE,
                    self::POSTAGECLASS_ECOPLI_GRAND_COMPTE,
                    self::POSTAGECLASS_LETTRE_VERTE,
                    self::POSTAGECLASS_LETTRE_VERTE_NB,
                    self::POSTAGECLASS_LRE,
                    self::POSTAGECLASS_LRE_AR,
                    self::POSTAGECLASS_LRE_TE,
                    self::POSTAGECLASS_LRE_TE_AR
                ),
                'compulsory' => false
            ),
            'foldPrintColor' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'printSenderAddress' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'printRecipTrackId' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'treatUndeliveredMail' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'treatAR' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'digitalArchiving' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'useFlyLeaf' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'logoRef' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'max' => 45,
                'compulsory' => false
            ),
            'returnEnvelopeRef' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'max' => 8,
                'compulsory' => false
            ),
            'documentOption' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'switchingPolicy' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(
                    self::SWITCHINGPOLICY_AUTOMATIC,
                    self::SWITCHINGPOLICY_DISABLED,
                    self::SWITCHINGPOLICY_FORCE_DIGITAL_SENDING,
                    self::SWITCHINGPOLICY_REQUIRE_CHECKED_IDENTITY
                ),
                'compulsory' => false
            ),
            'forceSendingMode' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::SENDINGMODE_DEFAULT, self::SENDINGMODE_DIGITAL, self::SENDINGMODE_PAPER ),
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getDepositDescription()
    {
        return $this->depositDescription;
    }

    /**
     * @param string $depositDescription
     */
    public function setDepositDescription($depositDescription)
    {
        $this->depositDescription = $depositDescription;
    }

    /**
     * @return string
     */
    public function getDepositTitle()
    {
        return $this->depositTitle;
    }

    /**
     * @param string $depositTitle
     */
    public function setDepositTitle($depositTitle)
    {
        $this->depositTitle = $depositTitle;
    }

    /**
     * @return DigitalArchiving
     */
    public function getDigitalArchiving()
    {
        return $this->digitalArchiving;
    }

    /**
     * @param DigitalArchiving $digitalArchiving
     */
    public function setDigitalArchiving(DigitalArchiving $digitalArchiving)
    {
        $this->digitalArchiving = $digitalArchiving;
    }

    /**
     * @return Element\Option\Document\Paper
     */
    public function getDocumentOption()
    {
        return $this->documentOption;
    }

    /**
     * @param Element\Option\Document\Paper $documentOption
     */
    public function setDocumentOption(Element\Option\Document\Paper $documentOption)
    {
        $this->documentOption = $documentOption;
    }

    /**
     * @return string
     */
    public function getEnvelopeType()
    {
        return $this->envelopeType;
    }

    /**
     * @param string $envelopeType
     */
    public function setEnvelopeType($envelopeType)
    {
        $this->envelopeType = $envelopeType;
    }

    /**
     * @return string
     */
    public function getEnvelopeWindowType()
    {
        return $this->envelopeWindowType;
    }

    /**
     * @param string $envelopeWindowType
     */
    public function setEnvelopeWindowType($envelopeWindowType)
    {
        $this->envelopeWindowType = $envelopeWindowType;
    }

    /**
     * @return boolean
     */
    public function isFoldPrintColor()
    {
        return $this->foldPrintColor;
    }

    /**
     * @param boolean $foldPrintColor
     */
    public function setFoldPrintColor($foldPrintColor)
    {
        $this->foldPrintColor = $foldPrintColor;
    }

    /**
     * @return string
     */
    public function getLogoRef()
    {
        return $this->logoRef;
    }

    /**
     * @param string $logoRef
     */
    public function setLogoRef($logoRef)
    {
        $this->logoRef = $logoRef;
    }

    /**
     * @return string
     */
    public function getPostageClass()
    {
        return $this->postageClass;
    }

    /**
     * @param string $postageClass
     */
    public function setPostageClass($postageClass)
    {
        $this->postageClass = $postageClass;
    }

    /**
     * @return boolean
     */
    public function isPrintRecipTrackId()
    {
        return $this->printRecipTrackId;
    }

    /**
     * @param boolean $printRecipTrackId
     */
    public function setPrintRecipTrackId($printRecipTrackId)
    {
        $this->printRecipTrackId = $printRecipTrackId;
    }

    /**
     * @return boolean
     */
    public function isPrintSenderAddress()
    {
        return $this->printSenderAddress;
    }

    /**
     * @param boolean $printSenderAddress
     */
    public function setPrintSenderAddress($printSenderAddress)
    {
        $this->printSenderAddress = $printSenderAddress;
    }

    /**
     * @return string
     */
    public function getReturnEnvelopeRef()
    {
        return $this->returnEnvelopeRef;
    }

    /**
     * @param string $returnEnvelopeRef
     */
    public function setReturnEnvelopeRef($returnEnvelopeRef)
    {
        $this->returnEnvelopeRef = $returnEnvelopeRef;
    }

    /**
     * @return boolean
     */
    public function isTreatAR()
    {
        return $this->treatAR;
    }

    /**
     * @param boolean $treatAR
     */
    public function setTreatAR($treatAR)
    {
        $this->treatAR = $treatAR;
    }

    /**
     * @return boolean
     */
    public function isTreatUndeliveredMail()
    {
        return $this->treatUndeliveredMail;
    }

    /**
     * @param boolean $treatUndeliveredMail
     */
    public function setTreatUndeliveredMail($treatUndeliveredMail)
    {
        $this->treatUndeliveredMail = $treatUndeliveredMail;
    }

    /**
     * @return boolean
     */
    public function isUseFlyLeaf()
    {
        return $this->useFlyLeaf;
    }

    /**
     * @param boolean $useFlyLeaf
     */
    public function setUseFlyLeaf($useFlyLeaf)
    {
        $this->useFlyLeaf = $useFlyLeaf;
    }


    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}