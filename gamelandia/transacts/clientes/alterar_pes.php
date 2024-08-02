<?php
// Chama o arquivo de conexão com o Banco de Dados
include("../DB/conexao.php");

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
}

// Recebe o ID para ser atualizado
$id = $_GET['ID'];

// Comando SQL para listar o registro com base no ID
$consulta = "SELECT * FROM gamelandia.tb_clientes WHERE ID = ?";
$stmt = $conn->prepare($consulta);

// Verifica se a preparação da query foi bem-sucedida
if ($stmt === false) {
    die("Erro ao preparar a query: " . $conn->error);
}

// Vincula o parâmetro e executa a query
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Obtém os dados do registro
    $row = $result->fetch_assoc();
} else {
    die("Nenhuma informação encontrada para o ID especificado.");
}

// Fecha a conexão com o Banco de Dados
$conn->close();
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
        <form method="post" action="update.php?ID=<?php echo htmlspecialchars($id); ?>">
            <label>ID: <br><input name="id" type="text" value="<?php echo htmlspecialchars($id); ?>" disabled></label><br>
            <label>Nome Completo: <br><input name="nome" type="text" value="<?php echo htmlspecialchars($row['NOME_COMP']); ?>" required></label><br>
            <label>Endereço: <br><input name="endereco" type="text" value="<?php echo htmlspecialchars($row['ENDERECO']); ?>" required></label><br>
            <label>CPF: <br><input name="cpf" type="text" maxlength="14" value="<?php echo htmlspecialchars($row['CPF']); ?>" required></label><br>
            <button class="btn btn-success" type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>