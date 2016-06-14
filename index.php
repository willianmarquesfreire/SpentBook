<?php
    function dateBR($date){
        return date("d-m-Y", strtotime($date));
    }
    function dateUS($date){
        return date("Y-m-d", strtotime($date));
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SpentBook</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <style>
        #login {
            padding-left:30%;
            padding-right:30%;
        }
    </style>

    <body>
        <br>
        <div class="container" id="login">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login<?php if (isset($_GET['msg']) && $_GET['msg'] == "error_login") echo "<span style='color:red;'> - Usuário não cadastrado!</span>";?>
                </div>
                <div class="panel-body">
                    <form class="form-group" action="login.php" method="POST">
                        <label for="usuario" class="control-label">Usuario: </label>
                        <input type="text" name="usuario" class="form-control">
                        <br>
                        <label for="senha" class="control-label">Senha: </label>
                        <input type="password" name="senha" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-success" name="entrar">Entrar</button>
                        <button type="submit" class="btn btn-default" name="cadastrar">Cadastrar</button>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>
