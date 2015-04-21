<?php

namespace Maileva\Element;

use Maileva\Element;

class User extends Element{
    /** @var  string */
    protected $authType;
    /** @var  string */
    protected $login;
    /** @var  string */
    protected $password;

    const AUTHTYPE_PLAINTEXT = 'PLAINTEXT';

    function __construct()
    {
        $this->_definition = array(
            'authType' => array(
                'xml' => Element::XML_ATTRIBUTE,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::AUTHTYPE_PLAINTEXT),
                'compulsory' => true
            ),
            'login' => array(
                'xml' => Element::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 60,
                'compulsory' => true
            ),
            'password' => array(
                'xml' => Element::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'max' => 60,
                'compulsory' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @param string $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    function verifyLogic()
    {

    }

}