<?php
return [
    'sourceLanguage' => 'uk-UA',
    'language' => 'uk-UA',
    'timeZone' => 'Europe/Kiev',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],

        'formatter' => [
            'defaultTimeZone' => 'Europe/Kiev',
            'dateFormat'     => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i:s',
            'timeFormat'     => 'php:H:i:s',
            'currencyCode' => 'UAH',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
