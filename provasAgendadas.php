<?php
require_once ('../conectar.php');

$currentDate = date('Y-m-d H:i:s');
$search = isset($_GET['search']) ? $_GET['search'] : '';
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';

// Construção da consulta SQL com a cláusula de filtro (se houver pesquisa)
$sql = "SELECT p.id, p.titulo, p.descricao, p.data_inicio, p.data_fim, u.nome AS professor_nome
        FROM provas p
        JOIN usuarios u ON p.professor_id = u.id
        WHERE p.data_fim >= '$currentDate'";

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($con, $search); // Escapar caracteres especiais para segurança
    $sql .= " AND (p.titulo LIKE '%$safe_search%' OR p.descricao LIKE '%$safe_search%')";
}

if (!empty($data_inicio)) {
    $sql .= " AND DATE(p.data_inicio) = '$data_inicio'";
}

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provas Agendadas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }

        .btn-voltar {
            float: right;
        }

        .main-div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* Centraliza verticalmente */
            height: 90%;
            /* Altura desejada */
            margin: auto;
            /* Centraliza horizontalmente */
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px; /* Espaço entre os campos e o botão */
        }

        .form-group .form-control {
            margin-right: 10px;
        }

        .form-control[type='date'] {
            max-width: 200px; /* Reduzindo o tamanho do campo de data */
        }

        .table-container {
            max-height: 650px;
            /* Altura máxima */
            overflow-y: auto;
            /* Barra de rolagem vertical */
        }

        
    </style>
</head>

<body>

    <div class="center-form">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-center">Provas agendadas</h3>
                </div>
                <div class="card-body">




                <form method='get' class='mb-3'>
                    <div class='input-group'>
                        
                    <input type='text' class='form-control mr-2' placeholder='Buscar por nome ou email' name='search'
                            value='<?= htmlspecialchars($search) ?>'>
                            <input type='date' class='form-control mr-2' id='data_inicio'
                                   placeholder='Escolha a data de início' name='data_inicio'
                                   value='<?= htmlspecialchars($data_inicio) ?>'>
                            <div class='input-group-append'>
                    
                            <button class='btn btn-primary mr-2' type='submit'><i class='bi bi-search'></i> Pesquisar</button>
       
                        </div>
                    </div>
                </form>


               

                    <?php if ($result && $result->num_rows > 0): ?>
                        <div class='table-container'>
                            <table class='table table-striped'>
                                <thead class='thead-dark' style='position: sticky; top: 0; z-index: 2;'>
                                    <tr>
                                        <th class='bg-dark text-light'>ID</th>
                                        <th class='bg-dark text-light'>Título</th>
                                        <th class='bg-dark text-light'>Descrição</th>
                                        <th class='bg-dark text-light'>Data de Início</th>
                                        <th class='bg-dark text-light'>Data de Fim</th>
                                        <th class='bg-dark text-light'>Professor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['titulo']) ?></td>
                                            <td><?= htmlspecialchars($row['descricao']) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($row['data_inicio'])) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($row['data_fim'])) ?></td>
                                            <td><?= htmlspecialchars($row['professor_nome']) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                    <?php else: ?>
                        <div class='alert alert-warning' role='alert'>Nenhum registro encontrado.</div>
                    <?php endif; ?>

                    <a href="../aluno/alunoAdmin.php" class="btn btn-secondary btn-voltar"><i
                            class="bi bi-arrow-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
