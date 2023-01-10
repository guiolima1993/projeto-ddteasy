<?php include('../../sistema/config/config.php');

if (!isset($_POST['Razao_social']) || is_null($_POST['Razao_social'])) {
	die(0);
}
$razao_social = clean($_POST['Razao_social']);

if (!isset($_POST['Nome_fantasia']) || is_null($_POST['Nome_fantasia'])) {
	die(0);
}
$nome_fantasia = clean($_POST['Nome_fantasia']);


if (!isset($_POST['Cnpj']) || is_null($_POST['Cnpj'])) {
	die(0);
}
$cnpj = clean($_POST['Cnpj']);

if (!isset($_POST['Localizacao']) || is_null($_POST['Localizacao'])) {
	die(0);
}
$localizacao = clean($_POST['Localizacao']);

if (!isset($_POST['Telefone']) || is_null($_POST['Telefone'])) {
	die(0);
}
$telefone = clean($_POST['Telefone']);

if (!isset($_POST['Email']) || is_null($_POST['Email'])) {
	die(0);
}
$email = clean($_POST['Email']);


if (!isset($_POST['Local_atendimento']) || is_null($_POST['Local_atendimento'])) {
	die(0);
}
$local_atendimento = clean($_POST['Local_atendimento']);


if (!isset($_POST['Horario_inicial']) || is_null($_POST['Horario_inicial'])) {
	die(0);
}
$horario_inicial = clean($_POST['Horario_inicial']);

if (!isset($_POST['Horario_final']) || is_null($_POST['Horario_final'])) {
	die(0);
}
$horario_final = clean($_POST['Horario_final']);

if (!isset($_POST['Descricao']) || is_null($_POST['Descricao'])) {
	die(0);
}
$descricao = clean($_POST['Descricao']);

if (!isset($_POST['Tamanho']) || is_null($_POST['Tamanho'])) {
	die(0);
}
$tamanho = clean($_POST['Tamanho']);

if (!isset($_POST['Proximidade']) || is_null($_POST['Proximidade'])) {
	die(0);
}
$proximidade = clean($_POST['Proximidade']);

$id = clean($_POST['id']);

$dedetizacao = 0;
$dedetizacao_valor = '';
if (isset($_POST['Dedetizacao']) && $_POST['Dedetizacao'] == 1) {
	$dedetizacao = 1;
	$dedetizacao_valor = $_POST['Preco-dedetizacao'];
}

$dedetizacao_premiuw = 0;
$dedetizacao_premiuw_valor = '';
if (isset($_POST['Dedetizacao_premiuw']) && $_POST['Dedetizacao_premiuw'] == 1) {
	$dedetizacao_premiuw = 1;
	$dedetizacao_premiuw_valor = $_POST['Preco-dedetizacao-premium'];
}


$sanitizacao = 0;
$sanitizacao_valor = '';
if (isset($_POST['Sanitizacao']) && $_POST['Sanitizacao'] == 1) {
	$sanitizacao = 1;
	$sanitizacao_valor = $_POST['Preco-sanitizacao'];
}

$sanitizacao_premiuw = 0;
$sanitizacao_premiuw_valor = '';
if (isset($_POST['Sanitizacao_premiuw']) && $_POST['Sanitizacao_premiuw'] == 1) {
	$sanitizacao_premiuw = 1;
	$sanitizacao_premiuw_valor = $_POST['Preco-sanitizacao-premium'];
}

// Query('UPDATE parceiro SET  
// Horario_inicial = "' . clean($_POST['Horario_inicial']) . '", 
// Horario_final = "' . clean($_POST['Horario_final']) . '", 
// Local_atendimento = "' . clean($_POST['Local_atendimento']) . '", 
// Titulo = "' . clean($_POST['Nome_fantasia']) . '", 
// Nome_fantasia = "' . clean($_POST['Nome_fantasia']) . '", 
// Cnpj = "' . clean($_POST['Cnpj']) . '", 
// Localizacao = "' . clean($_POST['Localizacao']) . '", 
// Telefone = "' . clean($_POST['Telefone']) . '", 
// Email = "' . clean($_POST['Email']) . '", 
// Razao_social = "' . clean($_POST['Razao_social']) . '", 
// Descricao = "' . clean($_POST['Descricao']) . '", 
// Dedetizacao =' . $dedetizacao . ', 
// Dedetizacao_premiuw =' . $dedetizacao_premiuw . ', 
// Sanitizacao=' . $sanitizacao . ', 
// Sanitizacao_premium=' . $sanitizacao_premiuw . ', 
// Tamanho = ' . clean($_POST['Tamanho']) . ', 
// Proximidade = ' . clean($_POST['Proximidade']) . ' 
// WHERE Parceiro = ' . $_SESSION['Parceiro'] . '');

Query("UPDATE parceiro SET
Horario_inicial = '$horario_inicial', 
Horario_final = '$horario_final', 
Local_atendimento = '$local_atendimento', 
Titulo = '$nome_fantasia', 
Nome_fantasia = '$nome_fantasia', 
Cnpj = '$cnpj', 
Localizacao = '$localizacao', 
Telefone = '$telefone', 
Email = '$email', 
Razao_social = '$razao_social', 
Descricao = '$descricao', 
Dedetizacao = '$dedetizacao',
Dedetizacao_valor = '$dedetizacao_valor', 
Dedetizacao_premiuw = '$dedetizacao_premiuw', 
Dedetizacao_premiuw_valor = '$dedetizacao_premiuw_valor',
Sanitizacao = '$sanitizacao',
Sanitizacao_valor = '$sanitizacao_valor',
Sanitizacao_premiuw = '$sanitizacao_premiuw',
Sanitizacao_premiuw_valor = '$sanitizacao_premiuw_valor',
Sanitizacao_premium = '$sanitizacao_premiuw', 
Sanitizacao_premium_valor = '$sanitizacao_premiuw_valor', 
Tamanho = '$tamanho', 
Proximidade = '$proximidade'
WHERE Parceiro = '{$_SESSION['Parceiro']}';");

$curriculo = '';

if (isset($_FILES['Foto']['tmp_name']) && ($_FILES['Foto']['tmp_name'] != '') && ($_FILES['Foto']['type'] != 'application/octet-stream')) {
	$destino = '../../imagens/parceiro/';

	if (!is_dir($destino)) {
		mkdir($destino);
	}

	$destino = '../../imagens/parceiro/200/';

	if (!is_dir($destino)) {
		mkdir($destino);
	}

	$name_aux = explode('.', $_FILES['Foto']['name']);
	$ext = end($name_aux);
	$better_token = md5(uniqid(rand(), true));
	$new_name = $better_token . '.' . $ext;
	$destino .= $new_name;

	if (move_uploaded_file($_FILES['Foto']['tmp_name'], $destino)) {
		Query("UPDATE parceiro SET Imagem = '$new_name' WHERE Parceiro = {$_SESSION['Parceiro']};");
	}
}

echo 1;
exit;


// Deixando de lembrança:

// if (isset($_POST['Razao_social']) && $_POST['Razao_social'] != '') {
// 	if (isset($_POST['Nome_fantasia']) && $_POST['Nome_fantasia'] != '') {
// 		if (isset($_POST['Cnpj']) && $_POST['Cnpj'] != '') {
// 			if (isset($_POST['Localizacao']) && $_POST['Localizacao'] != '') {
// 				if (isset($_POST['Telefone']) && $_POST['Telefone'] != '') {
// 					if (isset($_POST['Email']) && $_POST['Email'] != '') {
// 						if (isset($_POST['Local_atendimento']) && $_POST['Local_atendimento'] != '') {
// 							if (isset($_POST['Horario_inicial']) && $_POST['Horario_inicial'] != '') {
// 								if (isset($_POST['Horario_final']) && $_POST['Horario_final'] != '') {
// 									if (isset($_POST['Descricao']) && $_POST['Descricao'] != '') {
// 										if (isset($_POST['Tamanho']) && $_POST['Tamanho'] != '') {
// 											if (isset($_POST['Proximidade']) && $_POST['Proximidade'] != '') {

// 												$id = clean($_POST['id']);
// 												$dedetizacao = 0;

// 												if (isset($_POST['Dedetizacao']) && $_POST['Dedetizacao'] == 1) {
// 													$dedetizacao = 1;
// 												}

// 												$dedetizacao_premiuw = 0;
// 												if (isset($_POST['Dedetizacao_premiuw']) && $_POST['Dedetizacao_premiuw'] == 1) {
// 													$dedetizacao_premiuw = 1;
// 												}


// 												$sanitizacao = 0;
// 												if (isset($_POST['Sanitizacao']) && $_POST['Sanitizacao'] == 1) {
// 													$sanitizacao = 1;
// 												}

// 												$sanitizacao_premiuw = 0;
// 												if (isset($_POST['Sanitizacao_premiuw']) && $_POST['Sanitizacao_premiuw'] == 1) {
// 													$sanitizacao_premiuw = 1;
// 												}


// 												Query('UPDATE parceiro SET  Horario_inicial = "' . clean($_POST['Horario_inicial']) . '", Horario_final = "' . clean($_POST['Horario_final']) . '",Local_atendimento = "' . clean($_POST['Local_atendimento']) . '",Titulo = "' . clean($_POST['Nome_fantasia']) . '",Nome_fantasia = "' . clean($_POST['Nome_fantasia']) . '",Cnpj = "' . clean($_POST['Cnpj']) . '",Localizacao = "' . clean($_POST['Localizacao']) . '",Telefone = "' . clean($_POST['Telefone']) . '",Email = "' . clean($_POST['Email']) . '",Razao_social = "' . clean($_POST['Razao_social']) . '",Descricao = "' . clean($_POST['Descricao']) . '",Dedetizacao =' . $dedetizacao . ',Dedetizacao_premiuw =' . $dedetizacao_premiuw . ',Sanitizacao=' . $sanitizacao . ',Sanitizacao_premium=' . $sanitizacao_premiuw . ',Tamanho = ' . clean($_POST['Tamanho']) . ',Proximidade = ' . clean($_POST['Proximidade']) . '  WHERE  Parceiro = ' . $_SESSION['Parceiro'] . '');


// 												$curriculo = '';

// 												if (isset($_FILES['Foto']['tmp_name']) && ($_FILES['Foto']['tmp_name'] != '') && ($_FILES['Foto']['type'] != 'application/octet-stream')) {
// 													$destino = '../../imagens/parceiro/';

// 													if (!is_dir($destino)) {
// 														mkdir($destino);
// 													}

// 													$destino = '../../imagens/parceiro/200/';

// 													if (!is_dir($destino)) {
// 														mkdir($destino);
// 													}

// 													$name_aux = explode('.', $_FILES['Foto']['name']);
// 													$ext = end($name_aux);
// 													$better_token = md5(uniqid(rand(), true));
// 													$new_name = $better_token . '.' . $ext;
// 													$destino .= $new_name;

// 													if (move_uploaded_file($_FILES['Foto']['tmp_name'], $destino)) {
// 														Query('UPDATE parceiro SET Imagem = "' . $new_name . '" WHERE Parceiro = ' . $_SESSION['Parceiro'] . '');
// 													}
// 												}


// 												echo 1;
// 												exit;
// 											}
// 										}
// 									}
// 								}
// 							}
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
// }