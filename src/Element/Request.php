<?php

namespace Maileva\Element;

use Maileva\Element;

class Request extends Element{

    protected $trackId = '';
    protected $mediaType = '';

    protected $recipients = array();
    protected $senders = array();
    protected $documentData = array();
    protected $folds = array();
    protected $notifications = array();
    /** @var \DateTime  */
    protected $productionDate;
    protected $options = '';

    const PAPER = 'PAPER';
    const DIGITAL = 'DIGITAL';
    const SMS = 'SMS';

    function __construct()
    {
        $this->setProductionDate(new \DateTime());

        $this->_definition = array(
            'trackId' => array(
                'xml' => Element::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'mediaType' => array(
                'xml' => Element::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::PAPER, self::DIGITAL, self::SMS),
                'max' => 38,
                'compulsory' => false
            ),
            'recipients' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'Recipients/Internal/Recipient',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            ),
            'senders' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'Senders/Sender',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'documentData' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'DocumentData/Documents/Document',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'folds' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'Folds/Fold',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'notifications' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'productionDate' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_DATE,
                'format' => 'Y-m-d\\TH:i:s\\.00',
                'compulsory' => false
            ),
            'options' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
    }

    /**
     * @return array
     */
    public function getDocumentData()
    {
        return $this->documentData;
    }

    /**
     * @param array $documentData
     */
    public function addDocumentData(Document $documentData)
    {
        $this->documentData[] = $documentData;
    }

    /**
     * @return array
     */
    public function getFolds()
    {
        return $this->folds;
    }

    /**
     * @param array $folds
     */
    public function addFold(Fold $fold)
    {
        $this->folds[] = $fold;
    }

    /**
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param string $mediaType
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;
    }

    /**
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param array $notifications
     */
    public function addNotification($notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \DateTime
     */
    public function getProductionDate()
    {
        return $this->productionDate;
    }

    /**
     * @param array $productionDate
     */
    public function setProductionDate(\DateTime $productionDate)
    {
        $this->productionDate = $productionDate;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param array $recipients
     */
    public function addRecipient(Recipient $recipient)
    {
        $this->recipients[] = $recipient;
    }

    /**
     * @return array
     */
    public function getSenders()
    {
        return $this->senders;
    }

    /**
     * @param array $senders
     */
    public function addSender(Sender $sender)
    {
        $this->senders[] = $sender;
    }

    /**
     * @return string
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @param string $trackId
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }

}


