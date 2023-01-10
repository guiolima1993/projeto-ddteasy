<?php $_password = true ?>
<?php include('header.php');

$cep = '';
$servico_id = '';

$_SESSION['cep'] = "";

if (isset($_GET['Cep']) && $_GET['Cep'] != '') {
    $cep = clean($_GET['Cep']);
    $_SESSION['cep'] = $cep;
} else {
    goHome();
}

$servico_where = '';


$get = "";


if (isset($_GET['Tipo_de_servico']) && $_GET['Tipo_de_servico'] != '') {
    $tipo_de_servico = clean($_GET['Tipo_de_servico']);


    $get = "Tipo_de_servico=" . $tipo_de_servico . "&";

    if ($tipo_de_servico == 'dedetizacao') {
        $servico_where = 'Dedetizacao  = 1 ';
        $servico_id = 2;
        $_SESSION['Servico_id'] = 2;
    } else if ($tipo_de_servico == 'sanitizacao') {
        $servico_where = 'Sanitizacao  = 1 ';
        $servico_id = 1;
        $_SESSION['Servico_id'] = 1;
    } else {
        goHome();
    }
} else {
    goHome();
}

$_SESSION['servico_id'] = $servico_id;



$_SESSION['Tipo_de_praga'] = array();
$tipos_de_praga = array();


$numero_de_pragas = 0;

if (isset($_GET['Tipo_de_praga']) && $_GET['Tipo_de_praga'] != '') {

    foreach ($_GET['Tipo_de_praga'] as $k => $v) {
        $_SESSION['Tipo_de_praga'][] = $v;
        $tipos_de_praga[] = $v;
        $get .= "Tipo_de_praga[]=" . $v . "&";
        $numero_de_pragas++;
    }
} else {
    goHome();
}

$_SESSION['Numero_de_pragas'] = $numero_de_pragas;



$_SESSION['Tipo_imovel'] = "";

if (isset($_GET['Tipo_imovel']) && $_GET['Tipo_imovel'] != '') {
    $Tipo_imovel = clean($_GET['Tipo_imovel']);
    $get .= "Tipo_imovel=" . $Tipo_imovel . "&";
    $_SESSION['Tipo_imovel'] = $Tipo_imovel;
}



$_SESSION['Tamanho_imovel'] = "";

if (isset($_GET['Tamanho_imovel']) && $_GET['Tamanho_imovel'] != '') {
    $Tamanho_imovel = clean($_GET['Tamanho_imovel']);
    $get .= "Tamanho_imovel=" . $Tamanho_imovel . "&";
    $_SESSION['Tamanho_imovel'] = $Tamanho_imovel;
}

$_SESSION['Dormitorios'] = "";

if (isset($_GET['Dormitorios']) && $_GET['Dormitorios'] != '') {
    $Dormitorios = clean($_GET['Dormitorios']);
    $get .= "Dormitorios=" . $Dormitorios . "&";
    $_SESSION['Dormitorios'] = $Dormitorios;
}


$Ordem_text = "";
$Ordem = 'ORDER BY Parceiro DESC';

if (isset($_GET['Ordem']) && $_GET['Ordem'] != '') {

    $Ordem_text = clean($_GET['Ordem']);


    if ($Ordem_text == 'Avaliacao') {
        $Ordem = ' ORDER BY Nota_avaliacao_geral DESC ';
    } else if ($Ordem_text == 'Preco') {
        $Ordem = ' ORDER BY Valor_diaria ASC ';
    } else if ($Ordem_text == 'Distancia') {
        $Ordem = ' ORDER BY Parceiro DESC ';
    }
}





?>


<div class="background-type-work p-3">
    <div id="headerFixed" class="header-fixed">
        <div class="header-type-work">

            <div class="info-filter-search">

                <div class="selected-service">
                    <div class="type-service">
                        <h3>Dedetização</h3>
                        <div class="d-flex">
                            <p><?php echo $_SESSION['Numero_de_pragas'];    ?> pragas ></p>
                            <p>
                                <?php
                                $q_tipo_imovel = Query('SELECT Titulo FROM tipo_imovel WHERE Ativo = 1 AND Tipo_Imovel = ' . $_SESSION['Tipo_imovel'], 1);
                                echo $q_tipo_imovel['Titulo'];
                                ?> ></p>
                            <p><?php echo $_SESSION['Tamanho_imovel'];    ?></p>
                        </div>
                    </div>



                    <div class="address-filter-selected">
                        <div class="icon-location mb-3">
                            <img src="images/location-outline.svg" alt="icon-location">
                        </div>
                        <div class="result-info-filter">
                            <p><?php echo $_SESSION['cep'];    ?></p>
                        </div>
                    </div>
                    <div class="button-edit-search">
                        <div class="mb-3 pr-3 pl-3">
                            <button type="button" data-toggle="modal" data-target="#modalfilter" class="btn">Editar</button>
                        </div>
                    </div>


                </div>

                <!-- Modal -->
                <div class="modal fade modal-edit-filter" id="modalfilter" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Trocar Filtro de Busca</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-service">

                                    <form id="form" class="filter-especialista" method="GET" action="filtro-especialista.php">
                                        <!--<input type="hidden" name="Tipo_de_servico" value="dedetizacao">-->

                                        <div class="type-select-service col-md-12">
                                            <div class="description">
                                                <span>Tipo de Serviço</span>
                                            </div>
                                            <div class="select-home-background">
                                                <select id="select-service" name="Tipo_de_servico">
                                                    <option selected value="">Selecione</option>
                                                    <option value="dedetizacao">Dedetização</option>
                                                    <option value="sanitizacao">Sanitização</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="type-prague-det col-md-12 active-det">
                                            <div class="description">
                                                <span>Tipo de Praga</span>
                                            </div>
                                            <div class="super-select">
                                                <button type="button" class="select-prague"><img src="images/ddteasy-images/chevron-down-outline.svg">
                                                    Selecionados: <b class="selected">0</b></button>
                                                <div class="super-select-component">
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" value="insetos_voadores">
                                                        <i class="fa fa-square"></i> Baratas
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="insetos_rasteiros">
                                                        <i class="fa fa-square"></i> Formigas
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="roedores">
                                                        <i class="fa fa-square"></i> Mosquitos
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="outras_pragas">
                                                        <i class="fa fa-square"></i> Traças
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="outras_pragas">
                                                        <i class="fa fa-square"></i> Cupins
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="outras_pragas">
                                                        <i class="fa fa-square"></i> Ratos
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="outras_pragas">
                                                        <i class="fa fa-square"></i> Prevenção
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" id="outras_pragas">
                                                        <i class="fa fa-square"></i> Outros...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="type-prague-san col-md-12">
                                            <div class="description">
                                                <span>Necessidade</span>
                                            </div>
                                            <div class="super-select">
                                                <button type="button" class="select-prague"><img src="images/ddteasy-images/chevron-down-outline.svg">
                                                    Selecionados: <b class="selected">0</b></button>
                                                <div class="super-select-component">
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" class="input-identify" data-value="Prevenção" value="insetos_voadores">
                                                        <i class="fa fa-square"></i> Prevenção
                                                    </div>
                                                    <div class="super-select-checkbox">
                                                        <input type="checkbox" name="Tipo_de_praga[]" class="input-identify" data-value="Tive contato" id="insetos_rasteiros">
                                                        <i class="fa fa-square"></i> Desinfecção
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="type-home col-md-12">
                                            <div class="description">
                                                <span>Tipo de imóvel</span>
                                            </div>
                                            <div class="select-home-background">
                                                <select id="residencia" name="Tipo_imovel" class="select-home" required>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    $q_tipo_imovel = Query('SELECT * FROM tipo_imovel WHERE Ativo = 1 order by Tipo_imovel ASC');
                                                    if (mysqli_num_rows($q_tipo_imovel) > 0) {
                                                        while ($r_tipo_imovel = mysqli_fetch_assoc($q_tipo_imovel)) {
                                                    ?>
                                                            <option value="<?php echo $r_tipo_imovel['Tipo_imovel'];    ?>"><?php echo $r_tipo_imovel['Titulo'];    ?></option>
                                                    <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="size-home col-md-12 active">
                                            <div class="description">
                                                <span>Tamanho</span>
                                            </div>
                                            <div class="select-size-background">
                                                <!-- <input class="size-input" type="number" placeholder="Informe quantos m²" value=""> -->
                                                <select class="select-home" name="Tamanho_imovel" required>
                                                    <option value="">Selecione</option>
                                                    <option value="Abaixo de 100 m">Abaixo de 100 m²</option>
                                                    <option value="100m-150m">100m² - 150m²</option>
                                                    <option value="150m-200m">150m² - 200m²</option>
                                                    <option value="200m-400m">200m² - 400m²</option>
                                                    <option value="Acima de 400m">Acima de 400m²</option>
                                                </select>
                                                <div class="hint-size-toggle">
                                                    <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Tamanho do Imóvel">?</button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="size-apart col-md-12 disable-class">
                                            <div class="description">
                                                <span>Dormitórios:</span>
                                            </div>
                                            <div class="select-size-background d-flex">
                                                <div class="qtd-home d-flex align-items-center">
                                                    <button class="btn btn-menos qtd-minus" type="button">-</button>
                                                    <input type="text" name="Dormitorios" id="qtd-rooms" value="1">
                                                    <button class="btn btn-mais qtd-plus" type="button">+</button>
                                                </div>
                                                <div class="hint-size-toggle-apart">
                                                    <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Número de dormitórios">?</button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="cep col-md-12">
                                            <div class="description">
                                                <span>CEP</span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="input-default input-size">
                                                    <input id="endereco-campo" name="Cep" class="campo-cep cep-field" type="tel" placeholder="Digite o cep" value="">
                                                </div>
                                                <label id="endereco" class="fill-endereco"></label>
                                            </div>
                                        </div>

                                        <div class="filter-by-category col-md-12 d-flex flex-column">
                                            <label>Ordenar por</label>
                                            <select class="select-price2" value="">
                                                <option>Recomendado</option>
                                                <option value="Avaliacao" <?php if ($Ordem_text == 'Avaliacao') {
                                                                                echo 'selected';
                                                                            }   ?>>Melhor Avaliação</option>
                                                <option value="Preco" <?php if ($Ordem_text == 'Preco') {
                                                                            echo 'selected';
                                                                        }   ?>>Preço</option>
                                                <option value="Distancia" <?php if ($Ordem_text == 'Distancia') {
                                                                                echo 'selected';
                                                                            }   ?>>Distância</option>
                                            </select>
                                        </div>

                                        <div class="button-search col-md-12">
                                            <button id="search" type="submit" class="btn" disabled>Buscar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="price-service d-flex flex-column">
            <label>Faixa de preço</label>
            <select class="select-price">
                <option value="">Selecione</option>
                <option value="1000">R$1000 - R$1500</option>
                <option value="1500">R$1500 - R$2500</option>
                <option value="2500">R$2500 - R$5mil</option>
                <option value="5mil">R$5mil - R$10mil</option>
                <option value="10mil">R$10mil - R$20mil</option>
            </select>
        </div> -->

        </div>

    </div>

    <div class="content-service">
        <div class="container area-filter">
            <div class="filter-by-category">
                <div class=" d-flex align-items-center">
                    <label>Ordenar por</label>
                    <select class="select-price" value="">
                        <option>Recomendado</option>
                        <option value="Avaliacao" <?php if ($Ordem_text == 'Avaliacao') {
                                                        echo 'selected';
                                                    }   ?>>Melhor Avaliação</option>
                        <option value="Preco" <?php if ($Ordem_text == 'Preco') {
                                                    echo 'selected';
                                                }   ?>>Preço</option>
                        <option value="Distancia" <?php if ($Ordem_text == 'Distancia') {
                                                        echo 'selected';
                                                    }   ?>>Distância</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="list-specialist">

            <?php

            if (!isset($_GET['pag'])) {
                $pag = 1;
            } else {
                $pag = $_GET['pag'];
            }
            //$pag = ($_GET['pag']);
            $pag = filter_var($pag, FILTER_VALIDATE_INT);

            $inicio = 0;
            $limite = 12;

            if ($pag != '') {
                $inicio = ($pag - 1) * $limite;
            }

            $busca_total = Query("SELECT COUNT(*) as total FROM parceiro WHERE Ativo = 1 AND " . $servico_where . "");
            $total = mysqli_fetch_array($busca_total);
            $total = $total['total'];

            $q_p = Query('SELECT * FROM parceiro WHERE Ativo = 1 AND ' . $servico_where . '  ' . $Ordem . ' LIMIT ' . $inicio . ',' . $limite . '', 0);


            if (mysqli_num_rows($q_p) > 0) {
                while ($r_p = mysqli_fetch_assoc($q_p)) {
                    $n_avalia = mysqli_num_rows(Query('SELECT * FROM avaliacao WHERE Parceiro = ' . $r_p['Parceiro'] . ''));
                    $avalia = Query('SELECT AVG(Nota) as Nota_avaliacao_geral FROM avaliacao WHERE Parceiro = ' . $r_p['Parceiro'] . '', 1)['Nota_avaliacao_geral'];
            ?>
                    <div class="container col-md-6 card-position">
                        <div onclick="location.href='perfil-company/<?php echo $r_p['Parceiro'];   ?>'" class="card-img">
                            <div class="row no-gutters d-flex justify-content-center">
                                <div class="col-md-4 d-flex justify-content-center align-items-center p-3">
                                    <img src="<?php echo $Config['UrlSite'];    ?>imagens/parceiro/200/<?php echo $r_p['Imagem'];    ?>" class="bd-placeholder-img tam-card img-depo" role="img">
                                </div>
                                <div class="col-md-9 col-xl-5 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h5 class="card-title"><?php echo $r_p['Titulo'];    ?></h5>
                                        <p class="card-text">
                                            <span id="distance<?php echo $r_p['Parceiro'];    ?>" class="distance"></span>
                                            <?php
                                            $lat = explode(';', $r_p['Localizacao'])[0];
                                            $lng = explode(';', $r_p['Localizacao'])[1];
                                            echo "<script> $('#distance" . $r_p['Parceiro'] . "').text(getDistanceInKm(" . $lat . "," . $lng . ")); </script>";
                                            ?><br>
                                            <?php
                                            echo str_repeat('<span class="fa fa-star checked"></span>', $avalia);
                                            echo str_repeat('<span class="fa fa-star"></span>', 5 - floor($avalia));
                                            ?>
                                            <br>
                                            <span><?php echo $n_avalia;   ?> Avaliações </span>
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <div class="col-md-12 tam-prices d-flex flex-column align-items-center">
                                        <div class="card-prices">
                                            <h2>R$ <?php if ($servico_id == 2) {
                                                        echo $r_p['Dedetizacao_valor'];
                                                    } else if ($servico_id == 1) {
                                                        echo $r_p['Sanitizacao_valor'];
                                                    }   ?></h2>
                                            <p>por dia</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  }


                $prox = $pag + 1;
                $ant = $pag - 1;
                $ultima_pag = ceil($total / $limite);
                $penultima = $ultima_pag - 1;
                $adjacentes = 2;

                echo '<div class="pagination-cards d-flex justify-content-center mt-5">
      <nav aria-label="Page navigation"><ul class="pagination">';

                if ($pag > 1) {
                    $paginacao = ' <li class="page-item"><a class="page-link"  href=" filtro-especialista.php?' . $get . '&' . $get . '&pag=' . $ant . '">anterior</a></li>';
                } else {
                    $paginacao = '';
                }


                if ($ultima_pag <= 5) {
                    for ($i = 1; $i < $ultima_pag + 1; $i++) {
                        if ($i == $pag) {
                            $paginacao .= ' <li class="page-item"><a class="atual page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                        } else {
                            $paginacao .= '<a  class="page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }

                if ($ultima_pag > 5) {
                    if ($pag < 1 + (2 * $adjacentes)) {
                        for ($i = 1; $i < 2 + (2 * $adjacentes); $i++) {
                            if ($i == $pag) {
                                $paginacao .= '<a  class="atual page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            } else {
                                $paginacao .= ' <li class="page-item"><a class="btn page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                        $paginacao .= '...';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href="filtro-especialista.php?' . $get . '&pag=' . $penultima . '">' . $penultima . '</a></li>';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href="filtro-especialista.php?' . $get . '&pag=' . $ultima_pag . '">' . $ultima_pag . '</a></li>';
                    } elseif ($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
                        $paginacao .= ' <li class="page-item"><a class="page-link" href="filtro-especialista.php?' . $get . '&pag=1">1</a></li>';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href="filtro-especialista.php?' . $get . '&pag=1">2</a></li> ... ';
                        for ($i = $pag - $adjacentes; $i <= $pag + $adjacentes; $i++) {
                            if ($i == $pag) {
                                $paginacao .= ' <li class="page-item"><a class="atual page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            } else {
                                $paginacao .= ' <li class="page-item"><a class="page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                        $paginacao .= '...';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $penultima . '">' . $penultima . '</a></li>';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href=" filtro-especialista.php?' . $get . '&pag=' . $ultima_pag . '">' . $ultima_pag . '</a></li>';
                    } else {
                        $paginacao .= ' <li class="page-item"><a class="page-link" href=" filtro-especialista.php?' . $get . '&pag=1">1</a></li>';
                        $paginacao .= ' <li class="page-item"><a class="page-link" href=" filtro-especialista.php?' . $get . '&pag=1">2</a></li> ... ';
                        for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++) {
                            if ($i == $pag) {
                                $paginacao .= ' <li class="page-item"><a class="page-link atual" href="seminovos.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            } else {
                                $paginacao .= ' <li class="page-item"><a class="page-link" href="seminovos.php?' . $get . '&pag=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                    }
                }




                if ($prox <= $ultima_pag && $ultima_pag > 2) {
                    $paginacao .= ' <li class="page-item"><a class="btn btn-primary" href="seminovos.php?' . $get . '&pag=' . $prox . '">pr&oacute;xima &raquo;</a></li>';
                }


                echo $paginacao;

                echo '</ul></nav>
    </div>';
                ?>

        </div>

        <!--<div class="pagination-cards d-flex justify-content-center mt-5">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#blog.php" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#blog.php">1</a></li>
          <li class="page-item"><a class="page-link" href="#blog.php">2</a></li>
          <li class="page-item"><a class="page-link" href="#blog.php">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#blog.php" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>-->
    <?php } else { ?>
        <div class="nobody d-none flex-column w-75 m-auto">
            <div class="title-nobody d-flex justify-content-center">
                <h2>Infelizmente não encontramos resultados para a sua busca.</h2>
            </div>
            <div class="info-nobody">
                <p>Agradecemos a sua confiança! Estamos trabalhando para ampliar o nosso atendimento e entregar a melhor
                    experiência para você. Por isso, temos uma surpresa:
                </p>
            </div>
            <div class="form-nobody">
                <div class="info-form-nobody mb-3">
                    <h3>Preencha os dados abaixo a ganhe um cupom de XXXX</h3>
                </div>
                <div class="background-inputs d-flex flex-column">
                    <label class="">Nome</label>
                    <div class="input-default input-contact input-size mb-3">
                        <input type="text" placeholder="Nome completo">
                    </div>
                </div>
                <div class="background-inputs d-flex flex-column">
                    <label class="">Email</label>
                    <div class="input-default input-contact input-size mb-3">
                        <input type="email" placeholder="Email">
                    </div>
                </div>
                <div class="background-inputs d-flex flex-column">
                    <label class="">Telefone</label>
                    <div class="input-default mb-3">
                        <input type="text" class="cel-field" placeholder="Telefone" value="">
                    </div>
                </div>
                <div class="background-inputs d-flex flex-column">
                    <label class="">CEP</label>
                    <div class="input-default mb-3">
                        <input type="text" class="cep-field" placeholder="Digite o CEP" value="">
                    </div>
                </div>
                <div class="button-sending mt-3 mb-3">
                    <button type="button" class="btn">Enviar</button>
                </div>
            </div>
        </div>
    <?php   }    ?>

    </div>

</div>

<?php include('footer.php'); ?>

<script>
    $(document).ready(function() {
        $('#select-service').on('change', function() {
            var type_service = $(this).val();

            if (type_service == "dedetizacao") {
                $(".filter-especialista").find("input[type='radio']").prop('checked', true);
                $(".form-submit").find("input[type='hidden']").val("dedetizacao");
                $(".type-prague-san").removeClass("active-san");
                $(".type-prague-det").addClass("active-det");
            } else if (type_service == "sanitizacao") {
                $(".sanitizacao").find("input[type='radio']").prop('checked', true);
                $(".form-submit").find("input[type='hidden']").val("sanitizacao")
                $(".type-prague-det").removeClass("active-det");
                $(".type-prague-san").addClass("active-san");
            }

        });

    })
</script>

</body>

</html>

<script>
    window.onscroll = function() {
        myFunction()
    };

    var header = document.getElementById("headerFixed");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $("#endereco-campo").val($(".result-info-filter > p").text());
        $('.campo-cep').blur();
    });

    $("#search").click((e) => {
        e.preventDefault();
        if (($("select[name='Tamanho_imovel'").val() == "" && $("select[name='Dormitorios']").val() == "") || $("select[name='Tipo_imovel'").val() == "" || $("select[name='Tipo_de_servico'").val() == "") {
            alert("Preencha todos os campos");
        } else {
            $("#form").submit();
        }
    })
</script>

<script type="text/javascript">
    $('.qtd-plus').click(function() {
        document.getElementById('qtd-rooms').value++;
    });

    $('.qtd-minus').click(function() {
        if (document.getElementById('qtd-rooms').value > 1) {
            document.getElementById('qtd-rooms').value--;
        }
    });
</script>

<script>
    // Metodo para trocar o select do tamanho
    $('#residencia').on('change', function() {
        if ($(this).val() == "1") {
            $(".size-home").removeClass("active");
            $(".size-home").addClass("disable-class");

            $(".size-apart").removeClass("disable-class");
            $(".size-apart").addClass("active");
        } else {
            $(".size-home").removeClass("disable-class");
            $(".size-home").addClass("active");

            $(".size-apart").removeClass("active");
            $(".size-apart").addClass("disable-class");
        }
    })


    $('.campo-cep').blur(function() {
        var _this = $(this);
        $.ajax({
            url: 'viacep.php?cep=' + $(this).val().replace(/\D/g, ''),
            dataType: 'json',
            success: function(data) {
                $(_this).parents('.cep').find('.fill-endereco').html(data.logradouro + ', ' + data.bairro + ', ' +
                    data.localidade + '/' + data.uf);
                $("#search").attr("disabled", false);
            }
        });

        if (!$("#endereco-campo").val()) {
            $("#endereco").html("");
        }
    });


    // Super Select - Checkbox
    $(document).on('click', '.super-select button', function() {

        $('.super-select').removeClass('active');

        $(this).closest('.super-select').toggleClass('active');

    });


    $(document).on('click', '.super-select-checkbox', function() {

        var check = $(this).find('input:checkbox');

        $(this).find('i.fa').toggleClass('fa-check-square fa-square');

        check.prop("checked", !check.prop("checked"));

        var checkedItems = $(this).closest('.super-select').find('input:checked').length;

        $(this).closest('.super-select').find('.selected').text(checkedItems);

        if (checkedItems > 0) {
            $(this).closest('.super-select').addClass('has-selected');
        } else {
            $(this).closest('.super-select').removeClass('has-selected');
        }

    });

    $('.select-price').on('change', function() {
        let valor = $(this).val();
        let localUrl = window.location.href;


        window.location.href = localUrl + "&Ordem=" + valor;
    })

    $(document).mouseup(function(e) {

        var container = $('.super-select');

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.super-select').removeClass('active');
        }

    });
</script>