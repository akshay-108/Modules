<?php

namespace Mageplaza\AdminGrid3\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mageplaza_admingrid_post';

	protected $_cacheTag = 'mageplaza_admingrid_post';

	protected $_eventPrefix = 'mageplaza_admingrid_post';

	protected function _construct()
	{
		$this->_init('Mageplaza\AdminGrid3\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}


?>