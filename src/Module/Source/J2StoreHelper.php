<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source;

use F0FModel;
use J2Store;
use J2StoreTableProduct;

class J2StoreHelper
{
    public static function resolveProduct($article): ?J2StoreTableProduct
    {
        $table = J2Store::fof()->loadTable('Product', 'J2StoreTable');
        $model = F0FModel::getTmpInstance('Products', 'J2StoreModel');

        $product = $table->get_product_by_source('com_content', $article->id);

        if (!$product) {
            return null;
        }

        return $model->getProduct($product);
    }
}
