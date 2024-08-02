<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Lista de usuários</title>
</head>

<body>

    <?php
    // Chamada de conexão com o Banco de Dados através do arquivo externo
    include("../db/conexao.php");

    // Comando SQL para listagem dos registros vindos do MySQL em ordem decrescente
    $consulta = "SELECT * FROM gamelandia.tb_produtos ORDER BY ID DESC";

    // Guarda dados retornados em um array (matriz)
    $result = $conn->query($consulta);

    // Verifica se a consulta foi bem-sucedida
    if ($result === false) {
        die("Erro na consulta: " . $conn->error);
    }

    // Caso o banco de dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
    if ($result->num_rows > 0) {
        // Escreve os dados do Array (matriz) e a cada volta no loop do while escreve um registro na tela
        while ($row = $result->fetch_assoc()) {
    ?>
    <!-- Fim do bloco PHP -->

        <section class="containerGL">     
            <div class="card" style="width:400px">
                <img class="card-img-top" src="<?php echo "../../assets/img/cards/" . $row["FOTO"]; ?>" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $row["PRODUTO"]; ?> - <?php echo $row["PLATAFORMA"]; ?></h4>
                    <p class="card-text"><?php echo $row["DESCRICAO"]; ?></p>
                    <a href="#" class="btn btn-success">Comprar</a>
                    <a class="btn btn-warning" href="alterar_prod.php?ID=<?php echo $row["ID"]; ?>">Alterar</a>
                    <a class="btn btn-danger" href="apagar_prod.php?ID=<?php echo $row["ID"]; ?>">Deletar</a>
                </div>
                <br>
            </div>
            <br>
            <br>
            <br>
    <?php
        }
    } else {
        // Em caso de tabela vazia, exibe mensagem
        echo "Nenhuma informação retornada do Banco de Dados.";
    }

    // Fechar conexão com o Banco de Dados
    $conn->close();
    ?>
    <!-- Fim do bloco PHP -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
</html>