<?php
namespace Maileva\Element\Option;

use Maileva\Element;

class Document extends Element{

    protected $id = '';

    /** @var Element\Option\Document\Paper */
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
                'xml_namespace' => Element::NAMESPACE_SPEC,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            )
        );
    }

    /**
     * @return Document\Paper
     */
    public function getPaperOption()
    {
        return $this->paperOption;
    }

    /**
     * @param Document\Paper $paperOption
     */
    public function setPaperOption(Document\Paper $paperOption)
    {
        $this->paperOption = $paperOption;
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

    function verifyLogic()
    {
        // TODO: Implement verifyLogic() method.
    }


}