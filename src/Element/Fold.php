<?php

namespace Maileva\Element;

use Maileva\Element;

class Fold extends Element{

    protected $trackId = '';
    protected $id = '';
    protected $recipientId = '';
    protected $senderId = '';
    protected $documents = array();
    protected $mergeValues = array();

    function __construct()
    {
        $this->_definition = array(
            'id' => array(
                'xml' => Element::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'trackId' => array(
                'xml' => Element::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 32,
                'compulsory' => false
            ),
            'recipientId' => array(
                'xml' => Element::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'senderId' => array(
                'xml' => Element::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'compulsory' => false
            ),
            'documents' => array(
                'xml' => Element::XML_ELEMENT,
                'xml_path' => 'Documents/Document',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'mergeValues' => array(
                'xml' => Element::XML_ELEMENT,
                'xml_path' => 'MergeValues/MergeValue',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return array
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param array $documents
     */
    public function addDocument($document)
    {
        $this->documents[] = $document;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getMergeValues()
    {
        return $this->mergeValues;
    }

    /**
     * @param array $mergeValues
     */
    public function addMergeValue($mergeValue)
    {
        $this->mergeValues[] = $mergeValue;
    }

    /**
     * @return string
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }

    /**
     * @param string $recipientId
     */
    public function setRecipientId($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    /**
     * @return string
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @param string $senderId
     */
    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
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


