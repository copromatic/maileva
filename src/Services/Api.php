<?php

namespace Maileva\Services;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Api {
    protected $application_name = '';

    protected $username = null;
    protected $password = null;
    protected $ftp_options = array();
    protected $packages_directory = null;
    protected $email_notification = false;
    protected $ratePerPage;
    protected $courrierSimpleFoldRate;
    protected $recommandeArFoldRate;
    protected $weightConditions;
    protected $A4paperweight;

    /** @var LoggerInterface */
    protected $logger = null;

    function __construct($application_name)
    {
        $this->application_name = $application_name;
        $this->ratePerPage = 0;
        $this->courrierSimpleFoldRate = 0;
        $this->recommandeArFoldRate = 0;
        $this->weightConditions = [];
        $this->A4paperweight = 0;
    }

    function configureXmlConnecteur($username, $password, $ftp_options, $packages_directory = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->ftp_options = $ftp_options;
        $this->packages_directory = $packages_directory;
    }

    public function setLogger(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public function log($niveau, $message, $context){
        if(isset($this->logger)){
            $this->logger->log($niveau, $message, $context);
        }
    }
    public function setEmailNotification($email){
        $this->email_notification = $email;
    }

    public function getNewCampaign($name, $breakdown_code){
        $campaign = new \Maileva\Element\Campaign();
        $campaign->setName($name);
        $campaign->setApplication($this->application_name);
        $campaign->setBreakdownCode($breakdown_code);

        $user = new \Maileva\Element\User();
        $user->setAuthType(\Maileva\Element\User::AUTHTYPE_PLAINTEXT);
        $user->setLogin($this->username);
        $user->setPassword($this->password);
        $campaign->setUser($user);

        return $campaign;
    }

    public function generate($campaign, $package_name){
        $this->addNotifications($campaign);

        $command = new \Maileva\Ftp\Command($this->username, \Maileva\Ftp\Command::GATEWAY_PAPER);
        $package = new \Maileva\Ftp\Package($command, $package_name, $this->packages_directory.$package_name, false, false, false, false);

        $data_log = array(
            'directory' => $this->packages_directory.$package_name,
            'request' => count($campaign->getRequests())
        );

        try{
            $package->generate($campaign);

            $this->log(
                LogLevel::DEBUG,
                'Package generated',
                $data_log
            );
        }catch (Exception $e){
            $this->log(
                LogLevel::ERROR,
                'Package not generated: '.$e->getMessage(),
                $data_log
            );
            return false;
        }

        return $package;
    }

    protected function addNotifications($campaign){
        foreach($campaign->getRequests() as $request){
            $notification = new \Maileva\Element\Notification();
            $notification->setType(\Maileva\Element\Notification::NOTIF_GENERAL);
            $notification->setFormat(\Maileva\Element\Notification::FORMAT_XML);
            $protocol = new \Maileva\Element\Protocol();
            $protocol->setFtp(new \Maileva\Element\Protocol\Ftp());
            $notification->addProtocols($protocol);

            if($this->email_notification){
                $protocol = new \Maileva\Element\Protocol();
                $protocol->setEmail($this->email_notification);
                $notification->addProtocols($protocol);
            }

            $request->addNotification($notification);
        }
    }

    public function generateAndSend($campaign, $package_name){
        $data_log = array(
            'ftp' => array(
                'host' => $this->ftp_options['host'],
                'username' => $this->ftp_options['username'],
                'directory' => $this->ftp_options['directory']
            )
        );
        try{
            if(!($package = $this->generate($campaign, $package_name))){
                return false;
            }

            $package->push($this->ftp_options['host'], $this->ftp_options['username'], $this->ftp_options['password'], $this->ftp_options['directory']);

            $data_log['package_directory'] = $package->getPackageDirectory();

            $this->log(
                LogLevel::DEBUG,
                'Package pushed',
                $data_log
            );
        }catch (Exception $e){
            $this->log(
                LogLevel::ERROR,
                'Package not pushed: '.$e->getMessage(),
                $data_log
            );
            return false;
        }

        return true;
    }

    public function sendExisting($directory_name){
        $data_log = array(
            'ftp' => array(
                'host' => $this->ftp_options['host'],
                'username' => $this->ftp_options['username'],
                'directory' => $this->ftp_options['directory']
            ),
            'package_directory' => $directory_name
        );
        try{
            if(!\Maileva\Ftp\Package::pushExistingPackage($directory_name, $this->ftp_options['host'], $this->ftp_options['username'], $this->ftp_options['password'], $this->ftp_options['directory'])){
                throw new \Exception('Pushing to the ftp didn\'t work.');
            }

            $this->log(
                LogLevel::ERROR,
                'Existing package pushed to the ftp',
                $data_log
            );

            return true;
        }catch (Exception $e){
            $this->log(
                LogLevel::ERROR,
                'Package not pushed to the ftp: '.$e->getMessage(),
                $data_log
            );

        }
    }

    public function setRatesInformations($ratePerPage, $courrierSimpleFoldRate, $recommandeArFoldRate, $weightConditions, $A4paperweight)
    {
        $this->ratePerPage = $ratePerPage;
        $this->courrierSimpleFoldRate = $courrierSimpleFoldRate;
        $this->recommandeArFoldRate = $recommandeArFoldRate;
        $this->weightConditions = $weightConditions;
        $this->A4paperweight = $A4paperweight;
    }

    public function getRatesInformations()
    {
        return array(
            'ratePerPage' => $this->ratePerPage,
            'courrierSimpleFoldRate' => $this->courrierSimpleFoldRate,
            'recommandeArFoldRate' => $this->recommandeArFoldRate,
            'weightConditions' => $this->weightConditions,
            'A4paperweight' => $this->A4paperweight
        );
    }

    public function getMailFoldPrice($nbPage, $foldFormat, $duplex)
    {
        //tarif enveloppe
        switch($foldFormat){
            case \Maileva\Element\Option\Fold\Paper::POSTAGECLASS_RECOMMANDE_AR :
                $foldRate = $this->recommandeArFoldRate;
                break;
            case \Maileva\Element\Option\Fold\Paper::POSTAGECLASS_STANDARD :
            case \Maileva\Element\Option\Fold\Paper::POSTAGECLASS_LETTRE_VERTE :
            default :
                $foldRate = $this->courrierSimpleFoldRate;
                break;
        }

        return $foldRate;
    }

    public function getMailPrintPrice($nbPage, $foldFormat, $duplex)
    {
        return $nbPage * $this->ratePerPage;
    }

    public function getMailWeightPrice($nbPage, $foldFormat, $duplex)
    {
        //tarif timbre
        $weightRes = $this->A4paperweight * (($duplex)?ceil($nbPage/2):$nbPage);
        $weightRate = 0;

        foreach ($this->weightConditions as $weight => $cost) {
            if ($weightRes < $weight) {
                $weightRate = $cost[$foldFormat];
                break;
            }
        }
        return $weightRate;
    }
}
