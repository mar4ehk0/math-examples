<?php

use Symfony\Component\Dotenv\Dotenv;

define('ROOT_PATH', dirname(__DIR__) . '/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('SRC_PATH', ROOT_PATH . 'src/');
define('VAR_PATH', ROOT_PATH . 'var/');
define('VAR_CACHE_PATH', VAR_PATH . 'cache/');
define('VAR_TMP_PATH', VAR_PATH . 'tmp/');
define('TWIG_TEMPLATES_PATH', SRC_PATH . 'Infrastructure/View/RenderTwig/Template');


require ROOT_PATH . 'vendor/autoload.php';

if (!file_exists(__DIR__ . '/../.env')) {
    error_log('.env file not found');
    exit;
}

(new Dotenv())->usePutenv()->bootEnv(__DIR__ . '/../.env');

$containerBuilder = include CONFIG_PATH . '/container.php';
