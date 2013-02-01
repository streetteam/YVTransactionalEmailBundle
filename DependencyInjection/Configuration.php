<?php

namespace YV\TransactionalEmailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('yv_transactional_email');

        $rootNode
            ->children()
            ->scalarNode('transactional_email_class')->isRequired()->cannotBeEmpty()->end()     
            ->scalarNode('default_locale')->defaultValue('en')->end()     
            ->end();

        $this->addServiceSection($rootNode);
        $this->addEmailSection($rootNode);        
        $this->addCrudSection($rootNode);
        
        return $treeBuilder;
    }
    
    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('transactional_email_manager')->defaultValue('transactional_email_manager.default')->end()
                            ->scalarNode('transactional_email_mailer')->defaultValue('transactional_email_mailer.default')->end()
                            ->scalarNode('transactional_email_type_holder')->isRequired()->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    private function addEmailSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('email')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('sending_enabled')->defaultValue(true)->end()
                            ->scalarNode('address')->defaultValue('admin@example.com')->end() 
                            ->scalarNode('sender_name')->defaultValue('Admin')->end()   
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    private function addCrudSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('crud')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('form_name')->defaultValue('yv_transactional_email')->end() 
                            ->scalarNode('form_type')->defaultValue('yv_transactional_email')->end()   
                        ->end()
                    ->end()
                ->end()
            ->end();
    }    
}
