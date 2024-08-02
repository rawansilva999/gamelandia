<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./assets/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Lista de usuários</title>
</head>

<body onload="this.form.submit()">

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" onchange="this.form.submit()">
                <option value="">** ESCOLHA UMA OPÇÃO **</option>
                <option value="TUDO">TUDO</option>
                <option value="GAME">GAME</option>
                <option value="ACESSORIO">ACESSORIO</option>
                <option value="CONSOLE">CONSOLE</option>
                <option value="ARCADE">ARCADE</option>
            </select><br>
        <hr>
       <!-- <input class="btn btn-primary" type="submit" name="cadastrar" value="Pesquisar" /> -->
        <hr>    

<?php //início do bloco PHP
        // chamada de conexão com o Banco de Dados através do arquivo externo.
        include("./transacts/db/conexao.php");
        
        if (isset($_POST['tipo'])) 
        {    
            //Recebe os dodos do formulário no método Post e guarda nas seguintes variáveis.
            $tipo = $_POST["tipo"];
            
            if ($tipo == "TUDO" or $tipo =="")
            {
                //comando SQL para listagem dos registro vindos do MySql em ordem Decrescente.
                $consulta = "SELECT * FROM gamelandia.tb_produtos ORDER by ID DESC";
                $result = $conn->query($consulta);
                // Caso o Banco de Dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
                // e organizar a saída dos dados na tela.
                    if ($result->num_rows > 0) {
                        // Ecreve os dados do Array(matriz) e a cada volta no loop do while escreve um registro na tela.
                        while($row = $result->fetch_assoc()) {
?>
                                <section class="containerGL">     
                                <div class="card" style="width:400px">
                                    <img class="card-img-top" src="<?php echo ".//assets/img/cards/".$row["FOTO"]; ?>" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                        <h4 class="card-title"><?php echo $row["PRODUTO"]; ?> - <?php echo $row["PLATAFORMA"]; ?></h4>
                                        <p class="card-text"><?php echo $row["DESCRICAO"]; ?></p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                        </div>
                                        <br>
                                        <br>
                                </div>
<?php
                        }
                    }       
            }   
            else
            {
                //comando SQL para listagem dos registro vindos do MySql em ordem Decrescente.
                $consulta = "SELECT * FROM gamelandia.tb_produtos where tipo = '$tipo' ORDER by ID DESC";
                //Guarda dados retornados em um array(matriz)
                $result = $conn->query($consulta);
                // Caso o Banco de Dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
                // e organizar a saída dos dados na tela.
                    if ($result->num_rows > 0) {
                        // Ecreve os dados do Array(matriz) e a cada volta no loop do while escreve um registro na tela.
                        while($row = $result->fetch_assoc()) {    
?> <!--  fim do bloco PHP -->

                            <section class="containerGL">     
                                <div class="card" style="width:400px">
                                    <img class="card-img-top" src="<?php echo ".//assets/img/cards/".$row["FOTO"]; ?>" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                        <h4 class="card-title"><?php echo $row["PRODUTO"]; ?> - <?php echo $row["PLATAFORMA"]; ?></h4>
                                        <p class="card-text"><?php echo $row["DESCRICAO"]; ?></p>
                                        <a href="#" class="btn btn-primary">Comprar</a>
                                        </div>
                                        <br>
                                        <br>
                                </div>
                            
            <?php //início do bloco PHP
            }
                } else {
                    //Em caso que a tabela do Banco de Dados(MySql)esteja vazia, escreva:
                    echo "Nenhuma informação retornada do Banco de Dados.";
                }
                //Fechar conexão com o Banco de Dados
                $conn->close();
            }
    }
?> <!-- Fim do bloco  PHP -->
<br>

</section>            
</body>
</html>