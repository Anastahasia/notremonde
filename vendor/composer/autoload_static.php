<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit967ce1468f2e6ea194daf27dd5a41e78
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit967ce1468f2e6ea194daf27dd5a41e78::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit967ce1468f2e6ea194daf27dd5a41e78::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit967ce1468f2e6ea194daf27dd5a41e78::$classMap;

        }, null, ClassLoader::class);
    }
}