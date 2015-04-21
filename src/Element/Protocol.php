<?php
namespace Maileva\Element;

use Maileva\Element;

class Protocol extends Element{

    protected $email = '';
    /** @var Element\Protocol\Ftp */
    protected $ftp = '';
    protected $cft = '';
    protected $http = '';

    function __construct()
    {
        $this->_definition = array(
            'email' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'ftp' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'cft' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
            'email' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            ),
        );
    }

    /**
     * @return string
     */
    public function getCft()
    {
        return $this->cft;
    }

    /**
     * @param string $cft
     */
    public function setCft($cft)
    {
        $this->cft = $cft;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return Protocol\Ftp
     */
    public function getFtp()
    {
        return $this->ftp;
    }

    /**
     * @param Protocol\Ftp $ftp
     */
    public function setFtp($ftp)
    {
        $this->ftp = $ftp;
    }

    /**
     * @return string
     */
    public function getHttp()
    {
        return $this->http;
    }

    /**
     * @param string $http
     */
    public function setHttp($http)
    {
        $this->http = $http;
    }

    function verifyLogic()
    {
        if($this->getFtp() === '' && $this->getHttp() === '' && $this->getCft() === '' && $this->getEmail() === ''){
            throw new \Maileva\Exception\Element(get_class($this).' no protocol specified');
        }
    }
}