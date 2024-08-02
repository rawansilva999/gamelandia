<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/estilo.css">
  <title>Document</title>
</head>
<body>
    <?php
        //chama arquivo externo do conexão com o Banco de Dados.
        include("../db/conexao.php");

        $id=$_SERVER['QUERY_STRING'];

        $consulta = "SELECT * FROM gamelandia.tb_produtos where $id";
        //Guarda dados retornados em um array(matriz)
        $result = $conn->query($consulta);
        // Caso o Banco de Dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
        // e organizar a saída dos dados na tela.
            if ($result->num_rows > 0) 
            {
                // Ecreve os dados do Array(matriz) e a cada volta no loop do while escreve um registro na tela.
                while($row = $result->fetch_assoc()) 
                {
                    // Removendo imagem da pasta fotos/
                    unlink("../../assets/img/cards/".$row["FOTO"]);
                }
            } 
               
        // sql to delete a record
        $sql = "DELETE FROM gamelandia.TB_produtos WHERE $id";

        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert("."'Registro ".$id." apagado com sucesso !'".")</script>";
        } 
        else 
        {
            echo "Erro ao apagar o Registro: " . $conn->error;
        }
        $conn->close();

        include("./listar_prod.php");
    ?>
</body>
</html>