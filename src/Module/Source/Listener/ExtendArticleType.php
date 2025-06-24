<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Listener;

use YOOtheme\Builder\Source;
use ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;
use ZOOlanders\YOOtheme\J2Commerce\Module\Source\J2StoreHelper;

class ExtendArticleType
{
    /**
     * @param Source $source
     */
    public function handle($source): void
    {
        $source->objectType('Article', [
            'fields' => [
                'j2StoreProduct' => [
                    'metadata' => [
                        'label' => Type\ProductType::LABEL,
                        'group' => 'J2Store',
                    ],
                    'type' => Type\ProductType::NAME,
                    'extensions' => [
                        'call' => [
                            'func' => J2StoreHelper::class . '::resolveProduct',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
