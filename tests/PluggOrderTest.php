<?php

namespace PluggTo\Lib\Order;

class PluggOrderTest extends \PHPUnit_Framework_TestCase {

	protected $PluggOrder;

	public function setUp()
	{
        $this->PluggOrder = new PluggOrder();
        $this->PluggOrder->access_token = "d431a3852d5e89c55c2af51c0482357c290031b9";
	}

	public function testGetAllOrders()
	{
		$orders = $this->PluggOrder->get();

		$this->assertNotEmpty($orders->result[0]->Order->id);
	}

	public function testGetOrderByID()
	{
		$this->PluggOrder->id = '5702c3528fe95cbe1feeb3e9';

		$order = $this->PluggOrder->get();

		$this->assertEquals($order->Order->id, '5702c3528fe95cbe1feeb3e9');
		$this->assertEquals($order->Order->payer_email, 'hotmail@hotmail.com');
	}

	public function testAddOrder()
	{
		$this->PluggOrder->status 	= 'pending';
		$this->PluggOrder->total  	= 9.80;

		$order = $this->PluggOrder->add();

		$this->assertEquals($order->Order->total, 9.80);
	}

	public function testEditOrder()
	{
		$total = rand(1, 10);

		$this->PluggOrder->status   = 'waiting_invoice';
		$this->PluggOrder->total  	= $total;
		$this->PluggOrder->id 		= '5702c3528fe95cbe1feeb3e9';

		$order = $this->PluggOrder->edit();

		$this->assertEquals($order->Order->total, $total);		
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The status contain a value not allowed
     */
	public function testAddOrderWithStatusInvalid()
	{
		$this->PluggOrder->status 	= 'this not status valid';
		$this->PluggOrder->total  	= 9.80;

		$order = $this->PluggOrder->add();

		$this->assertEquals($order->Order->total, 9.80);		
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The status contain a type not allowed expected string
     */
	public function testAddOrderWithTypeStatusInvalid()
	{
		$this->PluggOrder->status 	= ['this not status valid'];
		$this->PluggOrder->total  	= 9.80;

		$order = $this->PluggOrder->add();

		$this->assertEquals($order->Order->total, 9.80);		
	}
}