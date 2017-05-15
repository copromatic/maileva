<?php

namespace Maileva\Integration\DependencyInjection;

use Maileva\DependencyInjection\MailevaExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MailevaBundleExtension extends MailevaExtension {
    public function load(array $configs, ContainerBuilder $container) {
        parent::load($configs, $container);
    }
}