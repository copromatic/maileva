<?php
namespace Maileva\Element\Option;

use Maileva\Element;

class Fold extends Element{

    const ENVELOPETYPE_C4 = 'C4';
    const ENVELOPETYPE_C6 = 'C6';

    const ENVELOPEWINDOWTYPE_DBL = 'DBL';
    const ENVELOPEWINDOWTYPE_SMPL = 'DBL';

    const POSTAGECLASS_STANDARD = 'STANDARD';
    const POSTAGECLASS_SLOW = 'SLOW';
    const POSTAGECLASS_RECOMMANDE = 'RECOMMANDE';
    const POSTAGECLASS_RECOMMANDE_AR = 'RECOMMANDE_AR';
    const POSTAGECLASS_LETTRE_GRAND_COMPTE = 'LETTRE_GRAND_COMPTE';
    const POSTAGECLASS_ECOPLI_GRAND_COMPTE = 'ECOPLI_GRAND_COMPTE';
    const POSTAGECLASS_ECOPLI_LETTRE_VERTE = 'LETTRE_VERTE';

    protected $envelopeType = '';
    protected $envelopeWindowType = '';
    protected $postageClass = '';
    protected $foldPrintColor = '';
    protected $printSenderAddress = '';
    protected $printRecipTrackId = '';
    protected $treatUndeliveredMail = '';
    protected $digitalArchiving = '';
    protected $useFlyLeaf = '';
    protected $logoRef = '';
    protected $documentOption = '';
    protected $depositTitle = '';
    protected $depositDescription = '';

    function __construct()
    {
        $this->_definition = array(
            'envelopeType' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::ENVELOPETYPE_C4, self::ENVELOPETYPE_C6),
                'compulsory' => false
            ),
            'envelopeWindowType' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::ENVELOPEWINDOWTYPE_DBL, self::ENVELOPEWINDOWTYPE_SMPL),
                'compulsory' => false
            ),
            'postageClass' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::POSTAGECLASS_STANDARD, self::POSTAGECLASS_SLOW, self::POSTAGECLASS_RECOMMANDE, self::POSTAGECLASS_RECOMMANDE_AR, self::POSTAGECLASS_LETTRE_GRAND_COMPTE, self::POSTAGECLASS_ECOPLI_GRAND_COMPTE, self::POSTAGECLASS_ECOPLI_LETTRE_VERTE),
                'compulsory' => false
            ),
            'foldPrintColor' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'printSenderAddress' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'printRecipTrackId' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'treatUndeliveredMail' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'digitalArchiving' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'useFlyLeaf' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'logoRef' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 45,
                'compulsory' => false
            ),
            'documentOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'depositTitle' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 50,
                'compulsory' => true
            ),
            'depositDescription' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 64,
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
     * @return string
     */
    public function getDigitalArchiving()
    {
        return $this->digitalArchiving;
    }

    /**
     * @param string $digitalArchiving
     */
    public function setDigitalArchiving($digitalArchiving)
    {
        $this->digitalArchiving = $digitalArchiving;
    }

    /**
     * @return string
     */
    public function getDocumentOption()
    {
        return $this->documentOption;
    }

    /**
     * @param string $documentOption
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
     * @return string
     */
    public function isFoldPrintColor()
    {
        return $this->foldPrintColor;
    }

    /**
     * @param string $foldPrintColor
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
     * @return string
     */
    public function isPrintRecipTrackId()
    {
        return $this->printRecipTrackId;
    }

    /**
     * @param string $printRecipTrackId
     */
    public function setPrintRecipTrackId($printRecipTrackId)
    {
        $this->printRecipTrackId = $printRecipTrackId;
    }

    /**
     * @return string
     */
    public function isPrintSenderAddress()
    {
        return $this->printSenderAddress;
    }

    /**
     * @param string $printSenderAddress
     */
    public function setPrintSenderAddress($printSenderAddress)
    {
        $this->printSenderAddress = $printSenderAddress;
    }

    /**
     * @return string
     */
    public function isTreatUndeliveredMail()
    {
        return $this->treatUndeliveredMail;
    }

    /**
     * @param string $treatUndeliveredMail
     */
    public function setTreatUndeliveredMail($treatUndeliveredMail)
    {
        $this->treatUndeliveredMail = $treatUndeliveredMail;
    }

    /**
     * @return string
     */
    public function isUseFlyLeaf()
    {
        return $this->useFlyLeaf;
    }

    /**
     * @param string $useFlyLeaf
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