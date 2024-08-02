<?php
    // Recebe o ID para ser atualizado
    $id = $_SERVER['QUERY_STRING'];

    // Chamada de conexão com o Banco de Dados através do arquivo externo
    include("../DB/conexao.php");

    // Comando SQL para listagem dos registros vindos do MySQL com base no ID
    $consulta = "SELECT * FROM gamelandia.tb_clientes WHERE ID = ?";
    
    // Prepara e executa a query SQL para evitar SQL Injection
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Caso o Banco de Dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
    // e organizar a saída dos dados na tela
    if ($result->num_rows > 0) {
        // Escreve os dados do Array (matriz) e a cada volta no loop do while escreve um registro na tela
        while ($row = $result->fetch_assoc()) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Atualizar Cliente</title>
</head>
<body>
    <div class="container">
        <form method="post" action="update.php?ID=<?php echo $id; ?>">
            <label>ID: <br><input name="id" type="text" value="<?php echo htmlspecialchars($id); ?>" disabled></label><br>
            <label>Nome Completo: <br><input name="nome" type="text" value="<?php echo htmlspecialchars($row["NOME_COMP"]); ?>" required></label><br>
            <label>Endereço: <br><input name="endereco" type="text" value="<?php echo htmlspecialchars($row["ENDERECO"]); ?>" required></label><br>
            <label>CPF: <br><input name="cpf" type="text" maxlength="14" value="<?php echo htmlspecialchars($row["CPF"]); ?>" required></label><br>
            <button class="btn btn-success" type="submit">Atualizar</button>
        </form>
    </div>

    <?php
        }
    } else {
        // Em caso de tabela vazia, exibe a mensagem
        echo "Nenhuma informação retornada do Banco de Dados.";
    }
    // Fecha a conexão com o Banco de Dados
    include("./listar_pes.php");
    ?>
    
</body>
</html>