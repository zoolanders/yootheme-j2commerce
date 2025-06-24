<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

use J2Store;
use J2StoreTableProduct;

class ProductType
{
    public const NAME = 'J2StoreProduct';
    public const LABEL = 'Product';

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
                'sku' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'SKU',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveSku',
                    ],
                ],
                'upc' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'UPC',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveUpc',
                    ],
                ],
                'link' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Link',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveLink',
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
                'quantity' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => 'Stock Quantity',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveQuantity',
                    ],
                ],
                'thumb_image' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Thumbnail Image',
                    ],
                ],
                'thumb_image_alt' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Thumbnail Image Alt',
                        'filters' => ['limit'],
                    ],
                ],
                'main_image' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Main Image',
                    ],
                ],
                'main_image_alt' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Main Image Alt',
                        'filters' => ['limit'],
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
                'images' => [
                    'type' => [
                        'listOf' => ProductImageType::NAME,
                    ],
                    'metadata' => [
                        'label' => 'Product Images',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveImages',
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

    public static function resolveSku(J2StoreTableProduct $product): string
    {
        return $product->variant->sku ?? '';
    }

    public static function resolveUpc(J2StoreTableProduct $product): string
    {
        return $product->variant->upc ?? '';
    }

    public static function resolveQuantity(J2StoreTableProduct $product): int
    {
        return $product->variant->quantity ?? 0;
    }

    public static function resolveLink(J2StoreTableProduct $product): string
    {
        return $product->product_link ?? '';
    }

    public static function resolvePrice(J2StoreTableProduct $product): string
    {
        return J2Store::product()->displayPrice($product->pricing->base_price, $product);
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

    public static function resolveImages(J2StoreTableProduct $product): array
    {
        $images = json_decode($product->additional_images, true);
        $alt = json_decode($product->additional_images_alt, true);

        if (is_array($images) && is_array($alt)) {
            $result = [];

            foreach ($images as $key => $image) {
                $result[] = [
                    'url' => $image,
                    'alt_text' => $alt[$key] ?? '',
                ];
            }

            return $result;
        }

        return [];
    }

    protected static function toUIkit(string $html): string
    {
        // replace bootstrap class with UIkit
        $html = str_replace('btn btn-primary', 'uk-button uk-button-primary', $html);
        $html = str_replace('input-mini form-control', 'uk-input uk-form-small uk-form-width-xsmall', $html);

        return $html;
    }
}
