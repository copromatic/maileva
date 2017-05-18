<?php

namespace Maileva\Integration;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

class MailevaBundle extends Bundle {
    public function build(ContainerBuilder $container) {
        parent::build($container);
    }
}