Autenticação e Requests
---------------

##Namespace 
    - PluggTo\Lib\PluggRequest;

##Atributos
    - public $CLIENT_ID    
    - public $CLIENT_SECRET
    - public $API_USER     
    - public $PASSWORD     
    - public $TYPE

##Metodos

    - public function getAccessToken($code=null) 
    - public function sendRequest($method, $url, $params=[])

##Exemplos

###Autenticação APP

Para autenticar um app são necessarios dois atributos obrigatorios, CLIENT_ID e CLIENT_SECRET, ambos devem ser adquiridos na plataforma pluggto, exemplo;

```
<?php 

use PluggTo\Lib\PluggRequest;

$this->pluggRequest->CLIENT_ID     = '5de98c314871a4f1970eb387e937db5c';
$this->pluggRequest->CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';

$token = $this->pluggRequest->getAccessToken("c597f2973dedbec63401381e7214d726383ff4ad");

```

OBS: Deve ser passado o codigo que vem atráves da url no parametro pluggtocode na função getAccessToken()


###Autenticação Plugin

Para autenticar um plugin são necessarios cinco atributos, CLIENT_ID, CLIENT_SECRET, API_USER, PASSWORD, TYPE, exemplo;

```
<?php 

use PluggTo\Lib\PluggRequest;

$this->pluggRequest->CLIENT_ID     = '5de98c314871a4f1970eb387e937db5c';
$this->pluggRequest->CLIENT_SECRET = '8f4074857cee508fa69f938a8f53ebad';
$this->pluggRequest->API_USER      = '1445461182';
$this->pluggRequest->PASSWORD      = 'anIuZGVzaWduXzffIwMTBAaG90bWFpbC5jb201NjI3ZmE2O'; 
$this->pluggRequest->TYPE          = 'PLUGIN';

$token = $this->pluggRequest->getAccessToken();

```

##Exceções

    - User credentials are invalid
    - Invalid or missing grant_type parameter
