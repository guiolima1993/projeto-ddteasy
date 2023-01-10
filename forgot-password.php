<?php $_password = true ?>
<?php include('header.php'); ?>

<div class="background-login">
    <div class="background-image-left">
        <img src="images/ddteasy-images/canto-1.png" alt="side-image">
    </div>

    <div class="card-login d-flex">
        <form>
            <div class="form-login">
                <div onclick="location.href='login.php'" class="back-icon">
                    <img src="images/ddteasy-images/chevron-down-outline-purple.svg" name="chevron-back-outline">
                </div>
                <div class="forget-title mb-2">
                    <h2>Esqueceu a senha?</h2>
                </div>
                <div class="forget-info mb-2">
                    <p>Por favor, apenas informe seu email, para enviarmos um codigo de resgate</p>
                </div>
                <div class="background-forget-email d-flex flex-column w-75">
                    <label class="">Email</label>
                    <div class="input-default input-email input-size mb-3">
                        <input type="email" placeholder="Email">
                    </div>
                </div>
                <div class="button-login mb-3 w-75">
                    <button class="btn">Enviar</button>
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