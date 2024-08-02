<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/estilo.css">
    
    <title>Document</title>
</head>
<body>
    <br>

<section class="containerForm">
    <div class="cabeca_containerForm">
        Caddastro de Produtos
    </div>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro" >

        <label for="produto">Produto:</label><br>
        <input type="text" id="produto" name="produto" required><br>

        <label for="tipo">Tipo:</label><br>
        <select name="tipo" id="tipo">
                <option value="GAME">GAME</option>
                <option value="ACESSORIO">ACESSORIO</option>
                <option value="CONSOLE">CONSOLE</option>
                <option value="ARCADE">CONSOLE</option>
            </select><br>

        <label>Plataforma: <br>
            <select name="plataforma" id="plataforma">
            <option value="PC">PC</option>
                <option value="XBOX CLASSICO">XBOX CLASSICO</option>
                <option value="XBOX 360">XBOX 360</option>
                <option value="PS1">PS1</option>
                <option value="PS2">PS2</option>
                <option value="PS3">PS3</option>
                <option value="PS4">PS4</option>
                <option value="NITENDINHO">NITENDINHO</option>
                <option value="NITENDO 64">NITENDO 64</option>
                <option value="NITENDO SWITCH">SWITCH</option>
                <option value="MEGADRIVE">MEGADRIVE</option>
                <option value="DREAMCAST">DREAMCAST</option>
            </select><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="4" required></textarea><br>

        <label for="valor">Valor:</label><br>
        <input type="text" id="valor" name="valor"><br>

        <label for="foto">Foto:</label><br>
        <input class="btn btn-primary" type="file" id="foto" name="foto">
        <br>
        <br>
        <hr>
        <input class="btn btn-primary" type="submit" name="cadastrar" value="Cadastrar" />
        <hr>
    </form>
</section>
</body>
</html>

<?php
    //chama arquivo externo do conexão com o Banco de Dados.
    include("../db/conexao.php");

    if (isset($_POST['cadastrar'])) 
    {    

            //Recebe os dodos do formulário no método Post e guarda nas seguintes variáveis.
            $produto = $_POST["produto"];
            $tipo = $_POST["tipo"];
            $plataforma = $_POST["plataforma"];
            $descricao = $_POST["descricao"];
            $foto = $_FILES["foto"];
            $valor = $_POST["valor"];

            $target_dir = "../../assets/img/cards/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Verifica se é uma imagem ou fake
            if(isset($_POST["submit"])) 
            {
              $check = getimagesize($_FILES["foto"]["tmp_name"]);
              if($check !== false) {
                echo "Imagem válida - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "Arquivo não contém uma imagem valida.";
                $uploadOk = 0;
              }
            }
            
            // Verifica se o arquivo já existe.
            if (file_exists($target_file)) 
            {
              echo "Arquivo de imagem já existente, por favor escolha outro.";
              $uploadOk = 0;
            }
            
            // Verifica tamanho do arquivo.
            if ($_FILES["foto"]["size"] > 500000) 
            {
              echo "O arquivo de imagem excede tamanho máximo permitido de 50Mb.";
              $uploadOk = 0;
            }
            
            // aceita apenas os arquivos com as extensões abaixo.
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) 
            {
              echo "Somente extensões .JPG, .JPEG, .PNG & .GIF são permitidos.";
              $uploadOk = 0;
            }
            
            // Verifica de tem algum problema no upload
            if ($uploadOk == 0) 
            {
              echo "Seu arquivo não será enviado, corrija o erro e tente novamente.";

            // se estiver ok, entao segue enviando a imagem.
            } 
            else 
            {
              if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "A foto". htmlspecialchars( basename( $_FILES["foto"]["name"])). " Foi enviado com sucesso.";
                $fotocapa=$_FILES["foto"]["name"];
                // Insere os dados no banco
                $sql = "INSERT INTO gamelandia.TB_produtos (produto, tipo, plataforma, descricao, foto, valor) VALUES ('$produto', '$tipo', '$plataforma', '$descricao', '$fotocapa','$valor')";
            
                    if ($conn->query($sql) === TRUE) 
                        {
                            $status = "Registro Salvo com Sucesso !";
                    
                            include("./listar_prod.php"); //chamar o arquivo PHP que lista os registros retornados do Banco de Dados.
                        } 
                        else // Se o Banco de Dados não conseguir registrar o formulário, aparece a seguinte mensagem de erro.
                        {
                            echo "Erro ao cadastrar registro no baco de Dados.";
                            
                        }

                    } 
                    else 
                    {
                        echo "Houve um erro ao enviar seu arquivo.";
                        
                    }
            }
        
        
    }

?>   

            
