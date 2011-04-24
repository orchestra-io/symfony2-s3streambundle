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
namespace Orchestra\S3StreamBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle as BaseBundle;

/**
 * An S3 Stream Bundle
 *
 * This class (and its extension) are used to register a global
 * s3:// stream wrapper to allow developer to log their stuff
 * directly into S3.
 *
 * @link    https://orchestra.io
 * @package orchestra-io
 * @author  Orchestra Platform Ltd. <info@orchestra.io>
 */
class OrchestraS3StreamBundle extends BaseBundle
{
    /**
     * Register the S3 StreamHandler
     */
    public function boot()
    {
        \Services_Amazon_S3_Stream::register('s3', array(
            'access_key_id' => $this->container->getParameter('orchestra_s3_stream.access_key_id'),
            'secret_access_key' => $this->container->getParameter('orchestra_s3_stream.secret_access_key'),
            'acl' => $this->container->getParameter('orchestra_s3_stream.acl'),
        ));
    }
}
