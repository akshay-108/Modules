<?php
namespace Ambab\PriceScheduler\Model;
use Magento\Catalog\Api\SpecialPriceInterface;
use Magento\Catalog\Api\Data\SpecialPriceInterfaceFactory;

class ProductUploader
{
    /**
     * @var SpecialPriceInterface
     */
    protected $specialPrice;

    /**
     * @var SpecialPriceInterfaceFactory
     */
    protected $specialPriceFactory;
    /**
     * @var GridFactory
     */
    protected  $gridfactory;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;


    public function __construct(\Ambab\PriceScheduler\Model\GridFactory $gridfactory, 
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    \Magento\Framework\App\State $state,
    SpecialPriceInterface $specialPrice,
    SpecialPriceInterfaceFactory $specialPriceFactory)
    {
        $this->specialPrice = $specialPrice;
        $this->specialPriceFactory = $specialPriceFactory;
        $this->gridfactory = $gridfactory;
        $this->productRepository = $productRepository;
        $this->state = $state;
        
    }
    public function ProductLoader()
    {
        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // $objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
        // // print_r(get_class_methods($objDate));die;
        // echo $date = $objDate->date()."\n";
        // // echo $d= date();die;

        // $tz = 'Asia/Kolkata';
        // $timestamp = time();
        // $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        // $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        // echo $dt->format('d.m.Y, H:i:s');

        // $dt = new \DateTime('now', new \DateTimeZone('UTC'));

        // // change the timezone of the object without changing its time
        // $dt->setTimezone(new \DateTimeZone('Asia/Kolkata'));

        // // format the datetime
        // $currentTime = $dt->format('YmdHis');

        $myTimeZone = date_default_timezone_set("Asia/Kolkata");

        $date = date("YMDHis");
        //display the current date according to your location.
        echo $date;

        // $tz = new \DateTimeZone('Asia/Kolkata');
        // $date = new \DateTime('now');
        // $date->setTimezone($tz);
        // $currentTime = $date->format('YmdHis');

        // echo $currentTime = $date->getTimestamp();

        $duration =1;
        $customProduct = [];
        $customProduct = $this->gridfactory->create();  
        $collection = $customProduct->getCollection();
        // $collection->addFieldToFilter('is_applied', ['eq' => 0])
        // ->addFieldToFilter('main_table.start_time', [
        //     'from' => strtotime('-'.$duration.'hours', $currentTime),
        //     'to' => $currentTime,
        //     'datetime' => true,
        // ]);

        $collection->addFieldToFilter('is_applied', ['eq' => 0])
        ->addFieldToFilter('start_time' ,['from' => strtotime('-' . $duration . 'hours', $date), 'to' => $date, 'datetime' => true]);

        echo $collection->getSelect()->__toString();exit;

        echo count($collection)."\n";die;
        if(count($collection)>=1)
        {
            // retrived custom table collection
            foreach($collection as $item)
            {
                $customProduct = $item->getData();
                try {
                    // set area code
                    $this->setAreaCode('frontend');

                    // decode json product data to array
                    $customProduct['product_data'] = json_decode($customProduct['product_data']);
                    
                    foreach($customProduct['product_data'] as $product)
                    {
                        $this->productUpdater($product->sku,  $product->price, $product->special_price, $product->store_view_code);
                    }
                    $isApplied = $item->setIsApplied(1);
                    $isApplied->save();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }else{
            echo "Data Not Found"."\n";
        }
        
    }

    public function productUpdater($productSku, $productPrice, $productSpecialPrice, $productStoreViewCode)
    {
        try {
            $productEntity = $this->productRepository->get($productSku);
            $data = $this->updateProductPrice($productEntity, $productPrice, $productSpecialPrice);
        }
        catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateProductPrice($product, $basePrice, $specialPrice, $store = 0)
    {
        try {
            $sku = $product->getSku();
            $productId = $product->getIdBySku($sku);
            
            if (!$basePrice) {
                echo 'No Base price set - SKU: '.$sku;
                return false;
            }

            // base price
            $product->setPrice($basePrice);
            echo 'Base price set - SKU: '.$sku.' basePrice: '.$basePrice."\n";
        
            // special price
            if ($specialPrice && $specialPrice <= $basePrice) {
                $product->setSpecialPrice($specialPrice);
                echo 'Special price set - SKU: '.$sku.' specialPrice: '.$specialPrice."\n";
            }

            $temp = $product->save($product);
            echo 'saved successfully'."\n";

            return $product;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function setAreaCode($areaCode)
    {
        try {
            $this->state->setAreaCode($areaCode);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function reindexProduct($productId)              
    {
        $indexers = ['cataloginventory_stock',
                        //'inventory',
                        'catalogsearch_fulltext',
                        'catalog_product_price',
                    ];

        foreach ($indexers as $indexer) {
            $productIndexer = $this->indexerRegistry->get($indexer);

            if (!$productIndexer->isScheduled()) {
                try {
                    $productIndexer->reindexList([$productId]);
                    // $this->logIt('ProductId: ' . $productId . ' Reindexing: ' . $indexer);
                } catch (\Exception $e) {
                    echo $e->getMessage(); exit;
                }
            }
        }
    }
}


?>