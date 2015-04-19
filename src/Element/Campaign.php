<?php

namespace Maileva\Element;

use Maileva\Element;

class Campaign extends Element {
    protected $name = '';
    protected $version;
    protected $trackId = '';
    protected $application = '';
    protected $breakdownCode = '';

    protected $requests = array();

    protected $user = '';

    function __construct()
    {

        $this->setVersion(Element::VERSION);

        $this->_definition = array(
            'name' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 15,
                'compulsory' => false
            ),
            'version' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'trackId' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 38,
                'compulsory' => false
            ),
            'application' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 20,
                'compulsory' => false
            ),
            'breakdownCode' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'max' => 100,
                'compulsory' => false
            ),
            'requests' => array(
                'xml' => self::XML_ELEMENT,
                'xml_path' => 'Requests/Request',
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            ),
            'user' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
    }


    /**
     * @return string
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param string $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }

    /**
     * @return string
     */
    public function getBreakdownCode()
    {
        return $this->breakdownCode;
    }

    /**
     * @param string $breakdownCode
     */
    public function setBreakdownCode($breakdownCode)
    {
        $this->breakdownCode = $breakdownCode;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param array $requests
     */
    public function addRequest($request)
    {
        $this->requests[] = $request;
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

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }
} 