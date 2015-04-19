<?php
namespace Maileva\Element\Option\Page;

use Maileva\Element;

class Paper extends Element{

    protected $backgroundId = '';
    protected $insertPageId = '';

    function __construct()
    {
        $this->_definition = array(
            'backgroundId' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_STRING,
                'compulsory' => false
            ),
            'insertPageId' => array(
                'xml' => self::XML_ELEMENT,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => false
            )
        );
    }

    /**
     * @return string
     */
    public function getBackgroundId()
    {
        return $this->backgroundId;
    }

    /**
     * @param string $backgroundId
     */
    public function setBackgroundId($backgroundId)
    {
        $this->backgroundId = $backgroundId;
    }

    /**
     * @return string
     */
    public function getInsertPageId()
    {
        return $this->insertPageId;
    }

    /**
     * @param string $insertPageId
     */
    public function setInsertPageId(InsertPageId $insertPageId)
    {
        $this->insertPageId = $insertPageId;
    }

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}