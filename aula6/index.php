<?php
// conexão com WorkBench
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "escola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Inserção dos professores
if (isset($_POST['action']) && $_POST['action'] == 'inserir_professor') {
    $nome = $_POST['nome'];

    $sql = "INSERT INTO professores (nome) VALUES ('$nome')";
    if ($conn->query($sql) === TRUE) {
        echo "Novo professor inserido com sucesso!<br>";
    } else {
        echo "Erro ao inserir professor: " . $conn->error;
    }
}

// Atualizar Professores
if (isset($_POST['action']) && $_POST['action'] == 'atualizar_professor') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $sql = "UPDATE professores SET nome='$nome' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Professor atualizado com sucesso!<br>";
    } else {
        echo "Erro ao atualizar professor: " . $conn->error;
    }
}

// Excluir Professores
if (isset($_POST['action']) && $_POST['action'] == 'deletar_professor') {
    $id = $_POST['id'];

    $sql = "DELETE FROM professores WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Professor deletado com sucesso!<br>";
    } else {
        echo "Erro ao deletar professor: " . $conn->error;
    }
}

// Inserir Aulas
if (isset($_POST['action']) && $_POST['action'] == 'inserir_aula') {
    $sala = $_POST['sala'];
    $professor_id = $_POST['professor_id'];

    $sql = "INSERT INTO aulas (sala, professor_id) VALUES ('$sala', $professor_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Nova aula inserida com sucesso!<br>";
    } else {
        echo "Erro ao inserir aula: " . $conn->error;
    }
}

// Inserir Diárias
if (isset($_POST['action']) && $_POST['action'] == 'inserir_diaria') {
    $hora_aula = $_POST['hora_aula'];

    $sql = "INSERT INTO diaria (hora_aula) VALUES ($hora_aula)";
    if ($conn->query($sql) === TRUE) {
        echo "Diária inserida com sucesso!<br>";
    } else {
        echo "Erro ao inserir diária: " . $conn->error;
    }
}

// Listar Professores
echo "<h3>Lista de Professores</h3>";
$sql = "SELECT * FROM professores";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhum professor cadastrado.<br>";
}

// Listar Aulas
echo "<h3>Lista de Aulas</h3>";
$sql = "SELECT aulas.id, aulas.sala, professores.nome 
        FROM aulas 
        INNER JOIN professores ON aulas.professor_id = professores.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Aula ID: " . $row["id"] . " - Sala: " . $row["sala"] . " - Professor: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhuma aula cadastrada.<br>";
}

// Listar Diárias
echo "<h3>Lista de Diárias</h3>";
$sql = "SELECT * FROM diaria";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Diária ID: " . $row["id"] . " - Hora Aula: " . $row["hora_aula"] . "<br>";
    }
} else {
    echo "Nenhuma diária cadastrada.<br>";
}
?>

<h3>Inserir Professor</h3>
<form method="post" action="">
    <input type="hidden" name="action" value="inserir_professor">
    Nome: <input type="text" name="nome" required>
    <input type="submit" value="Inserir Professor">
</form>

<h3>Atualizar Professor</h3>
<form method="post" action="">
    <input type="hidden" name="action" value="atualizar_professor">
    ID: <input type="text" name="id" required>
    Nome: <input type="text" name="nome" required>
    <input type="submit" value="Atualizar Professor">
</form>

<h3>Deletar Professor</h3>
<form method="post" action="">
    <input type="hidden" name="action" value="deletar_professor">
    ID: <input type="text" name="id" required>
    <input type="submit" value="Deletar Professor">
</form>

<h3>Inserir Aula</h3>
<form method="post" action="">
    <input type="hidden" name="action" value="inserir_aula">
    Sala: <input type="text" name="sala" required>
    Professor ID: <input type="text" name="professor_id" required>
    <input type="submit" value="Inserir Aula">
</form>

<h3>Inserir Diária</h3>
<form method="post" action="">
    <input type="hidden" name="action" value="inserir_diaria">
    Hora Aula: <input type="text" name="hora_aula" required>
    <input type="submit" value="Inserir Diária">
</form>
