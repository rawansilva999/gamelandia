<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    <title>Cadastro de Clientes</title>
</head>
<body>
<section class="containerForm">
    <div class="cabeca_containerForm">
        Cadastro de Clientes
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:<br> 
            <input type="text" name="NOME_COMP" required>
        </label><br>
        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="ENDERECO" required><br>
        <label for="cpf">Cpf:<br> 
            <input type="text" maxlength="14" id="cpf" name="CPF" onchange="document.getElementById('validation').innerHTML = validaCPF(this.value)" required>
            <div><span id="validation"></span></div>
        </label><br>
        <div class="botoes">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </div>
    </form>
</section>

<script>
function validaCPF(cpf) {
    // Validação simples do CPF (exemplo)
    let mensagem = "";
    if (cpf.length < 11) {
        mensagem = "CPF deve ter 11 dígitos.";
    }
    return mensagem;
}
</script>
</body>
</html>

<?php
// Processar o formulário de inclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("../db/conexao.php");

    $nome_comp = $_POST["NOME_COMP"];
    $endereco = $_POST["ENDERECO"];
    $cpf = $_POST["CPF"];

    $sql = "INSERT INTO gamelandia.tb_clientes (NOME_COMP, ENDERECO, CPF) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    $stmt->bind_param("sss", $nome_comp, $endereco, $cpf);

    if ($stmt->execute()) {
        echo "<script>alert('Registro Salvo com Sucesso!'); window.location.href='listar_pes.php';</script>";
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }


}
    include("listar_pes.php");
?>