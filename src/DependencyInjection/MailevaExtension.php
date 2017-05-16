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
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        echo '<pre>';
        var_dump($config);
        echo '</pre>';
        die;

        $defApi = $container->getDefinition('maileva.api');

        // set connecteur xml
        $defApi->replaceArgument(0, $config['maileva']['application_name']);
        $defApi->addMethodCall('configureXmlConnecteur', [
            $config['maileva']['user_connecteur_xml'], $config['maileva']['password_connecteur_xml'], '', $config['maileva']['package_directory']
        ]);

        // set ratesInformations
        $defApi->addMethodCall('setRatesInformations', [
            $config['maileva']['rate']['page'], $config['maileva']['rate']['fold']['courriersimple'],
            $config['maileva']['rate']['fold']['recommandear'], $config['maileva']['rate']['weight'],
            $config['maileva']['A4paperweight']
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