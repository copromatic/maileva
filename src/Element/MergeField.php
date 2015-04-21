<?php
namespace Maileva\Element;

use Maileva\Element;

class MergeField extends Element{

    /** @var int  */
    protected $pageNumber = '';
    protected $fontName = '';
    /** @var int  */
    protected $fontSize = '';
    protected $fontColor = '';
    /** @var bool */
    protected $fontBold = '';
    /** @var bool */
    protected $fontItalic = '';
    /** @var bool */
    protected $fontUnderline = '';
    protected $posUnit = '';
    /** @var float */
    protected $posX = '';
    /** @var float */
    protected $posY = '';
    /** @var ContentMergeField */
    protected $content = '';
    /** @var int  */
    protected $orientation = '';
    protected $halign = '';

    const UNITE_CM = 'CM';

    const HALIGN_LEFT = 'LEFT';
    const HALIGN_CENTER = 'CENTER';
    const HALIGN_RIGHT = 'RIGHT';

    const FONT_COURRIER = 'Courier';
    const FONT_ARIAL = 'Arial';
    const FONT_TIMESROMAN = 'TimesRoman';
    const FONT_TIMESNEWROMAN = 'TimesNewRoman';
    const FONT_SANSSERIF = 'SansSerif';
    const FONT_SERIF = 'Serif';
    const FONT_HELVETICA = 'Helvetica';
    const FONT_3OF9MAILEVA = '3of9Maileva';
    const FONT_ARIALBLACK = 'ArialBlack';
    const FONT_BOOKMANOLDSTYLE = 'BookmanOldStyle';
    const FONT_CALIBRI = 'Calibri';
    const FONT_CENTURY = 'Century';
    const FONT_CENTURYGOTHIC = 'CenturyGothic';
    const FONT_EAN13 = 'Ean13';
    const FONT_COMICSANSMS = ' ComicSansMS';
    const FONT_COURIERNEW = 'CourierNew';
    const FONT_GARAMOND = 'Garamond';
    const FONT_GEORGIA = 'Georgia';
    const FONT_IMPACT = 'Impact';
    const FONT_LUCIDASANS = 'LucidaSans';
    const FONT_NOBELLIGHT = 'NobelLight,';
    const FONT_TAHOMA = 'Tahoma';
    const FONT_TREBUCHETMS = 'TrebuchetMS';
    const FONT_VERDANA = 'Verdana';
    const FONT_WEBDINGS = 'Webdings';

    protected static function getFonts(){
        $class = new \ReflectionClass(get_class());
        $const = array();
        $allConst = $class->getConstants();
        foreach($allConst as $name => $value){
            if(preg_match('/^FONT_[A-Z]+$/', $name)){
                $const[] = $value;
            }
        }

        return $const;
    }

    function __construct()
    {
        $this->_definition = array(
            'pageNumber' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'compulsory' => true
            ),
            'fontName' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => self::getFonts(),
                'compulsory' => true
            ),
            'fontSize' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'max' => 72,
                'min' => 6,
                'compulsory' => true
            ),
            'fontColor' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_STRING,
                'max' => 20,
                'compulsory' => false
            ),
            'fontBold' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'fontItalic' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'fontUnderline' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_BOOLEAN,
                'compulsory' => false
            ),
            'posUnit' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::UNITE_CM),
                'compulsory' => true
            ),
            'posX' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_FLOAT,
                'compulsory' => true
            ),
            'posY' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_FLOAT,
                'compulsory' => true
            ),
            'content' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_ELEMENT,
                'compulsory' => true
            ),
            'orientation' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_INTEGER,
                'min' => 0,
                'max' => 360,
                'compulsory' => false
            ),
            'halign' => array(
                'xml' => self::XML_ELEMENT,
                'xml_namespace' => Element::NAMESPACE_COM,
                'type' => Element::TYPE_CHOICES,
                'choices' => array(self::HALIGN_LEFT, self::HALIGN_CENTER, self::HALIGN_RIGHT),
                'compulsory' => false
            ),
        );
    }

    /**
     * @return ContentMergeField
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param ContentMergeField $content
     */
    public function setContent(ContentMergeField $content)
    {
        $this->content = $content;
    }

    /**
     * @return boolean
     */
    public function isFontBold()
    {
        return $this->fontBold;
    }

    /**
     * @param boolean $fontBold
     */
    public function setFontBold($fontBold)
    {
        $this->fontBold = $fontBold;
    }

    /**
     * @return string
     */
    public function getFontColor()
    {
        return $this->fontColor;
    }

    /**
     * @param string $fontColor
     */
    public function setFontColor($fontColor)
    {
        $this->fontColor = $fontColor;
    }

    /**
     * @return boolean
     */
    public function isFontItalic()
    {
        return $this->fontItalic;
    }

    /**
     * @param boolean $fontItalic
     */
    public function setFontItalic($fontItalic)
    {
        $this->fontItalic = $fontItalic;
    }

    /**
     * @return string
     */
    public function getFontName()
    {
        return $this->fontName;
    }

    /**
     * @param string $fontName
     */
    public function setFontName($fontName)
    {
        $this->fontName = $fontName;
    }

    /**
     * @return int
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * @param int $fontSize
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }

    /**
     * @return boolean
     */
    public function isFontUnderline()
    {
        return $this->fontUnderline;
    }

    /**
     * @param boolean $fontUnderline
     */
    public function setFontUnderline($fontUnderline)
    {
        $this->fontUnderline = $fontUnderline;
    }

    /**
     * @return string
     */
    public function getHalign()
    {
        return $this->halign;
    }

    /**
     * @param string $halign
     */
    public function setHalign($halign)
    {
        $this->halign = $halign;
    }

    /**
     * @return int
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * @param int $orientation
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return string
     */
    public function getPosUnit()
    {
        return $this->posUnit;
    }

    /**
     * @param string $posUnit
     */
    public function setPosUnit($posUnit)
    {
        $this->posUnit = $posUnit;
    }

    /**
     * @return float
     */
    public function getPosX()
    {
        return $this->posX;
    }

    /**
     * @param float $posX
     */
    public function setPosX($posX)
    {
        $this->posX = $posX;
    }

    /**
     * @return float
     */
    public function getPosY()
    {
        return $this->posY;
    }

    /**
     * @param float $posY
     */
    public function setPosY($posY)
    {
        $this->posY = $posY;
    }

    function verifyLogic()
    {
        if($this->getFontColor() !== '' && !preg_match('/#[0-9A-F]{3,6}/', $this->getFontColor())){
            throw new \Maileva\Exception\Element(get_class($this).' the font color must be an hexadecimal value');
        }
    }

}