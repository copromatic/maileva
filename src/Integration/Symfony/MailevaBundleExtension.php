<?php

namespace Maileva\Integration\Symfony;

use Maileva\DependencyInjection\MailevaExtension;

class MailevaBundleExtension extends MailevaExtension {
    public function load(array $configs, ContainerBuilder $container) {
        parent::load($configs, $container);
    }
}