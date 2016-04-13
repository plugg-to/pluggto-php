<?php

namespace PluggTo\Lib\Order;

/**
* Interface to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

interface PluggInterfaceOrder
{

	public function getDataPreparedToPlugg();

	public function get();

	public function edit();

	public function add();

}