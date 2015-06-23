<?php

namespace Maileva\Ftp;

class Command {

    const GATEWAY_PAPER = 'PAPER';
    const GATEWAY_FAX = 'FAX';
    const GATEWAY_EMAIL = 'EMAIL';
    const GATEWAY_SMS = 'SMS';
    const GATEWAY_FLOW = 'FLOW';
    const GATEWAY_MOD_P = 'MOD_P';
    const GATEWAY_PAPER_XML = 'PAPER_XML';
    const GATEWAY_LOCADR = 'LOCADR';
    const GATEWAY_TMPL_P = 'TMPL_P';

    const HASH_NO = 'NO';
    const HASH_MD5 = 'MD5';

    const ZIP_NO = 'NO';
    const ZIP_MD5 = 'GZ';

    const CRYPT_NO = 'NO';
    const CRYPT_MD5 = 'DES3';

    protected $data = array();

    function __construct($clientId, $gateway)
    {
        $class = new \ReflectionClass($this);
        $find = false;
        foreach($class->getConstants() as $name => $const){
            if(preg_match('/^GATEWAY_/', $name) && $const == $gateway){
                $find = true;
                break;
            }
        }
        if(!$find){
            throw new \Exception('Gateway not allowed');
        }

        if($clientId == ''){
            throw new \Exception('Client Id is empty');
        }

        $this->data = array(
            'CLIENT_ID' => $clientId,
            'GATEWAY' => $gateway,
            'NB_FILE' => 0,
            'HASH_MODE' => self::HASH_NO,
            'ZIP_MODE' => self::ZIP_NO,
            'CRYPT_MODE' => self::CRYPT_NO
        );
    }


    public function addFile($size, $hash = null, $name = ''){
        $this->data['NB_FILE']++;

        $this->data['FILE_SIZE_'.$this->data['NB_FILE']] = $size;
        if(!is_null($hash)){
            $this->data['FILE_HASH_'.$this->data['NB_FILE']] = $hash;
        }
        if($name != ''){
            $this->data['FILE_NAME_'.$this->data['NB_FILE']] = $name;
        }
    }

    public function setHashMode($hashMode){
        if(!in_array($hashMode, array(self::HASH_NO, self::HASH_MD5))){
            throw new \Exception('Hash mode not allowed');
        }
        $this->data['HASH_MODE'] = $hashMode;
    }

    public function setZipMode($zipMode){
        if(!in_array($zipMode, array(self::ZIP_NO, self::ZIP_MD5))){
            throw new \Exception('Zip mode not allowed');
        }
        $this->data['ZIP_MODE'] = $zipMode;
    }

    public function setCryptMode($cryptMode){
        if(!in_array($cryptMode, array(self::CRYPT_NO, self::CRYPT_MD5))){
            throw new \Exception('Crypt mode not allowed');
        }
        $this->data['CRYPT_MODE'] = $cryptMode;
    }

    public function saveInFile($filename){
        $content = '';
        foreach($this->data as $name => $value){
            $content .= $name.'='.$value.'
';
        }
        return file_put_contents($filename, substr($content, 0, strlen($content)-1));
    }

    public function getExtensionFile(){
        switch($this->data['GATEWAY']){
            case self::GATEWAY_PAPER:
            case self::GATEWAY_PAPER_XML:
                return 'cou';
                break;
            case self::GATEWAY_FAX:
                return 'fax';
                break;
            case self::GATEWAY_EMAIL:
                return 'ema';
                break;
            case self::GATEWAY_SMS:
                return 'sms';
                break;
            case self::GATEWAY_FLOW:
                return 'flw';
                break;
            case self::GATEWAY_TMPL_P:
                return 'tco';
                break;
            case self::GATEWAY_MOD_P:
                return 'mod';
                break;
            case self::GATEWAY_LOCADR:
                return 'add';
                break;
        }
        throw new \Exception('Extension can\'t be guessed from the gateway');
    }
}