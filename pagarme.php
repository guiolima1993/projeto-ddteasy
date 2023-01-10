<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('vendor/autoload.php');
include('./sistema/config/config.php');  

// print_r($_POST);

// exit();

if (!isset($_POST['amount'])) {
    echo 'Informe o valor do pagamento';
    exit;
}
$amount = $_POST['amount'];

if (!isset($_POST['card_number'])) {
    echo 'Informe o número do cartão';
    exit;
}
$card_number = $_POST['card_number'];

if (!isset($_POST['card_holder_name'])) {
    echo 'Informe o nome do titular do cartão';
    exit;
}
$card_holder_name = $_POST['card_holder_name'];

if (!isset($_POST['card_expiration_date'])) {
    echo 'Informe a data de expiração do cartão';
    exit;
}
$card_expiration_date = $_POST['card_expiration_date'];
$card_expiration_date = str_replace('/', '', $card_expiration_date);

if (!isset($_POST['card_cvv'])) {
    echo 'Informe o código de segurança do cartão';
    exit;
}
$card_cvv = $_POST['card_cvv'];

if (!isset($_POST['customer_id'])) {
    echo 'Informe o id do cliente';
    exit;
}
$customer_id = $_POST['customer_id'];
$qCustomer = Query('SELECT * FROM cliente WHERE Cliente = '.$customer_id.'');
if (mysqli_num_rows($qCustomer) > 0) {
    $rCustomer = mysqli_fetch_assoc($qCustomer);
} else {
    echo 'Cliente não encontrado';
    exit;
}

if (!isset($_POST['service_id'])) {
    echo 'Informe o id do serviço';
    exit;
}
$service_id = $_POST['service_id'];
$qService = Query('SELECT * FROM parceiro WHERE Parceiro ='. $service_id);
$rService = mysqli_fetch_assoc($qService);

$address = explode(',', $rCustomer['Endereco']);
$street = $address[0];

$neighborhood = '';

if(isset($address[1])){

    $neighborhood = $address[1];
}

$cep = str_replace('-', '', $rCustomer['Cep']);
$cellphone = str_replace('(', '', $rCustomer['Telefone']);
$cellphone = str_replace(')', '', $cellphone);
$cellphone = str_replace('-', '', $cellphone);
$cellphone = str_replace(' ', '', $cellphone);

try {
    $pagarme = new PagarMe\Client('sk_E2PX3NkT9mU5zNQa');
    $transaction = $pagarme->transactions()->create([
        'amount' => $amount,
        'payment_method' => 'credit_card',
        'card_holder_name' => $card_holder_name,
        'card_cvv' => $card_cvv,
        'card_number' => $card_number,
        'card_expiration_date' => $card_expiration_date,
        'customer' => [
            'external_id' => $customer_id,
            'name' => $rCustomer['Titulo'],
            'type' => 'individual',
            'country' => 'br',
            'documents' => [
                [
                    'type' => 'cpf',
                    'number' => $rCustomer['Cpf'],
                ]
            ],
            'phone_numbers' => [ '+55'.$cellphone ],
            'email' => $rCustomer['Email']
        ],
        'billing' => [
            'name' => $rService['Titulo'],
            'address' => [
                'country' => 'br',
                'street' => $street,
                'street_number' => $rCustomer['Numero'],
                'state' => $rCustomer['Estado'],
                'city' => $rCustomer['Cidade'],
                'neighborhood' => $neighborhood,
                'zipcode' => $cep
            ]
        ],
        'items' => [
            [
                'id' => $service_id,
                'title' => $rService['Nome_empresa'],
                'unit_price' => $amount,
                'quantity' => 1,
                'tangible' => true
            ],
        ]
    ]);
    header('Content-Type: application/json; charset=UTF-8');

    if ($transaction && $transaction->status == 'paid') {
        echo json_encode('{"status": "success", "message": "Pagamento realizado com sucesso!", "id": "'.$transaction->id.'"}');
        exit;
    } else {
        $msg = str_replace('"', '\'', $transaction->acquirer_response_message);
        echo json_encode('{"status": "error", "message": "Pagamento não realizado!", "pagarme_response": "'.$msg.'"}');
        exit;
    }
} catch (Throwable $exception) {
    $msg = str_replace('"', '\'', $exception->getMessage());
    // $msg = preg_replace('/[^a-zA-Z0-9_ -]/s',' ', $msg);
    // echo json_encode('{"status": "error", "message": "Erro ao processar o pagamento!", "pagarme_response": "'.$msg.'"}');
    echo json_encode(['status' => 'error', 'message' => 'Erro ao processar o pagamento!', 'pagarme_response' => $msg]);
    exit;
}

?>