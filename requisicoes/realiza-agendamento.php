<?php include('../sistema/config/config.php');  
  


  if(isset($_SESSION['Cliente']) && $_SESSION['Cliente']!=''){
    
    $cli_id =  $_SESSION['Cliente'];

    $q_cliente = Query('SELECT Cliente FROM cliente WHERE Cliente = '.$cli_id.'');
    
    if(mysqli_num_rows($q_cliente) > 0){
      $r_cliente = mysqli_fetch_assoc($q_cliente);
      

      $Periodo = "";
      if(isset($_POST['Periodo']) && $_POST['Periodo']!=''){
        $Periodo = clean($_POST['Periodo']);
      }

      $Horario = "";      
      if(isset($_POST['Horario']) && $_POST['Horario']!=''){
        $Horario = $_POST['Horario'];

        $Manha = array('7:00', '7:30', '8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30');
        $Tarde = array('12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30');
        $Noite = array('19:00', '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30');

        if(in_array($Horario, $Manha)){
          $Periodo = 'Manha';
        }else if (in_array($Horario, $Tarde)){
          $Periodo = 'Tarde';
        }else if (in_array($Horario, $Noite)) {
          $Periodo = 'Noite';          
        }
      }

      $Horario_especifico = "";      
      if(isset($_POST['Horario_especifico']) && $_POST['Horario_especifico']!=''){
        $Horario_especifico = clean($_POST['Horario_especifico']);
      }


      $Data_escolhida = "";      
      if(isset($_POST['Data_escolhida']) && $_POST['Data_escolhida']!=''){
        $Data_escolhida = clean($_POST['Data_escolhida']);
      }else{
        echo 'Data não informada';
        exit;
      }

      $Nome_responsavel = "";      
      if(isset($_POST['Nome_responsavel']) && $_POST['Nome_responsavel']!=''){
        $Nome_responsavel = clean($_POST['Nome_responsavel']);
      }else{
        echo 'Nome do responsável não informado';
        exit;
      }

      $Telefone_contato = "";      
      if(isset($_POST['Telefone_contato']) && $_POST['Telefone_contato']!=''){
        $Telefone_contato = clean($_POST['Telefone_contato']);
      }else{
        echo 'Nenhum telefone de contato foi enviado';
        exit;
      }

      $Mensagem = "";      
      if(isset($_POST['Mensagem']) && $_POST['Mensagem']!=''){
        $Mensagem = clean($_POST['Mensagem']);
      }


      $Cep = "";

      $Endereco_cliente = 0;

      if(isset($_POST['Cep']) && $_POST['Cep']!=''){
        $Cep = clean($_POST['Cep']);

      $Endereco = "";
      if(isset($_POST['Endereco']) && $_POST['Endereco']!=''){
        $Endereco = clean($_POST['Endereco']);
      }else{
        echo 0;
        exit;
      }

      $Bairro = "";
      if(isset($_POST['Bairro']) && $_POST['Bairro']!=''){
        $Bairro = clean($_POST['Bairro']);
      }else{
        echo 0;
        exit;
      }

      $Uf = "";
      if(isset($_POST['Estado']) && $_POST['Estado']!=''){
        $Uf = clean($_POST['Estado']);
      }else{
        echo 0;
        exit;
      }

      $Cidade = "";
      if(isset($_POST['Cidade']) && $_POST['Cidade']!=''){
        $Cidade = clean($_POST['Cidade']);
      }else{
        echo 0;
        exit;
      }

      $Numero = "";
      if(isset($_POST['Numero']) && $_POST['Numero']!=''){
        $Numero = clean($_POST['Numero']);
      }else{
        echo 0;
        exit;
      }


      $Complemento = "";
      if(isset($_POST['Complemento']) && $_POST['Complemento']!=''){
        $Complemento = clean($_POST['Complemento']);
      }

       $Endereco_cliente = Insert('INSERT INTO endereco_cliente(Titulo,Cep,Endereco,Bairro,Cidade,Estado,Numero,Complemento,Cliente) VALUES("'.$Nome_responsavel.'","'.$Cep.'","'.$Endereco.'","'.$Bairro.'","'.$Cidade.'","'.$Uf.'","'.$Numero.'","'.$Complemento.'",'.$_SESSION['Cliente'].')');




      }else{

            
        if(isset($_POST['Endereco_cliente']) && $_POST['Endereco_cliente']!=''){
          $Endereco_cliente = clean($_POST['Endereco_cliente']);
          
        }else{
          echo 87;
          exit;
        }

      }


        $r_seller = "";
        $q_seller  = Query('SELECT * FROM parceiro WHERE Parceiro =  '.$_SESSION['Parceiro_orcamento'].'',0);
        if(mysqli_num_rows($q_seller) > 0){
          $r_seller = mysqli_fetch_assoc($q_seller);
        }


        //print_r($_SESSION);


        //
       $servico_id = 0;

        if(isset($_SESSION['Servico_id']) &&  $_SESSION['Servico_id']!=''){
          $servico_id = clean($_SESSION['Servico_id'][0]);
        }else{
          echo 0;
          exit;
        }

        $tipo_imovel = 0;
        if(isset($_SESSION['Tipo_imovel']) &&  $_SESSION['Tipo_imovel']!=''){
          $tipo_imovel = clean($_SESSION['Tipo_imovel'][0]);
        }else{
          echo 0;
          exit;
        }

        $valor = 0;

        if($servico_id==2){
          $valor =  $r_seller['Dedetizacao_valor']; 
        }else if($servico_id==1){  
          $valor = $r_seller['Sanitizacao_valor']; 
        }

     


      $id = 0;

      //Data_agendamento

      $q_end = Query('SELECT * FROM endereco_cliente WHERE Endereco_cliente = '. $Endereco_cliente .'');
      $r_end = mysqli_fetch_assoc($q_end);

      if(empty($_POST['Cep'])){
        $Cep = $r_end['Cep'];
      }

      if(empty($_POST['Endereco'])){
        $Endereco = $r_end['Endereco'];
      }

      if(empty($_POST['Bairro'])){
        $Bairro = $r_end['Bairro'];
      }

      if(empty($_POST['Cidade'])){
        $Cidade = $r_end['Cidade'];
      }

      if(empty($_POST['Estado'])){
        $Uf = $r_end['Estado'];
      }

      if(empty($_POST['Numero'])){
        $Numero = $r_end['Numero'];
      }

      if(empty($_POST['Complemento'])){
        $Complemento = $r_end['Complemento'];
      }

      //$id = Insert('INSERT INTO servico_prestado(Servico,Data_agendamento,Cliente,Periodo,Horario,Nome_responsavel,Telefone_responsavel,Observacao,Data_abertura,Endereco_cliente,Parceiro,`Data`,Ativo,Valor) VALUES('.$servico_id.',NOW(),'.$r_cliente['Cliente'].',"'.$Periodo.'","'.$Horario.'","'.$Nome_responsavel.'","'.$Telefone_contato.'","'.$Mensagem.'",NOW(),'.$Endereco_cliente.','.$_SESSION['Parceiro_orcamento'].',NOW(),1,"'.$valor.'")');
      //$id = Insert('INSERT INTO servico_prestado(Servico,Data_agendamento,Cliente,Periodo,Horario,Nome_responsavel,Telefone_responsavel,Observacao,Data_abertura,Endereco_cliente,Parceiro,`Data`,Ativo,Valor,Tipo_imovel, Cep, Uf, Cidade) VALUES('.$servico_id.',NOW(),'.$r_cliente['Cliente'].',"'.$Periodo.'","'.$Horario.'","'.$Nome_responsavel.'","'.$Telefone_contato.'","'.$Mensagem.'",NOW(),'.$Endereco_cliente.','.$_SESSION['Parceiro_orcamento'].',NOW(),1,"'.$valor.'","'.$tipo_imovel.'","'.$Cep.'","'. $Uf .'","'. $Cidade .'")');
      $id = Insert('INSERT INTO servico_prestado(Servico,Data_agendamento,Cliente,Periodo,Horario,Nome_responsavel,Telefone_responsavel,Observacao,Data_abertura,Endereco_cliente,Parceiro,`Data`,Ativo,Valor,Tipo_imovel, Cep, Uf, Cidade) VALUES('.$servico_id.',"'.$Data_escolhida.'",'.$r_cliente['Cliente'].',"'.$Periodo.'","'.$Horario.'","'.$Nome_responsavel.'","'.$Telefone_contato.'","'.$Mensagem.'",NOW(),'.$Endereco_cliente.','.$_SESSION['Parceiro_orcamento'].',NOW(),1,"'.$valor.'","'.$tipo_imovel.'","'.$Cep.'","'. $Uf .'","'. $Cidade .'")');

      if($id!=0){
        echo 1;    
        exit;
      }else{
        echo 0; //AQUI
        exit;
      }




    }else{
      echo 0;
      exit;
    }

  }else{
    echo 'Informações incompletas';
    exit;
  }

