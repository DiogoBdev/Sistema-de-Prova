<?php
require_once ('../conectar.php');

// Obtém o ID do aluno a ser editado
$id = $_GET['id'];

// Busca os dados do aluno no banco de dados
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$aluno = $result->fetch_assoc();

// Verifica se o aluno existe
if (!$aluno) {
    echo "Aluno não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
   
</head>

<body>
    <div class="center-form">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                <h3 class="text-center">Editando aluno</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="alunoGravar.php" method="post">
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input type="text" class="form-control rounded" id="id" name="id" value="<?= $aluno['id'] ?>"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control rounded" id="nome" name="nome"
                                    value="<?= $aluno['nome'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control rounded" id="email" name="email"
                                    value="<?= $aluno['email'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control rounded" id="senha" name="senha"
                                    value="<?= $aluno['senha'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select class="form-control rounded" id="tipo" name="tipo" required disabled>
                                    <option value="aluno" selected>Aluno</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Gravar</button>
                            <a href="alunoLista.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
