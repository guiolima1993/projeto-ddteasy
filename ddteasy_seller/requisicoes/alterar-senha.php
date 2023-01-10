<?php include('../../sistema/config/config.php');

if (isset($_POST['id']) && $_POST['id'] != '') {
    if (isset($_POST['Senha_antiga']) && $_POST['Senha_antiga'] != '') {
        if (isset($_POST['Senha_nova']) && $_POST['Senha_nova'] != '') {
            if (isset($_POST['Repetir_senha']) && $_POST['Repetir_senha'] != '') {

                $id = clean($_POST['id']);
                $Senha_antiga = clean($_POST['Senha_antiga']);
                $Senha_nova = clean($_POST['Senha_nova']);
                $Repetir_senha = clean($_POST['Repetir_senha']);

                $q = Query('SELECT Senha FROM parceiro WHERE Parceiro = "' . $id . '"');
                $r = mysqli_fetch_assoc($q);

                if ($r['Senha'] == md5($Senha_antiga)) {
                    if (md5($Senha_nova) == md5($Repetir_senha)) {
                        Query('UPDATE parceiro SET Senha = "' . md5($Senha_nova) . '" WHERE Parceiro = "' . $id . '"');
                        echo 1;
                        exit;
                    } else {
                        echo 0;
                        exit;
                    }
                } else {
                    echo 0;
                    exit;
                }
            } else {
                echo 0;
                exit;
            }
        } else {
            echo 0;
            exit;
        }
    } else {
        echo 0;
        exit;
    }
}
