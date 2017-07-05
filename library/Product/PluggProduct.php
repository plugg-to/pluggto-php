<?php

namespace PluggTo\Lib\Product;

use PluggTo\Lib\PluggRequest;

use Exception;

/**
* Class to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

class PluggProduct extends ValidationProductPlugg implements PluggInterfaceProduct
{
	public $user_id;
	public $categories;
	public $name;
	public $photos;
	public $attributes;
	public $variations;	
	public $sku;
	public $external;
	public $quantity;
	public $price;
	public $special_price;
	public $short_description;
	public $description;
	public $brand;
	public $ean;
	public $nbm;
	public $isbn;
	public $warranty_time;
	public $warranty_message;
	public $link;
	public $origin;
	public $available;
	public $handling_time;
	public $dimension;
	public $code;
	public $access_token;
	
	public function getDataPreparedToPlugg()
	{
		$response = [
			'name' 				=> $this->name,
			'sku'  				=> trim(str_replace('/', '-', $this->sku)),
			'external'  		=> $this->external,
			'quantity'  		=> $this->quantity,
			'price'				=> $this->price,
			'special_price' 	=> $this->special_price,
			'short_description' => $this->short_description,
			'description'		=> $this->description,
			'brand'				=> $this->brand,
			'ean'				=> $this->ean,
			'nbm'				=> $this->nbm,
			'isbn'				=> $this->isbn,
			'warranty_time'		=> $this->warranty_time,
			'warranty_message'	=> $this->warranty_message,
			'link'				=> $this->link,
			'origin'			=> $this->origin,
			'available'			=> $this->available,
			'handling_time'		=> $this->handling_time,
			'dimension'			=> $this->dimension,
			'photos'			=> $this->photosToPlugg(),
			'attributes'		=> $this->attributes,
			'variations'		=> $this->variations,
			'categories'		=> $this->categoriesToPlugg()
		];

		$this->validate($response);

		$this->removeFieldsNull($response);
		
		return $response;
	}

	public function categoriesToPlugg()
	{
		if (empty($this->categories) && !isset($this->categories))
			return null;

		$response = [];

		foreach ($this->categories as $i => $categorie)
		{
			if (is_object($categorie))
			{
				$categorie = objectToArray($categorie);
			}

			if (!isset($categorie['name']))
			{
         		throw new Exception('Name category not defined');
				break;
			}

			$response[] = [
				'name' => $categorie['name']
			];
		}			

		return $response;
	}

	public function photosToPlugg()
	{
		if (empty($this->photos) && !isset($this->photos))
			return null;

		$response = [];

		foreach ($this->photos as $i => $photo)
		{
			foreach ($photo as $key => $value) {
				if (strpos($value, 'http://') !== false || strpos($value, 'https://') !== false)
					$path = $value;
			}

			$response[] = [
				'url' => $path,
				'title' => $this->name,
				'order' => $i
			];
		}

		return $response;
	}

	public function sendProductToPlugg()
	{
		$pluggRequest = new PluggRequest;

	    $url = "http://api.plugg.to/skus/" . trim(str_replace('/', '-', $this->sku));
	    
	    $method = "put";
	    
	    if (empty($this->access_token)) {
	    	$this->access_token = $pluggRequest->getAccesstoken($this->code);    	
	    }
	    
	    $url = $url . "?access_token=" . $this->access_token;
	    
	    $params = $this->getDataPreparedToPlugg();
	    
	    $data = $pluggRequest->sendRequest($method, $url, $params);
	    
	    return $data;
	}

}