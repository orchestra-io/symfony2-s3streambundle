<?php
/**
 * Orchestra S3 Stream Bundle
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/orchestra-io/S3StreamBundle/Resources/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@orchestra.io so we can send you a copy immediately.
 */

namespace Orchestra\S3StreamBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Load up those good ol' PEAR files.
 */
require_once 'Services/Amazon/S3.php';
require_once 'Services/Amazon/S3/Stream.php';

/**
 * An S3 Stream Bundle Extension
 *
 * This extension registers a new s3:// stream that will allow developers
 * to hook directly into monolog's stream file logging. 
 *
 * To use simply add your <strong>access_key_id</strong> and <strong>secret_access_key</strong>
 * to your app/config/config.yml under the orchestra_s3_stream: configuration like such:
 *
 * <code>
 * orchestra_s3_stream:
 *     access_key_id: XXX
 *     secret_access_key: YYY
 * </code>
 *
 * For more information feel free to join us on irc://orchestra@freenode.org
 *
 * @link    https://orchestra.io
 * @package orchestra-io
 * @author  Orchestra Platform Ltd. <info@orchestra.io>
 */
class OrchestraS3StreamExtension extends Extension 
{
    /**
     * Load and build the extension
     *
     * This method is used to register and load the s3:// wrapper using
     * information retrieved from the app/config/config.yml file.
     *
     * @param  array $configs   A list of configuration from the config.yml file.
     * @param  ContainerBuilder A container builder object.
     * @return void
     */
    public function load (array $configs, ContainerBuilder $container) 
    {
        if (isset($configs['access_key_id']) && isset($configs['secret_access_key'])) {
            \Services_Amazon_S3_Stream::register('s3', 
                array(
                    'access_key_id'     => $configs['access_key_id'],
                    'secret_access_key' => $configs['secret_access_key'],
                    'acl'               => isset($configs['acl']) ? 
                                               $configs['acl'] : 'public-read',
                )
            );
        }
    }

    public function getAlias()
    {
        return 'orchestra_s3_stream';
    }
}
