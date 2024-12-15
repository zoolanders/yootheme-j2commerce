<?php

namespace ZOOlanders\YOOtheme\J2Store;

require_once __DIR__ . '/Listener/LoadSourceTypes.php';
require_once __DIR__ . '/Listener/ExtendArticleType.php';
require_once __DIR__ . '/Type/J2StoreProductType.php';

require_once(JPATH_ADMINISTRATOR . '/components/com_j2store/helpers/j2store.php');

return [

    'events' => [
        'source.init' => [
            Listener\LoadSourceTypes::class => '@handle',
            Listener\ExtendArticleType::class => ['@handle', -100],
        ]
    ]

];
