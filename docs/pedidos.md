Pedidos
---------------

##Namespace 
    - PluggTo\Lib\Order;

##Atributos
    - public $id
    - public $external
    - public $status
    - public $total
    - public $subtotal
    - public $shipping
    - public $discount
    - public $receiver_name
    - public $receiver_lastname
    - public $receiver_address
    - public $receiver_address_number
    - public $receiver_zipcode
    - public $receiver_address_complement
    - public $receiver_address_reference
    - public $receiver_additional_info
    - public $receiver_neighborhood
    - public $receiver_city
    - public $receiver_state
    - public $receiver_country
    - public $receiver_phone_area
    - public $receiver_phone
    - public $receiver_phone2_area
    - public $receiver_phone2
    - public $receiver_email
    - public $receiver_schedule_date
    - public $receiver_schedule_period
    - public $delivery_type
    - public $payer_name
    - public $payer_lastname
    - public $payer_address
    - public $payer_address_number
    - public $payer_zipcode
    - public $payer_address_complement
    - public $payer_address_reference
    - public $payer_additional_info
    - public $payer_neighborhood
    - public $payer_city
    - public $payer_state
    - public $payer_country
    - public $payer_phone_area
    - public $payer_phone
    - public $payer_phone2_area
    - public $payer_phone2
    - public $payer_email
    - public $payer_cpf
    - public $payer_cnpj
    - public $payer_razao_social
    - public $payer_ie
    - public $payer_gender
    - public $shipments
    - public $items
    - public $access_token
    - public $code
    - public $pluggRequest

##Metodos

    - public add()
    - public edit()
    - public get()
    - public getDataPreparedToPlugg()


##Exemplos

###Adicionar Pedido

```
use PluggTo\Lib\Order;

$this->PluggOrder = new PluggOrder;

$this->PluggOrder->status   = 'pending';
$this->PluggOrder->total    = 9.80;

$order = $this->PluggOrder->add();
```

###Editar Pedido

```
use PluggTo\Lib\Order;

$this->PluggOrder = new PluggOrder;

$this->PluggOrder->id       = 'fjaosij34j0394024j2rlk';
$this->PluggOrder->status   = 'pending';
$this->PluggOrder->total    = 9.80;

$order = $this->PluggOrder->edit();
```

###Obter Pedido

```
use PluggTo\Lib\Order;

$this->PluggOrder = new PluggOrder;

$this->PluggOrder->id       = 'fjaosij34j0394024j2rlk';
$this->PluggOrder->status   = 'pending';
$this->PluggOrder->total    = 9.80;

$order = $this->PluggOrder->get();
```

###Obter Todos os Pedidos

```
use PluggTo\Lib\Order;

$this->PluggOrder = new PluggOrder;

$this->PluggOrder->status   = 'pending';
$this->PluggOrder->total    = 9.80;

$order = $this->PluggOrder->get();
```

##Exceções

    - The {$key} contain a type not allowed expected {$type}
        - A field não tem um tipo valido, verifique na documentação os tipos aceitos.
    - The {$key} contain a value not allowed
        - A field não contem um valor permitido
