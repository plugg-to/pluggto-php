<?php

namespace PluggTo\Lib;

class PluggRequestTest extends \PHPUnit_Framework_TestCase {

	protected $pluggRequest;

	public function setUp()
	{
		$this->pluggRequest = new PluggRequest;
	}

	public function testGetAccessTokenOfAnApp()
	{
		$this->pluggRequest->TYPE 		   = 'APP';
		$this->pluggRequest->CLIENT_ID 	   = '5de98c314871a4f1970eb387e937db5c';
		$this->pluggRequest->CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';

		$token = $this->pluggRequest->getAccessToken("c597f2973dedbec63401381e7214d726383ff4ad");

		$this->assertEquals(40, strlen($token));
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage User credentials are invalid
     */
	public function testGetAccessTokenOfAnPlugin()
	{
		$this->pluggRequest->CLIENT_ID 	   = '5de98c314871a4f1970eb387e937db5c';
		$this->pluggRequest->CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';
    	$this->pluggRequest->API_USER      = '1445461182';
		$this->pluggRequest->PASSWORD      = 'anIuZGVzaWduXzffIwMTBAaG90bWFpbC5jb201NjI3ZmE2O';	
		$this->pluggRequest->TYPE	       = 'PLUGIN';

		$token = $this->pluggRequest->getAccessToken();

		$this->assertEquals(40, strlen($token));
	}

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage User credentials are invalid
     */
	public function testGetAccessTokenWithKeysInvalid()
	{
		$this->pluggRequest->CLIENT_ID 	   = '5de98c314871a4f1970eb387e937db5c';
		$this->pluggRequest->CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';
    	$this->pluggRequest->API_USER      = '1445461182';
		$this->pluggRequest->PASSWORD      = 'fadfasdfasd';	
		$this->pluggRequest->TYPE	       = 'PLUGIN';

		$token = $this->pluggRequest->getAccessToken();
	}

}