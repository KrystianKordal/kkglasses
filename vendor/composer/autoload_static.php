<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit14f4aabefc9adb7f6010775cb45854c4
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ProductTools' => __DIR__ . '/../..' . '/classes/ProductTools.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit14f4aabefc9adb7f6010775cb45854c4::$classMap;

        }, null, ClassLoader::class);
    }
}
