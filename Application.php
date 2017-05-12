<?php

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Yaml\Yaml;
use Acme\DependencyInjection\AcmeExtension;

class Application {
    private $container;

    public function __construct() {
        $this->container = new ContainerBuidler();
    }

    public function build($configPath) {
        $userConfig = Yaml::parse($configPath);
        $this->container->loadFromExtension(new MailevaExtension(), $userConfig);
        $this->container->compile();
    }
}