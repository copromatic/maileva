<?php

namespace Maileva\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader\YamlFileLoader,
    Symfony\Component\DependencyInjection\Extension\ExtensionInterface,
    Symfony\Component\Config\Definition\Processor,
    Symfony\Component\Config\FileLocator
;

class MailevaExtension implements ExtensionInterface {

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $defApi = $container->getDefinition('maileva.api');
        // set connecteur xml
        $defApi->replaceArgument(0, $config['application_name']);
        $defApi->addMethodCall('configureXmlConnecteur', [
            $config['user_connecteur_xml'], $config['password_connecteur_xml'], $config['ftp'], $config['package_directory']
        ]);

        // set ratesInformations
        $defApi->addMethodCall('setRatesInformations', [
            $config['rate']['page'], $config['rate']['fold']['courriersimple'],
            $config['rate']['fold']['recommandear'], $config['rate']['weight'],
            $config['A4paperweight']
        ]);

        //$defApi->addMethodCall('setLogger', $container->getDefinition('logger'));
    }

    public function getNamespace()
    {
        // TODO: Implement getNamespace() method.
    }

    public function getXsdValidationBasePath()
    {
        // TODO: Implement getXsdValidationBasePath() method.
    }

    public function getAlias() {
        return 'maileva';
    }
}
