<?php

define ('DEFAULT_LANGUAGE', 'eng');

CakePlugin::load('JsValidate');
CakePlugin::load('Recaptcha');
CakePlugin::load('Uploader');

ini_set('post_max_size', '16M');

Configure::load('Recaptcha.key');
setlocale(LC_ALL, "de_DE.UTF-8");
