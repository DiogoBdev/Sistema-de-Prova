<?php
require_once('../conectar.php');

// Obtém os dados do formulário
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = 'professor'; // Definido como 'professor'

// Verifica se o usuário já existe na tabela
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Atualiza o registro existente
    $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, tipo = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $senha, $tipo, $id);
    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o registro: " . $con->error;
    }
} else {
    // Insere um novo registro
    $sql = "INSERT INTO usuarios (id, nome, email, senha, tipo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("issss", $id, $nome, $email, $senha, $tipo);
    if ($stmt->execute()) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir o registro: " . $con->error;
    }
}

$stmt->close();
$con->close();

// Redireciona de volta para a lista de professors
header("Location: professorLista.php");
exit();
?>
