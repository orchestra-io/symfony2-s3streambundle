<?php

namespace Orchestra\S3StreamBundle\Tests;

use Orchestra\S3StreamBundle\OrchestraS3StreamBundle;
use Orchestra\S3StreamBundle\DependencyInjection\OrchestraS3StreamExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OrchestraS3StreamBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterStreamWrapper()
    {
        if (false === class_exists('Services_Amazon_S3_Stream')) {
            $this->markTestIncomplete('Missing Services_Amazon_S3_Stream Pear package.');
        }

        $builder = new ContainerBuilder();
        $extension = new OrchestraS3StreamExtension();
        $extension->load(array(array(
            'access_key_id' => 'access-key-id',
            'secret_access_key' => 'secret-access-key',
        )), $builder);

        $bundle = new OrchestraS3StreamBundle();
        $bundle->setContainer($builder);
        $bundle->boot();

        $wrappers = stream_get_wrappers();
        $this->assertEquals('s3', array_pop($wrappers));
    }
}
