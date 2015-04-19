<?php

namespace Maileva\Element;

use Maileva\Element;

class User extends Element{
    protected $authType;
    protected $login;
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
     * @return mixed
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @param mixed $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    function verifyLogic()
    {

    }

}