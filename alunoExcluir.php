<?php
require_once('../conectar.php');

// Verifica se a requisição é POST e se o ID foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Exclui o registro do banco de dados
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: alunoLista.php");
    } else {
        echo "Erro ao excluir o registro: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Requisição inválida.";
}
?>