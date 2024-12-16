<?php

namespace ZOOlanders\YOOtheme\J2Store\Listener;

use J2Store;
use J2StoreTableProduct;
use YOOtheme\Builder\Source;
use ZOOlanders\YOOtheme\J2Store\Type;

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
                        'label' => Type\J2StoreProductType::LABEL,
                    ],
                    'type' => Type\J2StoreProductType::NAME,
                    'extensions' => [
                        'call' => [
                            'func' => __CLASS__ . '@resolveJ2StoreProduct',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public static function resolveJ2StoreProduct($article): J2StoreTableProduct
    {
        $table = J2Store::fof()->loadTable('Product', 'J2StoreTable');
        $model = \F0FModel::getTmpInstance('Products', 'J2StoreModel');

        $product = $table->get_product_by_source('com_content', $article->id);
        $product = $model->getProduct($product);

        return $product;
    }
}
