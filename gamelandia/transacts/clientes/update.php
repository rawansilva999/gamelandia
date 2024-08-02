<?php
// Tenta incluir o arquivo de conexão com o banco de dados
include("../DB/conexao.php");

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
}

// Verifica se o ID foi fornecido na URL
if (!isset($_GET['ID']) || empty($_GET['ID'])) {
    die("ID não fornecido.");
}

$id = $_GET['ID'];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    // Valida os dados (opcional, dependendo dos requisitos)

    // Prepara o comando SQL para atualizar o registro
    $sql = "UPDATE gamelandia.tb_clientes SET NOME_COMP = ?, ENDERECO = ?, CPF = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    $stmt->bind_param("sssi", $nome, $endereco, $cpf, $id);

    if ($stmt->execute()) {
        // Redireciona para listar_pes.php após a atualização bem-sucedida
        header("Location: listar_pes.php"); // Ajuste o caminho se necessário
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close(); // Fecha a conexão após todas as operações
    exit(); // Interrompe o script após a atualização
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Atualizar Cliente</title>
    <script>
        function confirmarAtualizacao() {
            return confirm("Você tem certeza de que deseja atualizar este registro?");
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        // Reabre a conexão com o banco de dados para realizar a consulta de dados
        include("../DB/conexao.php");

        // Verifica se a conexão foi bem-sucedida
        if (!$conn) {
            die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
        }

        // Comando SQL para buscar o registro com base no ID
        $consulta = "SELECT * FROM gamelandia.tb_clientes WHERE ID = ?";
        $stmt = $conn->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o registro foi encontrado
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <form method="post" action="update.php?ID=<?php echo htmlspecialchars($id); ?>" onsubmit="return confirmarAtualizacao();">
            <label>ID: <br><input name="id" type="text" value="<?php echo htmlspecialchars($id); ?>" disabled></label><br>
            <label>Nome Completo: <br><input name="nome" type="text" value="<?php echo htmlspecialchars($row['NOME_COMP']); ?>" required></label><br>
            <label>Endereço: <br><input name="endereco" type="text" value="<?php echo htmlspecialchars($row['ENDERECO']); ?>" required></label><br>
            <label>CPF: <br><input name="cpf" type="text" maxlength="14" value="<?php echo htmlspecialchars($row['CPF']); ?>" required></label><br>
            <button class="btn btn-success" type="submit">Atualizar</button>
        </form>
        <?php
        } else {
            echo "Nenhuma informação encontrada para o ID especificado.";
        }

        // Fecha a conexão com o Banco de Dados após todas as operações
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>