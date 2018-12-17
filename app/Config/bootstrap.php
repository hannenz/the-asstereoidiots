<?php

define ('DEFAULT_LANGUAGE', 'eng');

CakePlugin::load('JsValidate');
CakePlugin::load('Recaptcha');
CakePlugin::load('Uploader');

ini_set('post_max_size', '16M');

Configure::load('Recaptcha.key');
setlocale(LC_ALL, "de_DE.UTF-8");

// Enable the Dispatcher filters for plugin assets, and
// CacheHelper.
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

// Add logging configuration.
CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));
