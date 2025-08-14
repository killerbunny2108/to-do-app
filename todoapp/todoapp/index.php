<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
</head>
<body>
    <?php
        function Atualizar($id, $nome, $cpf, $endereco){
            $connection = require("dbfactory.php");                        
            if ($connection->query("UPDATE pessoas SET nome = '$nome', cpf = '$cpf', endereco = '$endereco' WHERE id = '$id'")) {                 
                echo "Atualizado com sucesso.";
            }
            $connection->close();
        }
        
        function Salvar($nome, $cpf, $endereco){
            $connection = require("dbfactory.php");                        
            if ($connection->query("INSERT INTO pessoas (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco')")) {                 
                echo "Salvo com sucesso.";
            }
            $connection->close();
        }
        
        function Recuperar(){
            $connection = require("dbfactory.php");
            $sql = "SELECT nome, cpf, endereco FROM pessoas"; 

            $result = $connection->query($sql);
            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>CPF</th><th>Endereço</th></tr>"; 
            while ($row = $result->fetch_assoc()) {           
                echo "<tr>"                          
                        . "<td>".$row["nome"]."</td>"
                        . "<td>".$row["cpf"]."</td>"
                        . "<td>".$row["endereco"]."</td>"
                    ."</tr>";
            }
            echo "</table>";
            $connection->close();
        }      

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome']; 
            $cpf = $_POST['cpf'];
            $endereco = $_POST['endereco'];
            
            if(!empty($nome) && !empty($cpf) && !empty($endereco)){
                Salvar($nome, $cpf, $endereco);
            }           
        }      

        Recuperar();        
    ?>
    <br>
    <form method="post">
        <label for="nome">Nome:</label>
        <input name="nome" id="nome" type="text">
        <br><br>
        
        <label for="cpf">CPF:</label>
        <input name="cpf" id="cpf" type="text">
        <br><br>
        
        <label for="endereco">Endereço:</label>
        <input name="endereco" id="endereco" type="text">
        <br><br>
        
        <button type="submit">Salvar</button>
    </form> 
</body>
</html>