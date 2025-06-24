<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

class ProductImageType
{
    public const NAME = 'J2StoreProductImage';
    public const LABEL = 'Product Image';

    public static function config(): array
    {
        return [
            'fields' => [
                'url' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'URL',
                    ],
                ],
                'alt_text' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Alt Text',
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => self::LABEL,
            ],
        ];
    }
}
