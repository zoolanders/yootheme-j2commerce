<?php

namespace ZOOlanders\YOOtheme\J2Store\Type;

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
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => self::LABEL,
            ],
        ];
    }
}
