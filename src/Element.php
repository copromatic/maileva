<?php
namespace Maileva;

abstract class Element {
    const VERSION = '1.0';

    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_ELEMENT = 'element';
    const TYPE_CHOICES = 'choices';
    const TYPE_DATE = 'date';
    const TYPE_BOOLEAN = 'boolean';

    const XML_ATTRIBUTE = 'attribute';
    const XML_ELEMENT = 'element';

    protected $_definition = array();

    abstract function verifyLogic();

    public function generateXml(\SimpleXMLElement $xml){
        $elements = array();
        foreach($this->_definition as $varName => $definition){
            if(!isset($this->_definition[$varName]['xml'])){
                throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' xml type not defined.');
            }
            if($this->$varName === ''){
                continue;
            }
            switch($this->_definition[$varName]['xml']){
                case Element::XML_ATTRIBUTE:
                    $xml->addAttribute(ucfirst($varName), $this->$varName);
                    break;
                case Element::XML_ELEMENT:
                    if(!is_array($this->$varName)){
                        $values = array($this->$varName);
                    }else{
                        $values = $this->$varName;
                    }
                    $xmlName = ucfirst($varName);
                    $xmlToUse = $xml;
                    if(isset($this->_definition[$varName]['xml_path'])){
                        $path = explode('/', $this->_definition[$varName]['xml_path']);
                        foreach($path as $i => $part){
                            if(count($path) == $i+1){
                                $xmlName = $part;
                                break;
                            }
                            $xmlToUse = $xmlToUse->addChild($part);
                        }
                    }
                    foreach($values as $value){
                        if($this->_definition[$varName]['type'] == Element::TYPE_DATE){
                            /** @var \DateTime $value */
                            $xmlToUse->addChild($xmlName, $value->format($this->_definition[$varName]['format']));
                        }elseif($this->_definition[$varName]['type'] == Element::TYPE_ELEMENT){
                            $child = $xmlToUse->addChild($xmlName);
                            $value->generateXml($child);
                        }else{
                            $method = 'toXml'.ucfirst($varName);
                            if(method_exists($this, $method)){
                                $this->$method($xmlToUse->addChild($xmlName));
                                break;
                            }else{
                                if(is_bool($value) && $value === false){
                                    continue;
                                }
                                $xmlToUse->addChild($xmlName, ($value === true)?null:$value);
                            }
                        }
                    }
                    break;
            }
        }

        return $xml;
    }
    public function verify(){
        foreach($this->_definition as $varName => $definition){
            if(!isset($this->$varName)){
                throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' doesn\'t exist.');
            }
            $varValue = $this->$varName;

            //EST OBLIGATOIRE OU NON
            $is_compulsory = false;
            if(isset($this->_definition[$varName]['compulsory'])){
                $is_compulsory = $this->_definition[$varName]['compulsory'];
            }
            if($is_compulsory && (is_null($varValue) || $varValue == '' || empty($varValue))){
                throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is compulsory.');
            }

            //TAILLE MAXIMALE
            $max = 0;
            if(isset($this->_definition[$varName]['max'])){
                $max = $this->_definition[$varName]['max'];
            }

            //VERIFICATION EN FONCTION DU TYPE
            if(!isset($this->_definition[$varName]['type'])){
                $type = self::TYPE_STRING;
            }elseif(!in_array($this->_definition[$varName]['type'], array(self::TYPE_STRING, self::TYPE_INTEGER, self::TYPE_ELEMENT, self::TYPE_CHOICES, self::TYPE_BOOLEAN, self::TYPE_DATE, self::TYPE_FLOAT))){
                throw new \Maileva\Exception\Element('Type of "$'.$varName.'" not allowed.');
            }else{
                $type = $this->_definition[$varName]['type'];
            }
            switch($type){
                case self::TYPE_ELEMENT:
                    if(!is_array($varValue)){
                        $values = array($varValue);
                    }else{
                        $values = $varValue;
                    }

                    foreach($values as $value){
                        if($value == ''){
                            continue;
                        }
                        if(!($value instanceof Element)){
                            throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is not an Element.');
                        }
                        $value->verify();
                    }
                    break;
                case self::TYPE_FLOAT:
                    if(!is_numeric($varValue)){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is not a float.');
                    }
                    if($max > 0 && $varValue > $max){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is too big.');
                    }
                    break;
                case self::TYPE_INTEGER:
                    if($varValue != '' && (!is_numeric($varValue) || intval($varValue)+1 != intval($varValue+1))){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is not an integer.');
                    }
                    if($varValue != '' && ($max > 0 && $varValue > $max)){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is too big.');
                    }
                    break;
                case self::TYPE_STRING:
                    if(!is_array($varValue)){
                        $varValues = array($varValue);
                    }else{
                        $varValues = $varValue;
                    }
                    foreach($varValues as $value){
                        if($max > 0 && strlen($value) > $max){
                            throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' is too long.');
                        }
                    }
                    break;
                case self::TYPE_BOOLEAN:
                    if($varValue != '' && $varValue !== true && $varValue !== false){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' should be boolean.');
                    }
                    break;
                case self::TYPE_DATE:
                    if(!($varValue instanceof \DateTime)){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' should be a date.');
                    }
                    if(!isset($this->_definition[$varName]['format'])){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' date format not specified.');
                    }
                    break;
                case self::TYPE_CHOICES:
                    if(!isset($this->_definition[$varName]['choices'])){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' doesn\'t have option defined.');
                    }
                    if($varValue != '' && !in_array($varValue, $this->_definition[$varName]['choices'])){
                        throw new \Maileva\Exception\Element(get_class($this).':'.$varName.' doesn\'t allow this option.');
                    }
                    break;
            }
        }

        $this->verifyLogic();
    }
}