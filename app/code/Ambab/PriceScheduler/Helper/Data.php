<?php

namespace Ambab\PriceScheduler\Helper;

use Ambab\PriceScheduler\Model\ProductUploader;
class Data 
{
     /**
     * @var Ambab\PriceScheduler\Model\ProductUploader
     */
    protected $productupload;
    public function __construct(ProductUploader $productupload)
    {
        $this->productupload = $productupload;
    }
    public function Uploader()
    {
        $this->productupload->ProductUploader();
    }

    public function csvToJson($fname) {
        // open csv file
        if (!($fp = fopen($fname, 'r'))) {
            die("Can't open file...");
        }
        
        //read csv headers
        $key = fgetcsv($fp,"1024",",");
        
        // parse csv rows into array
        $json = array();
            while ($row = fgetcsv($fp,"1024",",")) {
            $json[] = array_combine($key, $row);
        }
        
        // release file handle
        fclose($fp);
        
        // encode array to json
        return json_encode($json);
    }
}
?>