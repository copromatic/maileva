<?php
namespace Maileva\Element\Protocol;

use Maileva\Element;

class Ftp extends Element{

    protected $login = '';
    protected $folder = '';

    function __construct()
    {
        $this->_definition = array(
            'login' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'max' => 64,
                'compulsory' => false
            ),
            'folder' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_STRING,
                'max' => 255,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param string $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
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

    function verifyLogic()
    {
    }


}