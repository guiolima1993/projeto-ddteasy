<?php include('../sistema/config/config.php');

if(isset($_POST['id_servico']) && $_POST['id_servico']!=''){
    $Servico_prestado = clean($_POST['id_servico']);
}else{
    echo 0;
    exit;
}

if(isset($_POST['id_empresa']) && $_POST['id_empresa']!=''){
    $id_empresa = clean($_POST['id_empresa']);
}else{
    echo 0;
    exit;
}

if(isset($_POST['Nota']) && $_POST['Nota']!=''){
    $Nota = clean($_POST['Nota']);
}else{
    echo 0;
    exit;
}

if(isset($_POST['Comentario']) && $_POST['Comentario']!=''){
    $Comentario = clean($_POST['Comentario']);
}

$q = Query('SELECT * FROM servico_prestado WHERE Servico_prestado = "'.$Servico_prestado.'"');

if(mysqli_num_rows($q) > 0){
    $r = mysqli_fetch_assoc($q);

    //Query pra pegar o nome do cliente
    $q_cliente = Query('SELECT * FROM cliente WHERE Cliente = "'.$r['Cliente'].'"');
    $r_cliente = mysqli_fetch_assoc($q_cliente);


    //Converte a data pra string
    $oldDate = strtotime($r['Data']);
    $newDate = date('d/m/Y', $oldDate);
    $newDateStr = 
    
    //Da onde vem o "Pedido" e o "Colaborador"?
    $id = Query('INSERT INTO `avaliacao`(`Titulo`, `Cliente`, `Nota`, `Data`, `Parceiro`, `Url`, `Ativo`, `Pedido`, `Colaborador`, `Comentario`) VALUES ("'.$r_cliente['Titulo'].'","'.$r['Cliente'].'","'.$Nota.'","'.$newDate.'","'.$r['Parceiro'].'","'.removeAcentos($r_cliente['Titulo']).'", 1, "'.$Servico_prestado.'","'.$r['Colaborador'].'","'.$Comentario.'")');
    
    if($id != 0){
        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
    
}else{
    echo 2;
    exit;
}