<?php

namespace YOOtheme\Source\J2Store;

if (!defined('F0F_INCLUDED')) {
    include_once JPATH_LIBRARIES . '/f0f/include.php';
}

require_once __DIR__ . '/src/Listener/LoadSourceTypes.php';
require_once __DIR__ . '/src/Listener/ExtendArticleType.php';
require_once __DIR__ . '/src/Type/J2StoreProductType.php';

require_once(JPATH_ADMINISTRATOR . '/components/com_j2store/helpers/j2store.php');

return [

    'events' => [
        'source.init' => [
            Listener\LoadSourceTypes::class => '@handle',
            Listener\ExtendArticleType::class => ['@handle', -100],
        ]
    ]

];
