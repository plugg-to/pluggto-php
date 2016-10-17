<?php

namespace PluggTo\Lib\Order;

use Exception;

/**
* AbstractClass to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

abstract class ValidationOrderPlugg
{

	protected $rules = [
		'status' => [
			'required' => true,
			'allowed'  => [
				'pending', 'paid', 'approved', 'waiting_invoice', 'invoiced', 'invoice_error', 'shipping_informed', 'shipped', 'shipping_error', 'delivered', 'canceled', 'under_review'
			],
			'type'     => 'string'
		]
	];

	public function validate($input)
	{
		foreach ($input as $key => $value)
		{
			if (!isset($this->rules[$key]) && empty($this->rules[$key]))
				continue;

			if (isset($this->rules[$key]['type']) && !empty($this->rules[$key]['type']))
				$this->validateTypeField($key, $value);

			if (isset($this->rules[$key]['allowed']) && !empty($this->rules[$key]))
				$this->validateFieldsAlloweds($key, $value);

			if ($this->rules[$key]['required'] && empty($value))
				throw new Exception("The {$key} is required");				
		}
	}

	public function validateTypeField($key, $value)
	{
		if ($this->rules[$key]['type'] == 'array')
			$response = is_array($value);

		if ($this->rules[$key]['type'] == 'string')
			$response = is_string($value);

		if ($this->rules[$key]['type'] == 'integer')
			$response = is_integer($value);

		if (!$response)
			throw new Exception("The {$key} contain a type not allowed expected " . $this->rules[$key]['type']);	

		return true;
	}

	public function validateFieldsAlloweds($key, $value)
	{
		if (!in_array($value, $this->rules[$key]['allowed']))
			throw new Exception("The {$key} contain a value not allowed");		

		return true;
	}

	public function removeFieldsNull(&$input)
	{
		foreach ($input as $key => $value) 
		{
			if (empty($value) || !isset($value))
				unset($input[$key]);
		}
	}

}