<?php

namespace Mageplaza\PluginExample4\Plugin;

class ExamplePlugin
{

	public function beforeSetTitle(\Mageplaza\PluginExample4\Controller\Index\Example $subject, $title)
	{
		echo "Hello 1"."\n";
		$title = $title . " to ";
		echo __METHOD__ . "</br>";

		return [$title];
	}


	public function afterGetTitle(\Mageplaza\PluginExample4\Controller\Index\Example $subject, $result)
	{
		echo "Hello 5"."\n";

		echo __METHOD__ . "</br>";

		return '<h1>'. $result . 'kdshop.com' .'</h1>';

	}


	public function aroundGetTitle(\Mageplaza\PluginExample4\Controller\Index\Example $subject, callable $proceed)
	{
		echo "Hello 3"."\n";

		echo __METHOD__ . " - Before proceed() </br>";
		$result = $proceed();
		echo __METHOD__ . " - After proceed() </br>";
		
		return $result;
	}

}