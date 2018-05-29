<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5c812060f8caf147b8e1da65c004e538
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wechat\\' => 7,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\Filesystem\\' => 29,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Cache\\' => 22,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wechat\\' => 
        array (
            0 => __DIR__ . '/..' . '/albertshen/wechat/src',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'Doctrine\\Common\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/cache/lib/Doctrine/Common/Cache',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/bundle',
    );

    public static $prefixesPsr0 = array (
        'N' => 
        array (
            'Neutron' => 
            array (
                0 => __DIR__ . '/..' . '/neutron/temporary-filesystem/src',
            ),
        ),
        'F' => 
        array (
            'FFMpeg' => 
            array (
                0 => __DIR__ . '/..' . '/php-ffmpeg/php-ffmpeg/src',
            ),
        ),
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
        'A' => 
        array (
            'Alchemy' => 
            array (
                0 => __DIR__ . '/..' . '/alchemy/binary-driver/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5c812060f8caf147b8e1da65c004e538::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5c812060f8caf147b8e1da65c004e538::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit5c812060f8caf147b8e1da65c004e538::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit5c812060f8caf147b8e1da65c004e538::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}