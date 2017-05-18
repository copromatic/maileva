<?php

namespace Maileva\Integration\DependencyInjection;

use Maileva\DependencyInjection\MailevaExtension as MailevaExtensionVendor;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MailevaExtension extends MailevaExtensionVendor {
    public function load(array $configs, ContainerBuilder $container) {
        parent::load($configs, $container);
    }
}