<?php
namespace Ambab\PriceScheduler\Model;

class ProductUploader
{
    protected  $gridfactory;
    protected $productRepository;
    public function __construct(\Ambab\PriceScheduler\Model\GridFactory $gridfactory, 
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository)
    {
        $this->gridfactory = $gridfactory;
        $this->productRepository = $productRepository;
        
    }
    public function ProductUploader()
    {
        $customProduct = [];
        $customProduct = $this->gridfactory->create();  
        $collection = $customProduct->getCollection();  
        foreach($collection as $item){
            $customProduct = $item->getData();
            // decode json product data to array
            $customProduct['product_data'] = json_decode($customProduct['product_data']);
            // print_r(array_column($customProduct['product_data'], 'sku'));
            // print_r($customProduct['product_data']);
            foreach($customProduct['product_data'] as $product)
            {
                $this->productUpdater($product->sku,  $product->price, $product->special_price, $product->store_view_code);

            }
		}
    }

    public function productUpdater($productSku, $productPrice, $productSpecialPrice, $productStoreViewCode)
    {
        $p = $this->productRepository;
        $p->get($productSku);
        print_r($p);
        die;
    }
}


?>