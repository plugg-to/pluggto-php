# [Namespace](#namespace)

``` PluggTo\Lib\Product\PluggProduct ```

# [Criar Produto](#add)

Segue exemplo do código

``` 
<?php

use PluggTo\Lib\Product\PluggProduct;

$PluggProduct = new PluggProduct;

$PluggProduct->categories = [['name' => 'Teste']];
$PluggProduct->name = 'Teste';
$PluggProduct->photos = [['url' => 'https://plugg.to/wp-content/uploads/2015/09/MercadoLivre.png']];
$PluggProduct->sku = rand(1111, 99999);
$PluggProduct->quantity = rand(1, 10);
$PluggProduct->price = number_format(rand(1, 1000));
$PluggProduct->dimension = ['weight' => 2];

$this->PluggProduct->sendProductToPlugg();

```

# [Editar Produto](#edit)

A edição é igual a edição porém, o dado comparado para edição é o sku, não esqueça dele.

``` 
<?php

use PluggTo\Lib\Product\PluggProduct;

$PluggProduct = new PluggProduct;

$PluggProduct->categories = [['name' => 'Teste']];
$PluggProduct->name = 'Teste';
$PluggProduct->photos = [['url' => 'https://plugg.to/wp-content/uploads/2015/09/MercadoLivre.png']];
$PluggProduct->sku = rand(1111, 99999);
$PluggProduct->quantity = rand(1, 10);
$PluggProduct->price = number_format(rand(1, 1000));
$PluggProduct->dimension = ['weight' => 2];

$this->PluggProduct->sendProductToPlugg();

```

# [Deletar Produto](#delete)

Sete o sku e chame a função delete(), exemplo;

``` 
<?php

use PluggTo\Lib\Product\PluggProduct;

$PluggProduct = new PluggProduct;

$PluggProduct->sku = 123;

$this->PluggProduct->delete();

```

# Outros campos

Para saber mais informações sobre outros campos disponiveis, acesse a documentação da API em http://plugg.to/api

# Exceptions

 - The {field} is required (A field especificada na exception não foi informado)
 - Name category not defined (O nome da categoria não foi informado)