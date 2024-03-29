<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb08daa3ac10a5f8b01a857a0b55ca0dc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb08daa3ac10a5f8b01a857a0b55ca0dc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb08daa3ac10a5f8b01a857a0b55ca0dc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb08daa3ac10a5f8b01a857a0b55ca0dc::$classMap;

        }, null, ClassLoader::class);
    }
}
