<?php $_password = true ?>
<?php include('header.php'); ?>

<div class="background-login">
    <div class="background-image-left">
        <img src="images/ddteasy-images/canto-1.png" alt="side-image">
    </div>

    <div class="card-login d-flex">
        <form action="requisicoes/envia-contato.php" class="form-validate form-submit" id="form-cadastrar" novalidate="novalidate">
            <input type="hidden" name="Tipo" value="Cliente">
            <div class="form-login verificar-cep">
                <div onclick="location.href='login.php'" class="back-icon">
                    <img src="images/ddteasy-images/chevron-down-outline-purple.svg" name="chevron-back-outline">
                </div>
                <div class="resgister">
                    <h2>Cadastre-se já como cliente!</h2>
                </div>
                <div onclick="location.href='parceiro.php'" class="resgister-partner mb-2">
                    <span>Ou clique aqui para cadastro de parceiro!</span>
                </div>
                <div class="background-register-nome d-flex flex-column">
                    <label class="">Nome</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Nome" placeholder="Nome Completo" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="background-register-email d-flex flex-column">
                    <label class="">Email</label>
                    <div class="input-default input-size mb-3">
                        <input type="email" name="Email" placeholder="Email" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="background-register-senha d-flex flex-column">
                    <label class="">Senha</label>
                    <div class="input-default input-size mb-3">
                        <input type="password" id="pwd-place" name="Senha" min="8" placeholder="Senha" autocomplete="off" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@#$])[a-zA-Z0-9@#$]{8,50}$" value="" required>
                    </div>
                </div>
                <div class="background-register-senha d-flex flex-column">
                    <label class="">Repetir senha</label>
                    <div class="input-default input-size mb-3">
                        <input type="password" id="pwd-repeat" name="Repetir_senha" min="8" placeholder="Senha" autocomplete="off" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@#$])[a-zA-Z0-9@#$]{8,50}$" value="" required>
                    </div>
                </div>
                <div class="background-register-cpf d-flex flex-column">
                    <label class="">CPF</label>
                    <div class="input-default input-number input-size mb-3">
                        <input name="Cpf" class="cpf-field" type="text" placeholder="CPF" autocomplete="off" value="" required="required">                        
                    </div>
                </div>
                <div class="background-register-telefone d-flex flex-column">
                    <label class="">Telefone</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Telefone" class="cel-field" placeholder="Telefone" autocomplete="off" value="" required>
                    </div>
                </div>
                <div class="background-register-cep d-flex flex-column">
                    <label class="">CEP</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Cep" class="cep-field" placeholder="CEP" autocomplete="off" value="" required>
                        <a href="https://buscacepinter.correios.com.br/app/endereco/index.php?t" target="_blank">Não sei meu CEP</a>
                    </div>
                </div>
                <div class="background-register-endereco d-flex flex-column">
                    <label class="">Endereço</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Endereco" class="fill-endereco" placeholder="Endereço" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="background-register-endereco d-flex flex-column">
                    <label class="">Data de nascimento</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Data-nascimento" class="nascimento-field" placeholder="DD/MM/AAAA" value="" autocomplete="off" required>
                    </div>
                </div>
                <div class="background-register-complemento d-flex flex-column">
                    <label class="">Número</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Numero" value="" placeholder="Número" autocomplete="off" required>
                    </div>
                </div>
                <div class="background-register-complemento d-flex flex-column">
                    <label class="">Complemento</label>
                    <div class="input-default input-size mb-3">
                        <input type="text" name="Complemento" placeholder="Complemento" value="" autocomplete="off">
                    </div>
                </div>
                <div class="how-prefer mb-3">
                    <span>Como prefere ser contatado</span>
                </div>
                <div class="area-icons d-flex flex-column">
                    <div class="tel d-flex align-items-center mb-3">
                        <div class="radio-button">
                            <input class="checkbox-radio" type="checkbox" name="Forma_contato_Sms" value="1">
                        </div>
                        <img src="images/ddteasy-images/call-outline.svg" name="call-outline">
                        <div class="input-area">
                            <span> SMS</span>
                        </div>
                    </div>
                    <div class="whats d-flex align-items-center mb-3">
                        <div class="radio-button">
                            <input class="checkbox-radio" type="checkbox" name="Forma_contato_Whatsapp" value="1">
                        </div>
                        <img src="images/ddteasy-images/logo-whatsapp-green.svg" name="logo-whatsapp">
                        <div class="input-area">
                            <span> WhatsApp</span>
                        </div>
                    </div>   
                    <div class="mail d-flex align-items-center mb-3">
                        <label class="radio-button">
                            <input class="checkbox-radio" type="checkbox" name="Forma_contato_Email" value="1">
                        </label>
                        <img src="images/ddteasy-images/mail-outline.svg" name="mail-outline">
                        <div class="input-area">
                            <span> E-mail</span>
                        </div>
                    </div>
                </div>
                <div class="term-use">
                    <input class="col-1" type="checkbox" value="1" name="Termos_de_uso" required>
                    <div class="info">
                        <span>Concordo com os <a>termos de uso</a></span>
                    </div>
                </div>
                <div class="receive-email mb-3 d-flex">
                    <input class="col-1" type="checkbox" value="1" name="Quero_novidades">
                    <div class="info">
                        <span>Quero receber novidades em meu email</span>
                    </div>
                </div>
                <div class="button-login mb-3">
                    <button type="submit" class="btn">Registrar</button>
                </div>
            </div>

        </form>
    </div>
    <div class="background-image-right">
        <img src="images/ddteasy-images/meio.png" alt="side-image-right">
    </div>
</div>

<?php include('footer.php'); ?>

</body>

</html>