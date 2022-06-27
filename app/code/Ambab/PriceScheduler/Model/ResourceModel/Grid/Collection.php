<?php
namespace Ambab\PriceScheduler\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Ambab\PriceScheduler\Model\Grid', 'Ambab\PriceScheduler\Model\ResourceModel\Grid');
    }
}