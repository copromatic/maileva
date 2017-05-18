<?php

use Maileva\DependencyInjection\MailevaExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Yaml\Yaml;

class Application {
    private $container;

    public function __construct() {
        $this->container = new ContainerBuilder();
    }

    public function build($configPath) {
        $userConfig = Yaml::parse($configPath);
        $this->container->loadFromExtension(new MailevaExtension(), $userConfig);
        $this->container->compile();
    }

    public function getApi() {
        return $this->container->get('maileva.api');
    }
}