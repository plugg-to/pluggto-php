<?php

namespace PluggTo\Lib\Order;

use PluggTo\Lib\PluggRequest;

use Exception;

/**
* Interface to connection API Plugg.To
* @author Reginaldo Junior 
* @copyright Copyright (c) ThirdLevel [http://www.thirdlevel.com.br]
**/

class PluggOrder extends ValidationOrderPlugg implements PluggInterfaceOrder
{

	public $id;
	public $external;
	public $original_id;
	public $channel;
	public $status;
	public $total;
	public $subtotal;
	public $shipping;
	public $discount;
	public $receiver_name;
	public $receiver_lastname;
	public $receiver_address;
	public $receiver_address_number;
	public $receiver_zipcode;
	public $receiver_address_complement;
	public $receiver_address_reference;
	public $receiver_additional_info;
	public $receiver_neighborhood;
	public $receiver_city;
	public $receiver_state;
	public $receiver_country;
	public $receiver_phone_area;
	public $receiver_phone;
	public $receiver_phone2_area;
	public $receiver_phone2;
	public $receiver_email;
	public $receiver_schedule_date;
	public $receiver_schedule_period;
	public $delivery_type;
	public $payer_name;
	public $payer_lastname;
	public $payer_address;
	public $payer_address_number;
	public $payer_zipcode;
	public $payer_address_complement;
	public $payer_address_reference;
	public $payer_additional_info;
	public $payer_neighborhood;
	public $payer_city;
	public $payer_state;
	public $payer_country;
	public $payer_phone_area;
	public $payer_phone;
	public $payer_phone2_area;
	public $payer_phone2;
	public $payer_email;
	public $payer_cpf;
	public $payer_cnpj;
	public $payer_razao_social;
	public $payer_ie;
	public $payer_gender;
	public $shipments;
	public $items;
	public $access_token;
	public $code;
	public $pluggRequest;

	public function __construct()
	{
		$this->pluggRequest = new PluggRequest;
	}

	public function getDataPreparedToPlugg()
	{
		$response = [
			'external' => $this->external,
			'status' => $this->status,
			'channel' => $this->channel,
			'original_id' => $this->original_id,
			'total' => $this->total,
			'subtotal' => $this->subtotal,
			'shipping' => $this->shipping,
			'discount' => $this->discount,
			'receiver_name' => $this->receiver_name,
			'receiver_lastname' => $this->receiver_lastname,
			'receiver_address' => $this->receiver_address,
			'receiver_address_number' => $this->receiver_address_number,
			'receiver_zipcode' => $this->receiver_zipcode,
			'receiver_address_complement' => $this->receiver_address_complement,
			'receiver_address_reference' => $this->receiver_address_reference,
			'receiver_additional_info' => $this->receiver_additional_info,
			'receiver_neighborhood' => $this->receiver_neighborhood,
			'receiver_city' => $this->receiver_city,
			'receiver_state' => $this->receiver_state,
			'receiver_country' => $this->receiver_country,
			'receiver_phone_area' => $this->receiver_phone_area,
			'receiver_phone' => $this->receiver_phone,
			'receiver_phone2_area' => $this->receiver_phone2_area,
			'receiver_phone2' => $this->receiver_phone2,
			'receiver_email' => $this->receiver_email,
			'receiver_schedule_date' => $this->receiver_schedule_date,
			'receiver_schedule_period' => $this->receiver_schedule_period,
			'delivery_type' => $this->delivery_type,
			'payer_name' => $this->payer_name,
			'payer_lastname' => $this->payer_lastname,
			'payer_address' => $this->payer_address,
			'payer_address_number' => $this->payer_address_number,
			'payer_zipcode' => $this->payer_zipcode,
			'payer_address_complement' => $this->payer_address_complement,
			'payer_address_reference' => $this->payer_address_reference,
			'payer_additional_info' => $this->payer_additional_info,
			'payer_neighborhood' => $this->payer_neighborhood,
			'payer_city' => $this->payer_city,
			'payer_state' => $this->payer_state,
			'payer_country' => $this->payer_country,
			'payer_phone_area' => $this->payer_phone_area,
			'payer_phone' => $this->payer_phone,
			'payer_phone2_area' => $this->payer_phone2_area,
			'payer_phone2' => $this->payer_phone2,
			'payer_email' => $this->payer_email,
			'payer_cpf' => $this->payer_cpf,
			'payer_cnpj' => $this->payer_cnpj,
			'payer_razao_social' => $this->payer_razao_social,
			'payer_ie' => $this->payer_ie,
			'payer_gender' => $this->payer_gender,
			'items' => $this->items,
		];
		
		if(isset($this->shipments) && !empty($this->shipments))
			$response['shipments'] = $this->shipments;

		$this->validate($response);

		$this->removeFieldsNull($response);

		return $response;
	}

	public function get()
	{
	    $url = "http://api.plugg.to/orders/" . trim($this->id);
	    
	    $method = "get";
	    
	    if (empty($this->access_token)) {
	    	$this->access_token = $this->pluggRequest->getAccesstoken($this->code);    	
	    }
	    
	    $url = $url . "?access_token=" . $this->access_token;
	    
	    $data = $this->pluggRequest->sendRequest($method, $url);
	    
	    return $data;
	}

	public function edit()
	{
	    $params = $this->getDataPreparedToPlugg();

	    $url = "http://api.plugg.to/orders/" . trim($this->id);
	    
	    $method = "put";
	    
	    if (empty($this->access_token)) {
	    	$this->access_token = $this->pluggRequest->getAccesstoken($this->code);    	
	    }
	    
	    $url = $url . "?access_token=" . $this->access_token;
	    
	    $data = $this->pluggRequest->sendRequest($method, $url, $params);
	    
	    return $data;
	}

	public function add()
	{
	    $params = $this->getDataPreparedToPlugg();

	    $url = "http://api.plugg.to/orders";
	    
	    $method = "post";
	    
	    if (empty($this->access_token)) {
	    	$this->access_token = $this->pluggRequest->getAccesstoken($this->code);    	
	    }
	    
	    $url = $url . "?access_token=" . $this->access_token;
	    
	    $data = $this->pluggRequest->sendRequest($method, $url, $params, "orders");
	    
	    return $data;
	}

}