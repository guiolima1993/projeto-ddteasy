<?php  

	$Gerenciamentos = array(           

		"menu_sistema" => array(
			"Titulo" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Grupo_menu" => array(NULL,"grupo_menu",1,"NOT NULL","FLAG","grupo_menu"),
			"Rotulo" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Ordem"  => array(NULL,"INT",10),
			"Icone"  => array(NULL,"VARCHAR",200, "NOT NULL")
		),      
              
		"grupo_menu" => array(
			"Titulo" => array(NULL,"VARCHAR",200, "NOT NULL")
		), 

		"proximidades" => array(
			"Titulo"   => array(NULL,"VARCHAR",200, "NOT NULL")
		), 


		"material_de_apoio" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Data" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),   
			"Servico" => array(NULL,"servico",1,"NOT NULL","FLAG","servico"),
			"Arquivo" => array(NULL, "FILE", "material_de_apoio", "Envie um arquivo para o material de apoio", array(array(1900,1425), array(380,285)))
		),
    



		"blog" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Texto"     => array(NULL,"TEXT", 1),
			"Imagem"    => array(NULL, "IMAGEM", "blog", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>200 x 200</strong> </p>", array(array(200,200))),
			"Imagem_interna"    => array(NULL, "IMAGEM", "blog", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1000 x 628</strong> </p>", array(array(1000,628)))
		),  

		"blog_banner" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Link"      => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "blog_banner", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1680 x 1020</strong> </p>", array(array(1680,1020)))
		),  

		"introducao_home" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1)
		),



		"politica_de_privacidade" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Texto"     => array(NULL,"TEXT", 1)
		),

		"termos_de_uso" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Texto"     => array(NULL,"TEXT", 1)
		),
            
        
		"configuracao_smtp" => array(
			"Titulo" 			=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Email_sender" 		=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Senha_sender" 		=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Destinatarios"  	=> array(NULL,"RESUMO", 1)
		),  

		"dados_da_empresa" => array(
			"Titulo" 		=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Instagram"     => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Facebook"      => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Whatsapp" 		=> array(NULL,"CELULAR",200, "NOT NULL"),
			"Linkedin"      => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Texto_cookie"  => array(NULL,"RESUMO", 1)
		),    


		"como_funciona_home" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "como_funciona_home", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>349 x 314</strong> </p>", array(array(349,314))),
		), 


		"como_funciona" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Passo_1"    => array(NULL,"RESUMO", 1),
			"Passo_2"    => array(NULL,"RESUMO", 1),
			"Passo_3"    => array(NULL,"RESUMO", 1),
			"Titulo_duvida_passo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Duvida_passo"    => array(NULL,"RESUMO", 1)
		), 

     
		"servico" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Preco_minimo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"), 
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Texto_1"    => array(NULL,"TEXT", 1),
			"Imagem"    => array(NULL, "IMAGEM", "servico", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1000 x 628</strong> </p>", array(array(1000,628))),
			"Texto_2"    => array(NULL,"TEXT", 1),
			"Categoria" 	=> array(NULL,"VARCHAR",200, "NOT NULL"), 
			"Exige_licensa" => array(NULL,"CHECK"),
			"Tipo_de_licensa" 	=> array(NULL,"VARCHAR",200, "NOT NULL"), 
			"Tipo_de_servico" 	=>  array(NULL,"CHECK"),
			"Servico_mae_dedetizacao" 	=>  array(NULL,"CHECK"),  
			"Servico_mae_dedetizacao_premium" 	=>  array(NULL,"CHECK"), 
			"Servico_mae_sanitizacao"  =>  array(NULL,"CHECK"),  
			"Servico_mae_sanitizacao_premium" =>  array(NULL,"CHECK"),  
			"Icone"    => array(NULL, "IMAGEM", "servico", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>64 x 64</strong> </p>", array(array(64,64)))

		),

		"parceiro_home" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "parceiro_home", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>306 x 330</strong> </p>", array(array(306,330))),
		),  

		"quem_ja_usou" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Sobrenome" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1)
		),  

		"sobre_nos_home" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "sobre_nos_home", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>2305 x 1536</strong> </p>", array(array(2305,1536))),
		),  

		"sobre_nos" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Banner"    => array(NULL, "IMAGEM", "sobre_nos", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1800 x 442</strong> </p>", array(array(1800,442))),
			"Texto"    => array(NULL,"TEXT", 1),
			"Texto_servicos"    => array(NULL,"TEXT", 1),
			"Imagem_servicos"    => array(NULL, "IMAGEM", "sobre_nos", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1000 x 628</strong> </p>", array(array(1000,628))),
			"Texto_seguranca"    => array(NULL,"TEXT", 1),
			"Imagem_seguranca"    => array(NULL, "IMAGEM", "sobre_nos", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>1000 x 628</strong> </p>", array(array(1000,628))),
		),  

		"seja_parceiro_item" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "seja_parceiro_item", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>306 x 330</strong> </p>", array(array(306,330))),
		),

		"tipo_documento" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL")
		),

		"documento" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Parceiro"  => array(NULL,"KEY","Parceiro","NOT NULL"),
			"Tipo_documento" => array(NULL,"tipo_documento",1,"NOT NULL","FLAG","tipo_documento"),
			"Arquivo" => array(NULL, "FILE", "parceiro", "Envie um arquivo para o documento", array(array(1900,1425), array(380,285)))
		),

		"parceiro" => array(
			"Titulo" 	            => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Cnpj" 	                => array(NULL,"VARCHAR",200, "NOT NULL"),
			"L_Documento"           => array(NULL,"KID","documento"),
			"L_Colaborador"         => array(NULL,"KID","colaborador"),
			"L_Filial"              => array(NULL,"KID","filial"),
			"L_Avaliacao"           => array(NULL,"KID","avaliacao"),
			"L_Servico_prestado"    => array(NULL,"KID","servico_prestado"),
			"Nome_empresa" 	        => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Email" 	            => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Telefone" 	            => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Como_podemos_falar" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Descritivo"            => array(NULL,"RESUMO", 1),


			"Segunda" => array(NULL,"CHECK"),
			"Terca" => array(NULL,"CHECK"),
			"Quarta" => array(NULL,"CHECK"),
			"Quinta" => array(NULL,"CHECK"),
			"Sexta" => array(NULL,"CHECK"),
			"Sabado" => array(NULL,"CHECK"),
			"Domingo" => array(NULL,"CHECK"),

			"Dedetizacao" => array(NULL,"CHECK"),
			"Dedetizacao_premiuw" => array(NULL,"CHECK"),
			"Sanitizacao" => array(NULL,"CHECK"),
			"Sanitizacao_premium" => array(NULL,"CHECK"),

			"Dedetizacao_valor" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Dedetizacao_premiuw_valor" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Sanitizacao_valor" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Sanitizacao_premium_valor" => array(NULL,"VARCHAR",200, "NOT NULL"),

			"Horario_inicial" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Horario_final" => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Localizacao"            => array(NULL,"RESUMO", 1),
			"Descricao"            => array(NULL,"RESUMO", 1),

			"Proximidades" => array(NULL,"proximidades",1,"NOT NULL","FLAG","proximidades"),
			"Local_de_atendimento" => array(NULL,"VARCHAR",200, "NOT NULL"),

			"Senha" 	            => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Imagem"                => array(NULL, "IMAGEM", "parceiro", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>200 x 200</strong> </p>", array(array(200,200))),
		),


		"colaborador" => array(
			"Titulo"    => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Telefone"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Rg"        => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Cpf"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Servicos_prestados" => array(NULL,"servicos_prestados",1,"NOT NULL","FLAG","servicos_prestados"),
			"Uf"        => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Cidade"    => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Descricao" => array(NULL,"RESUMO", 1),
			"Imagem"    => array(NULL, "IMAGEM", "colaborador", "<p class='alert alert-info' style='text-align:center;'>Tamanho <strong>recomendado</strong>: <strong>100 x 133</strong> </p>", array(array(100,133))),
			"Parceiro"  => array(NULL,"KEY","Parceiro","NOT NULL")
		),

		"servicos_prestados" => array(
			"Titulo"      => array(NULL,"VARCHAR",120,"NOT NULL")
		),


		"filial" => array(
			"Titulo"      => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Cnpj"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Telefone"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Email"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Cidade"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Dedetizacao" => array(NULL,"CHECK"),
			"Dedetizacao_premiuw" => array(NULL,"CHECK"),
			"Sanitizacao" => array(NULL,"CHECK"),
			"Sanitizacao_premium" => array(NULL,"CHECK"),
			"Parceiro"    => array(NULL,"KEY","Parceiro","NOT NULL")
		),

    

		// "servico_prestado" => array(
		// 	"Titulo"      => array(NULL,"VARCHAR",120,"NOT NULL"),
		// 	"Valor"       => array(NULL,"VARCHAR",120,"NOT NULL"),
		// 	"Descritivo"  => array(NULL,"RESUMO", 1),
		// 	"Servico"     => array(NULL,"servico",1),
		// 	"Parceiro"    => array(NULL,"KEY","Parceiro","NOT NULL")
		// ),

		"avaliacao" => array(
			"Titulo"   => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Pedido"    => array(NULL,"INT",10),
			"Cliente"  => array(NULL,"cliente",1),
			"Nota"     => array(NULL,"INT",10),
			"Comentario"  => array(NULL,"RESUMO", 1),
			"Colaborador" => array(NULL,"colaborador",1,"NOT NULL","FLAG","colaborador"),
			"Data"     => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Parceiro" => array(NULL,"KEY","Parceiro","NOT NULL")
		),

		"ajuda" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resposta"    => array(NULL,"RESUMO", 1)
		),


		"ajuda_seller" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resposta"    => array(NULL,"RESUMO", 1)
		),

		"cliente" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Email" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Senha" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Cpf" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Telefone" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"L_Endereco_cliente"        => array(NULL,"KID","endereco_cliente"),
			"Cep" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Endereco" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Numero" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Complemento" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Como_podemos_falar" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Concordo_com_termos" => array(NULL,"CHECK"),
			"Quer_novidades" => array(NULL,"CHECK")
		),

		"endereco_cliente" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Cep" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Endereco" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Numero" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Complemento" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Cliente" => array(NULL,"KEY","Cliente","NOT NULL")
		),

		"cotacao_texto" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Texto"    => array(NULL,"RESUMO", 1)
		),


    
		"servico_prestado" => array(  
			"Titulo"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Cliente" => array(NULL,"cliente",1),
			"Valor"       => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Status_cotacao" => array(NULL,"status_cotacao",1),

			"Arquivo_nota_fiscal" => array(NULL, "FILE", "servico_prestado", "Envie um arquivo para a nota fiscal", array(array(1900,1425), array(380,285))),

			"Parceiro" => array(NULL,"KEY","Parceiro","NOT NULL"),
			"Servico" => array(NULL,"servico",1),
			
			"L_Praga_cotacao"        => array(NULL,"KID","praga_cotacao"),
			//"L_Necessidade_cotacao"        => array(NULL,"KID","necessidade_cotacao"),
			"Tipo_imovel"       => array(NULL,"tipo_imovel",1),
			"Detalhe_imovel"    => array(NULL,"RESUMO", 1),
			"Data_abertura"     => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Cep"               => array(NULL, "VARCHAR",120, "NOT NULL"),

			"Valor_total"           => array(NULL, "VARCHAR",120, "NOT NULL"),

			"Valor"       => array(NULL,"VARCHAR",120,"NOT NULL"),

			"Data"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Periodo"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Horario"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Endereco_cliente" => array(NULL,"endereco_cliente",1),
			"Nome_responsavel"      => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Telefone_responsavel"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			
			"Observacao"    => array(NULL,"RESUMO", 1),
			"Descritivo"    => array(NULL,"RESUMO", 1),
			"Cidade"  => array(NULL, "VARCHAR",120, "NOT NULL"),
			"Uf"  => array(NULL, "VARCHAR",120, "NOT NULL")
		),
     

		"status_cotacao" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
		),

		"praga_cotacao" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Praga" => array(NULL,"praga",1),
			"Servico_prestado" => array(NULL,"KEY","Servico_prestado","NOT NULL")
		),


		"necessidade_cotacao" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL"),
			"Necessidade" => array(NULL,"necessidade",1),
			"Servico_prestado" => array(NULL,"KEY","Servico_prestado","NOT NULL")
		),


		"necessidade" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL")
		),

		"praga" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL")
		),

		"tipo_imovel" => array(
			"Titulo"  => array(NULL,"VARCHAR",120,"NOT NULL")
		),


		"duvida_cliente" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Email" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Duvida"    => array(NULL,"RESUMO", 1)
		),

		"duvida_seller" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Email" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Duvida"    => array(NULL,"RESUMO", 1)
		),

		"notificacao" => array(
			"Titulo" 	=> array(NULL,"VARCHAR",200, "NOT NULL"),
			"Resumo"    => array(NULL,"RESUMO", 1),
			"Texto"     => array(NULL,"RESUMO", 1)
		),

		"notificacao_arquivada" => array(
			"Titulo"        => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Notificacao"   => array(NULL,"notificacao",1,"NOT NULL","FLAG","notificacao"),
			"Parceiro"      => array(NULL,"parceiro",1,"NOT NULL","FLAG","parceiro")
		),    

		"notificacao_excluida" => array(
			"Titulo"        => array(NULL,"VARCHAR",200, "NOT NULL"),
			"Notificacao"   => array(NULL,"notificacao",1,"NOT NULL","FLAG","notificacao"),
			"Parceiro"      => array(NULL,"parceiro",1,"NOT NULL","FLAG","parceiro")
		)

	);    
    
?>    