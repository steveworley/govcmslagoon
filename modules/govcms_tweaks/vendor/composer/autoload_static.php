<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1abd913cb380c63911f6ea84fb3a11c0
{
    public static $prefixesPsr0 = array (
        'G' => 
        array (
            'Govcms' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit1abd913cb380c63911f6ea84fb3a11c0::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
