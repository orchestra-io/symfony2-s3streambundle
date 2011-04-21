# Orchestra S3 Stream Bundle

The Orchestra S3 Stream Bundle is merely a helper bundle for people that wish to use monolog
and save their symfony application logs directly into an S3 Bucket. 

It will create a global `s3://` stream wrapper that can be used with the usual `fopen`, `fwrite`, etc.


## Requirements

This bundle requires [Services_Amazon_S3](http://pear.php.net/Services_Amazon_S3). If you do not know where to put it,
look in the **vendor** directory of the [orchestra sample-symfony](https://github.com/orchestra-io/sample-symfony2) application. 
You should [see](https://github.com/orchestra-io/sample-symfony2/tree/master/vendor/pear) a `pear` folder with the required files (and its dependencies)

If you are developing locally, you might as well want to use the **pear installer** and run `pear install Services_Amazon_S3-alpha`. Keep in mind
that if you want to deploy your application on [Orchestra.io](http://orchestra.io) you will need to bundle your code in the **vendor** directory as
done in the sample-symfony2 application


## Install the bundle

Let's get started. 

Firstly, you need to retrieve the bundle:

    $> cd sf2app;
    $> git submodule add git://github.com/orchestra-io/symfony2-s3streambundle.git src/Orchestra/S3StreamBundle

Secondly, you have to configure the **YAML** in your **app/config/config.yml** as `access_key_id` and `secret_access_key` is **REQUIRED**.

    orchestra_s3_stream:
        access_key_id: XXX
        secret_access_key: YYY
        acl: public-read

Obviously you have to replace ***XXX*** and ***YYY*** with your Amazon S3 access key and secret
key information.

It is possible to change the default `acl` used. The different types can be seen in Services_Amazon_S3_AccessControlList.
By default it is `public-read`.

Finally, you have to add the **S3StreamBundle** to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Orchestra\S3StreamBundle\OrchestraS3StreamBundle(),
            // ...
        );
    }

and add the autoload for the Orchestra namespace:

    // app/autoload.php
    // snip...
    $loader->registerNamespaces(array(
        // ...
        'Orchestra'    => __DIR__.'/../src',
        // ...
    ));
    // snip...


## Using with Monolog

You will need to modify your **app/config/config_prod.yml** to contain the following:

    monolog:
        handlers:
            nested:
                type:  stream
                path:  s3://logs-bucket/%kernel.environment%.log
                level: debug

*Make sure to replace* **logs-bucket** *with your bucket name. The bucket has to exist.*


# License

This code is licensed under a 2-clause New BSD license which can be found in this repository under
the file `Resources/meta/LICENSE`
