<?php

namespace Maileva\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('maileva');
        $rootNode
            ->children()
                ->scalarNode('application_name')->end()
                ->scalarNode('user_connecteur_xml')->end()
                ->scalarNode('password_connecteur_xml')->end()
                ->arrayNode('ftp')
                    ->children()
                        ->scalarNode('host')->end()
                        ->scalarNode('username')->end()
                        ->scalarNode('password')->end()
                        ->scalarNode('directory')->end()
                    ->end()
                ->end()
                ->arrayNode('rate')
                    ->children()
                        ->floatNode('page')->end()
                        ->arrayNode('fold')
                            ->children()
                                ->floatNode('courriersimple')->end()
                                ->floatNode('recommandear')->end()
                            ->end()
                        ->end()
                        ->arrayNode('weight')
                            ->useAttributeAsKey('value')
                            ->prototype('variable')->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('package_directory')->end()
                ->floatNode('A4paperweight')->end()
            ->end()
        ;
        return $treeBuilder;
    }
}