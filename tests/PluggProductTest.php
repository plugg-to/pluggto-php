<?php

namespace PluggTo\Lib;

class PluggProductTest extends \PHPUnit_Framework_TestCase {

	protected $PluggProduct;

	public function setUp()
	{
        $this->PluggProduct = new PluggProduct();
	}

	public function testReturnCategoriesOnFormatPlugg()
	{
		$response = [
			['name' => 'Teste'],
			['name' => 'SubTeste'],
		];

		$this->PluggProduct->categories = $response;

		$this->assertEquals($this->PluggProduct->categoriesToPlugg()[0]['name'], 'Teste');
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Name category not defined
     */
	public function testReturnCategoriesOnFormatPluggWithError()
	{
		$response = [
			['Teste' => 'Teste'],
		];

		$this->PluggProduct->categories = $response;

		$this->assertFalse($this->PluggProduct->categoriesToPlugg(), 'Name category not defined');		
	}

	public function testGetJSONPreparedToPlugg()
	{
		$this->PluggProduct->categories = [['name' => 'Teste']];
		$this->PluggProduct->name = 'Teste';
		$this->PluggProduct->photos = [['url' => 'https://plugg.to/wp-content/uploads/2015/09/MercadoLivre.png']];
		$this->PluggProduct->sku = rand(1111, 99999);
		$this->PluggProduct->quantity = rand(1, 10);
		$this->PluggProduct->price = number_format(rand(1, 1000));
		$this->PluggProduct->dimension = ['weight' => 2];

		$this->assertEquals($this->PluggProduct->getDataPreparedToPlugg()['name'], 'Teste');
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage The name is required
     */
	public function testGetJSONPreparedToPluggExpectedException()
	{
		$this->PluggProduct->categories = [['name' => 'Teste']];
		$this->PluggProduct->photos = [['url' => 'https://plugg.to/wp-content/uploads/2015/09/MercadoLivre.png']];
		$this->PluggProduct->sku = rand(1111, 99999);
		$this->PluggProduct->quantity = rand(1, 10);
		$this->PluggProduct->price = number_format(rand(1, 1000));
		$this->PluggProduct->dimension = ['weight' => 2];

		$this->assertEquals($this->PluggProduct->getDataPreparedToPlugg()['name'], 'Teste');
	}

	public function testSendProductPlugg()
	{		
		$this->PluggProduct->categories = [['name' => 'Teste']];
		$this->PluggProduct->name = 'Teste';
		$this->PluggProduct->photos = [['url' => 'https://plugg.to/wp-content/uploads/2015/09/MercadoLivre.png']];
		$this->PluggProduct->sku = rand(1111, 99999);
		$this->PluggProduct->quantity = rand(1, 10);
		$this->PluggProduct->price = number_format(rand(1, 1000));
		$this->PluggProduct->dimension = ['weight' => 2];
		$this->PluggProduct->access_token = "99bdb9e87da095d5d95d1cfa30493b1e897eac6a";
		
		$response = $this->PluggProduct->sendProductToPlugg();
		
		$this->assertNotEmpty($response);
		$this->assertEquals($response->Product->name, 'Teste');
	}

}