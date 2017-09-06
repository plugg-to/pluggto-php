<?php

namespace PluggTo\Lib\Product;

use Exception;

/**
* AbstractClass to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

abstract class ValidationProductPlugg
{

	protected $rules = [
		'sku' => [
			'required' => true
		]
	];

	public function validate($input)
	{
		foreach ($input as $key => $value)
		{
			if (!isset($this->rules[$key]) && empty($this->rules[$key]))
				continue;

			if ($this->rules[$key]['required'] && empty($value))
				throw new Exception("The {$key} is required");				
		}
	}

	public function removeFieldsNull(&$input)
	{
		foreach ($input as $key => $value) 
		{
			if ((empty($value) || !isset($value)) && $value !== 0)
				unset($input[$key]);
		}
	}

}