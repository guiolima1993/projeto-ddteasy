<?php header('Content-Type: application/json; charset=utf-8');  
include('../sistema/config/config.php');


if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
    $id = clean($_REQUEST['id']);
}else{
    echo 0;
    exit;
}

$q = Query('SELECT * FROM servico_prestado WHERE Servico_prestado = "'.$id.'"');

if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);
    $q_emp = Query('SELECT * FROM parceiro WHERE Parceiro = "'.$r['Parceiro'].'"');
    $r_emp = mysqli_fetch_assoc($q_emp);
    
    $r['Parceiro'] = $r_emp['Titulo'];

    $q_ser = Query('SELECT * FROM servico WHERE Servico = "'.$r['Servico'].'"');
    $r_ser = mysqli_fetch_assoc($q_ser);

    $r['Servico'] = $r_ser['Titulo'];

    $r['Parceiro_id'] = $r_emp['Parceiro'];

    // var_dump($r);
    echo json_encode($r);
    exit;
}else{ 
    echo 0;
    exit;
} 