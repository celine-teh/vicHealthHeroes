<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5cf6cccc5e8cad1b325871bb4111f23d
{
    public static $files = array (
        '51587fe8e26f3ebb3d5df5460d75f00f' => __DIR__ . '/../..' . '/utils/graphina_chart_helper.php',
        '3ae223ce9a63335c53c96266dbef673b' => __DIR__ . '/../..' . '/utils/graphina_google_chart_helper.php',
        'ce929f603a38083e7fcac11f3c3d885e' => __DIR__ . '/../..' . '/utils/graphina_general_helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GraphinaElementor\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GraphinaElementor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/elementor',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5cf6cccc5e8cad1b325871bb4111f23d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5cf6cccc5e8cad1b325871bb4111f23d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}