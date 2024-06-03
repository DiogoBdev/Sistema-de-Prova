<?php
require_once('conectar.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salvar as variáveis com o que foi digitado no formulário
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

    // Consulta preparada para verificar a existência do usuário
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($email === "admin@admin.com" && $senha === "123") {
        header("Location: administrador/painelAdmin.php");
    } else {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($senha === $user['senha']) {
                if ($user['tipo'] == 'professor') {
                    header("Location: professor/professorAdmin.php");
                } elseif ($user['tipo'] == 'aluno') {
                    header("Location: aluno/alunoAdmin.php");
                } else {
                    header("Location: login.php?error=Tipo de usuário desconhecido.");
                }
                exit();
            } else {
                header("Location: login.php?error=Senha inválida.");
                exit();
            }
        } else {
            header("Location: login.php?error=Usuário não encontrado.");
            exit();
        }
    }
    $stmt->close();
}
$con->close();
?>