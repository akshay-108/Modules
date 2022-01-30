<?php
namespace Practice\ProxieCli\Model;

class HeavyService 
{
    public function __construct()
    {
        echo "Heavy service has been instantiated";
    }

    public function printHeavyServiceMessage()
    {
        echo "Heavy service is used";
    }
}



?>