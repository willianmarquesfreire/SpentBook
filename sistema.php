<?php session_start(); 
    $table = isset($_GET['table']) ? $_GET['table'] : 'financeiro';
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
        .glyphicon {
            font-size: 25px;
        }
        #usuario {
            float: right;
            font-size: 15px;
        }
        .table-all {
        	overflow-x: scroll;
        }
        #msg {
            padding: 5px;
            position: relative;
        }
        #mostraformulario {
            display:none;
        }
        #ocultaformulario {
            display:inline-block;
        }
    </style>
    <script>
	$(document).ready(function(){
                var table = "<?php echo $table; ?>";
                if (table != 'financeiro') {
                    table = table.substr(0, table.length-1);
                }
                
                $("#principal").load(table + ".php");
		$("#financeiro").on("click",function(){
			$("#principal").load("./financeiro.php");
                        $('#ocultaformulario').css('display','inline-block');
                        $('#mostraformulario').css('display','none');
		});
		$("#categoria").on("click",function(){
			$("#principal").load("./categoria.php");
                        $('#ocultaformulario').css('display','inline-block');
                        $('#mostraformulario').css('display','none');
		});
		$("#contas").on("click",function(){
			$("#principal").load("./conta.php");
                        $('#ocultaformulario').css('display','inline-block');
                        $('#mostraformulario').css('display','none');
		});
		$("#sair").on("click",function(){
			window.location = "./sair.php";
		});
		$("#ocultaformulario").on('click', function() {
                    $('form').css('display','none');
                    $('#ocultaformulario').css('display','none');
                    $('#mostraformulario').css('display','inline-block');                
                });
                $("#mostraformulario").on('click', function() {
                    $('form').css('display','block');
                    $('#ocultaformulario').css('display','inline-block');
                    $('#mostraformulario').css('display','none');
                });
        
		
	});
	
    </script>

    <body>
        <div class="container-fluid">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-success" id="financeiro">
                        Financeiro
                    </button>
                    
                    <button type="button" class="btn btn-warning" id="categoria">
                        Categoria
                    </button>
                    
                    <button type="button" class="btn btn-warning" id="contas">
                        Contas
                    </button>
                    
                    <button type="button" class="btn btn-default" id="ocultaformulario">
                        Ocultar Formulario
                    </button>
                    
                    <button type="button" class="btn btn-default" id="mostraformulario">
                        Mostrar Formulario
                    </button>

                    <button type="button" class="btn btn-danger" id="sair">
                        Sair
                    </button>
                    <?php
                    if(isset($_GET['msg'])) {
                        if($_GET['msg'] == 'cadastro_ok') {
                            $msg = "Cadastro Realizado com Sucesso!";
                            $type = "success";                                  
                        } else if($_GET['msg'] == 'cadastro_error') {
                            $msg = "Houveram erros durante o cadastro!";
                            $type = "danger";                                  
                        } else if($_GET['msg'] == 'altera_ok') {
                            $msg = "Alteração realizada com Sucesso!";
                            $type = "success";                                  
                        } else if($_GET['msg'] == 'altera_error') {
                            $msg = "Houveram erros durante a alteração!";
                            $type = "danger";                                  
                        } else if($_GET['msg'] == 'deleta_ok') {
                            $msg = "Exclusão realizada com Sucesso!";
                            $type = "success";                                  
                        } else if($_GET['msg'] == 'altera_error') {
                            $msg = "Houveram erros durante a exclusão!";
                            $type = "danger";                                  
                        } else if($_GET['msg'] == 'usuariocadastrado') {
                            $msg = "Usuário Cadastrado com Sucesso!";
                            $type = "success";                                  
                        }
                        echo "<span class='panel panel-$type' id='msg'>$msg</span>
                                  <script> 
                                    setTimeout(function(){
                                        document.getElementById('msg').style.display = 'none';
                                    },3000);
                                  </script>";
                    }
                        
                    ?>

                    <span class="label label-info" id="usuario"> Bem Vindo <?php echo $_SESSION["usuario"]; ?></span>

                    </div>
                    <div class="panel-body" id="principal">


                </div>
            </div>
        </div>
    </body>
</html>
