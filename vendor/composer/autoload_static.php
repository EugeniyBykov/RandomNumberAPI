<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit489a4aa91445649a215d63a4bbe2431c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phroute\\Phroute\\' => 16,
        ),
        'D' => 
        array (
            'Dice\\' => 5,
            'Database\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phroute\\Phroute\\' => 
        array (
            0 => __DIR__ . '/..' . '/phroute/phroute/src/Phroute',
        ),
        'Dice\\' => 
        array (
            0 => __DIR__ . '/..' . '/level-2/dice',
        ),
        'Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Database',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit489a4aa91445649a215d63a4bbe2431c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit489a4aa91445649a215d63a4bbe2431c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit489a4aa91445649a215d63a4bbe2431c::$classMap;

        }, null, ClassLoader::class);
    }
}