<?php

namespace YV\TransactionalEmailBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class YVTransactionalEmailExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $container->setParameter('yv_transactional_email.transactional_email_class', $config['transactional_email_class']);
        $container->setParameter('yv_transactional_email.config', $this->createConfigParameterArray($config));
        
        $container->setParameter('yv_transactional_email.crud.form.type', $config['crud']['form_type']);
        $container->setParameter('yv_transactional_email.crud.form.name', $config['crud']['form_name']);   
        
        $container->setAlias('yv_transactional_email.transactional_email_manager', $config['service']['transactional_email_manager']);
        $container->setAlias('yv_transactional_email.transactional_email_mailer', $config['service']['transactional_email_mailer']);
    }
    
    private function createConfigParameterArray(array $config)
    {        
        return array(
            'email' => $config['email'],
        );
    }    
}
