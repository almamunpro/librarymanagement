<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd211b111c5fec26aae9e4a6303d3d31e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd211b111c5fec26aae9e4a6303d3d31e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd211b111c5fec26aae9e4a6303d3d31e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd211b111c5fec26aae9e4a6303d3d31e::$classMap;

        }, null, ClassLoader::class);
    }
}
