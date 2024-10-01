<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "notas_alunos"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['create'])) {
    $nome_aluno = $_POST['nome_aluno'];
    $nota = $_POST['nota'];

    $sql = "INSERT INTO alunos (nome_aluno, nota) VALUES ('$nome_aluno', 
    '$nota')";

    if ($conn->query($sql) === TRUE) {
        echo "informaçoes do aluno enviadas com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['update'])) {
    $id_aluno = $_POST['id_aluno'];
    $nome_aluno = $_POST['nome_aluno'];
    $nota = $_POST['nota'];

    $sql = "UPDATE alunos SET nome_aluno='$nome_aluno', nota='$nota' WHERE id_aluno=$id_aluno";

    if ($conn->query($sql) === TRUE) {
        echo "foi mudado as informaçoes do aluno";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id_aluno = $_GET['delete'];
    $sql = "DELETE FROM alunos WHERE id_aluno=$id_aluno";

    if ($conn->query($sql) === TRUE) {
        echo "informaçoes excluídas com sucesso!";
    } else {
        echo "Erro ao excluir a mudança: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM alunos");
?>

<!DOCTYPE html>
<html>
<head>
    <title>cistemas de notas</title>
</head>
<body>
<h2>Adicionar aluno</h2>
<form method="POST" action="">
    Nome do aluno: <input type="text" name="nome_aluno" required><br><br>
    nota: <input type="text" name="nota" required><br><br>
    <input type="submit" name="create" value="Adicionar Pedido">
</form>

<h2>Lista de alunos</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome do aluno</th>
        <th>nota</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id_alunos']; ?></td>
        <td><?php echo $row['nome_aluno']; ?></td>
        <td><?php echo $row['nota']; ?></td>
        <td>
            <a href="index.php?delete=<?php echo $row['id']; ?>">Excluir</a>
            <a href="index.php?update=<?php echo $row['id']; ?>">Update</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Atualizar o aluno</h2>

<form method="POST" action="">
    ID do aluno: <input type="number" name="id_aluno" required><br><br>
    Nome do aluno: <input type="text" name="nome_aluno" required><br><br>
    nota: <input type="text" name="nota" required><br><br>
    <input type="submit" name="update" value="Adicionar Pedido">
</form>

</body>
</html>

<?php $conn->close(); ?>
