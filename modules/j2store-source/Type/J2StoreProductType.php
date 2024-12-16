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
                'price' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Price',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolvePrice',
                    ],
                ],
                'price_raw' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Price (Raw)',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveRawPrice',
                    ],
                ],
                'addtocart' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Add to Cart',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveAddToCart',
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

    public static function resolvePrice(J2StoreTableProduct $product): string
    {
        return \J2Store::product()->displayPrice($product->pricing->base_price, $product);
    }

    public static function resolveRawPrice(J2StoreTableProduct $product): string
    {
        return $product->pricing->price;
    }

    public static function resolveAddToCart(J2StoreTableProduct $product): string
    {
        $html = $product->get_product_cart_html();

        return self::toUIkit($html);
    }

    protected static function toUIkit(string $html): string
    {
        // replace bootstrap class with UIkit
        $html = str_replace('btn btn-primary', 'uk-button uk-button-primary', $html);
        $html = str_replace('input-mini form-control', 'uk-input uk-form-small uk-form-width-xsmall', $html);

        return $html;
    }
}
