<?php
return [
    'name' => 'Alexey project',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        'db' => require(dirname(__DIR__)."/config/db.php"),

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
           'class' => 'yii\web\UrlManager', // ����� �� ������� ����� ����� ����� ����. ��� urlManager
           'enablePrettyUrl' => true, // �������, ��� ����� ������ � ��� ( ���������� �� index.php �����)
          'showScriptName' => false, // �������� �������� �� ��,����� �������� index.php
            'rules' => [
                'pages/<action_pages:(contact)>' => 'main/main/<action_pages>',
                'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
                'view-advert/<id:\d+>' => 'main/main/view-advert',
                'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'

            ],
        ],
    ],
];
