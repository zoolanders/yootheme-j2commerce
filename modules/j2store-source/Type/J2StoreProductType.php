<?php

namespace ZOOlanders\YOOtheme\J2Store\Type;

use J2StoreTableProduct;

class J2StoreProductType
{
    public const NAME = 'J2StoreProduct';
    public const LABEL = 'J2Store Product';

    public static function config(): array
    {
        return [
            'fields' => [
                'id' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => 'ID',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveId',
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => self::LABEL,
            ],
        ];
    }

    public static function resolveId(J2StoreTableProduct $product): int
    {
        return $product->j2store_product_id;
    }
}
