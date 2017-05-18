<?php
namespace Maileva\Ftp;

use Maileva\Element;

class Package {
    const KEY_DES3 = '????';

    /** @var Command */
    protected $command = null;
    protected $directory = '';
    protected $directory_src = '';
    protected $directory_sent = '';
    protected $name = '';
    protected $keep_backup = true;
    protected $nb_files = 0;

    protected $zip = false;
    protected $hash = false;
    protected $crypt = false;
    protected $save_src = true;

    protected $files_packages = array();

    public static function pushExistingPackage($directory, $ftp_host, $ftp_username, $ftp_password, $directory_ftp = ''){
        $files = scandir($directory);

        $files_to_push = array();
        foreach($files as $file){
            if($file == '.' || $file == '..'){
                $files_to_push[] = $file;
            }
        }

        //TODO
        $extension = 'cou';
        return self::pushFilesToFtp($files_to_push, $extension, $ftp_host, $ftp_username, $ftp_password, $directory_ftp);
    }

    function __construct(Command $command, $package_name = '', $packages_directory = '', $zip = false, $hash = false, $crypt = false)
    {
        $this->save_src = ($packages_directory == '')?false:true;

        if($crypt){
            $command->setCryptMode(Command::CRYPT_MD5);
        }
        if($hash){
            $command->setHashMode(Command::HASH_MD5);
        }
        if($zip){
            $command->setZipMode(Command::ZIP_MD5);
        }
        $this->command = $command;
        if($packages_directory == ''){
            $this->keep_backup = false;
            $packages_directory = sys_get_temp_dir().'/'.str_replace(' ', '', microtime(true));
        }
        $this->directory = $packages_directory;

        if(!is_dir($this->directory)){
            if(!mkdir($this->directory.(($this->save_src)?'/ftp':''), 0777, true)){
                throw new \Exception('Package directory can\'t be created.');
            }
        }
        if($this->save_src && !is_dir($this->directory.'/src')) {
            if (!mkdir($this->directory . '/src', 0777, true)) {
                throw new \Exception('Package\'s sources directory can\'t be created.');
            }
        }
        if($package_name == ''){
            $this->name = date('maileva_YmdHis');
        }elseif(!preg_match('/^[a-zA-Z0-9_\\-]*$/', $package_name)){
            throw new \Exception('Package name is invalid.');
        }else{
            $this->name = $package_name;
        }
    }

    public function push($ftp_host, $ftp_username, $ftp_password, $directory_ftp = ''){
        return self::pushFilesToFtp($this->files_packages, $this->command->getExtensionFile(), $ftp_host, $ftp_username, $ftp_password, $directory_ftp);
    }

    public static function pushFilesToFtp($files, $extension, $ftp_host, $ftp_username, $ftp_password, $directory_ftp = ''){
        // set up basic connection
        $conn_id = ftp_connect($ftp_host);
        if (!$conn_id) {
            return false;
        }

        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_username, $ftp_password);
        if(!$login_result){
            return false;
        }
        // enable passive mode
        ftp_pasv($conn_id, TRUE);
        foreach($files as $i => $filename){
            $mode = FTP_BINARY;
            if(count($files) == $i+1){
                $mode = FTP_ASCII;
            }
            ftp_put($conn_id, $directory_ftp.'/'.basename($filename), $filename, $mode);
        }
        //renommage du fichier de commands
        ftp_rename($conn_id, $directory_ftp.'/'.basename($filename), $directory_ftp.'/'.substr(basename($filename), 0, strrpos(basename($filename), ".")+1).$extension);

        // close the connection
        ftp_close($conn_id);

        return true;
    }

    public function generate(Element $campaign){
        //Change the uri of the documents to a valid one for a ftp package
        /** @var \Maileva\Element\Request $request */
        $i = 1;
        foreach($campaign->getRequests() as $request){
            /** @var \Maileva\Element\Document $document */
            foreach($request->getDocumentData() as $document){
                if($this->save_src) {
                    file_put_contents($this->directory . '/src/' . $i.'.'.basename($document->getContent()->getUri()), file_get_contents($document->getContent()->getUri()));
                }
                $filename = $this->addFile($document->getContent()->getUri());
                $document->getContent()->setUri($filename);
                $i++;
            }
        }

        //Creation de lelement root pour le xml
        $domDoc = Element::getDomFromCampaign($campaign);
        // Beautiful output
        $domDoc->preserveWhiteSpace = false;
        $domDoc->formatOutput = true;

        //sauvegarde dans un fichier
        $filename_pjs = (($this->save_src)?$this->directory . '/src/':sys_get_temp_dir().'/').'pjs.xml';
        file_put_contents( $filename_pjs, $domDoc->saveXML());
        //ajout dans le fichier de command
        $this->addFile($filename_pjs);

        //generation du fichier de command
        $filename_command = $this->directory.(($this->save_src)?'/ftp/':'').'/'.$this->name.'.tmp';
        $this->command->saveInFile($filename_command);
        if($this->save_src){
            $this->command->saveInFile($this->directory . '/src/'.$this->name.'.'.$this->command->getExtensionFile());
        }
        $this->files_packages[] = $filename_command;
    }

    protected function getFilenameNewFile(){
        if($this->nb_files < 10){
            $nb_files_3_c = '00'.$this->nb_files;
        }elseif($this->nb_files < 100){
            $nb_files_3_c = '0'.$this->nb_files;
        }elseif($this->nb_files < 1000){
            $nb_files_3_c = $this->nb_files;
        }else{
            throw new \Exception('There are too many files in the package (max 1000)');
        }

        return $this->name.'.'.$nb_files_3_c;
    }

    function addFile($filename){
        $this->nb_files++;

        $filename_package = $this->directory.(($this->save_src)?'/ftp':'').'/'.$this->getFilenameNewFile();

        $content = file_get_contents($filename);
        $hash = $this->transformContent($content);

        file_put_contents($filename_package, $content);

        $this->command->addFile(filesize($filename_package), ($this->hash)?$hash:null, $this->getFilenameNewFile());

        $this->files_packages[] = $filename_package;

        return $this->getFilenameNewFile();
    }

    protected function transformContent(&$content){
        if($this->zip){
            $content = gzencode($content);
        }
        if($this->crypt){
            $content = mcrypt_encrypt(MCRYPT_3DES, self::KEY_DES3, MCRYPT_MODE_OFB, $content);
            throw new \Exception('Feature not available in this library');
        }

        return md5($content);
    }

    public function getPackageDirectory(){
        return $this->directory.(($this->save_src)?'/ftp':'').'/';
    }
}
