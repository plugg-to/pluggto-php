<?php

namespace PluggTo\Lib\Product;

/**
* Interface to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

interface PluggInterfaceProduct
{

	public function getDataPreparedToPlugg();

	public function sendProductToPlugg();

	public function categoriesToPlugg();

}