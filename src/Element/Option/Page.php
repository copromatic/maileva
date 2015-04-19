<?php
namespace Maileva\Element\Option;

use Maileva\Element;

class Page extends Element{

    protected $id = '';
    protected $paperOption = '';

    function __construct()
    {
        $this->_definition = array(
            'id' => array(
                'xml' => self::XML_ATTRIBUTE,
                'type' => Element::TYPE_STRING,
                'compulsory' => true
            ),
            'paperOption' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
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
     * @return string
     */
    public function getPaperOption()
    {
        return $this->paperOption;
    }

    /**
     * @param string $paperOption
     */
    public function setPaperOption(Element\Option\Page\Paper $paperOption)
    {
        $this->paperOption = $paperOption;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}