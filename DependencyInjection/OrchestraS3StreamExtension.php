<?php

namespace Orchestra\S3StreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;

/**
 * OrchestraS3StreamExtension.
 *
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 * @author David Coallier <david@orchestra.io>
 */
class OrchestraS3StreamExtension extends \Symfony\Component\HttpKernel\DependencyInjection\Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor     = new Processor();
        $configuration = new Configuration();
        $config        = $processor->processConfiguration($configuration, $configs);

        foreach (array('access_key_id', 'secret_access_key', 'acl') as $field) {
            $container->setParameter($this->getAlias() . '.' . $field, $config[$field]);
        }
    }
}
