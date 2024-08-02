<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Clientes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>Endereço</th>
                    <th>CPF</th>
                    <th>Alterar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include("../db/conexao.php");

            $consulta = "SELECT * FROM gamelandia.tb_clientes ORDER BY ID DESC";
            $result = $conn->query($consulta);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["NOME_COMP"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["ENDERECO"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["CPF"]) . "</td>";
                    echo "<td><a href='alterar_pes.php?ID=" . $row["ID"] . "' class='btn btn-warning'>Alterar</a></td>";
                    echo "<td><a href='apagar_pes.php?ID=" . $row["ID"] . "' class='btn btn-danger'>Deletar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhuma informação retornada do Banco de Dados.</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>