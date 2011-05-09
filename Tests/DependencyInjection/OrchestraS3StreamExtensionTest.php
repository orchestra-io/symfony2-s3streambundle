<?php

namespace Orchestra\S3StreamBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Orchestra\S3StreamBundle\DependencyInjection\OrchestraS3StreamExtension;

class OrchestraS3StreamExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $config = array(
            'access_key_id' => 'expected-access-key-id',
            'secret_access_key' => 'expected-secret-access-key',
        );

        $expected = array(
            'access_key_id' => 'expected-access-key-id',
            'secret_access_key' => 'expected-secret-access-key',
            'acl' => 'public-read',
        );

        $builder = new ContainerBuilder();
        $extension = new OrchestraS3StreamExtension();
        $extension->load(array($config), $builder);

        foreach ($expected as $key => $value) {
            $this->assertEquals($value, $builder->getParameter('orchestra_s3_stream.' . $key));
        }
    }
}
