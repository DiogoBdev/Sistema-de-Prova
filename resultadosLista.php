<?php
require_once ('../conectar.php');

// Parâmetros de filtro
$search_aluno = isset($_GET['aluno']) ? $_GET['aluno'] : '';
$search_prova = isset($_GET['prova']) ? $_GET['prova'] : '';

// Consulta SQL para obter os resultados dos alunos nas provas
$sql = "SELECT u.nome AS aluno_nome, p.titulo AS titulo_prova, t.nome AS professor, COUNT(q.id) AS num_questoes,
               SUM(IF(a.correta = 1, 1, 0)) AS corretas,
               SUM(IF(a.correta = 0, 1, 0)) AS incorretas,
               SUM(IF(a.correta = 1, q.peso, 0)) AS nota
        FROM Respostas r
        JOIN Usuarios u ON r.aluno_id = u.id
        JOIN Provas p ON r.prova_id = p.id
        JOIN Usuarios t ON p.professor_id = t.id
        JOIN Questoes q ON r.questao_id = q.id
        LEFT JOIN Alternativas a ON r.alternativa_id = a.id 
        WHERE 1"; // Cláusula inicial sempre verdadeira

// Adicionar filtros se forem fornecidos
if (!empty($search_aluno)) {
    $safe_search_aluno = mysqli_real_escape_string($con, $search_aluno);
    $sql .= " AND u.nome LIKE '%$safe_search_aluno%'";
}

if (!empty($search_prova)) {
    $safe_search_prova = mysqli_real_escape_string($con, $search_prova);
    $sql .= " AND p.titulo LIKE '%$safe_search_prova%'";
}

$sql .= " GROUP BY u.nome, p.titulo order by p.titulo, u.nome ";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados das Provas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }

        .table-container {
            max-height: 650px;
            overflow-y: auto;
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
                            <input type='text' class='form-control mr-2' placeholder='Busca por nome do aluno'
                                name='aluno' value='<?= htmlspecialchars($search_aluno) ?>'>
                            <input type='text' class='form-control mr-2' placeholder='Busca por título da prova'
                                name='prova' value='<?= htmlspecialchars($search_prova) ?>'>
                            <div class='input-group-append'>
                                <button class='btn btn-primary' type='submit'><i class='bi bi-search'></i> Pesquisar
                                </button>
                            </div>
                        </div>
                    </form>




                    <?php if ($result && $result->num_rows > 0): ?>
                        <div class='table-container'>
                            <table class='table table-striped'>
                                <thead class='thead-dark' style='position: sticky; top: 0; z-index: 2;'>
                                    <tr>
                                        <th class="bg-dark text-light">Nome do Aluno</th>
                                        <th class="bg-dark text-light">Prova</th>
                                        <th class="bg-dark text-light">Professor</th>
                                        <th class="bg-dark text-light">Questões</th>
                                        <th class="bg-dark text-light">Corretas</th>
                                        <th class="bg-dark text-light">Incorretas</th>
                                        <th class="bg-dark text-light">Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['aluno_nome']) ?></td>
                                            <td><?= htmlspecialchars($row['titulo_prova']) ?></td>
                                            <td><?= htmlspecialchars($row['professor']) ?></td>
                                            <td class="text-center" style="color: blue;font-weight: bold;">
                                                <?= $row['num_questoes'] ?></td>
                                            <td class="text-center" style="color: green;font-weight: bold;">
                                                <?= $row['corretas'] ?></td>
                                            <td class="text-center" style="color: red;font-weight: bold;">
                                                <?= $row['incorretas'] ?></td>
                                            <td class="text-center" style="color: black;font-weight: bold;"><?= $row['nota'] ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                    <?php else: ?>
                        <div class='alert alert-warning' role='alert'>Nenhum registro encontrado.</div>
                    <?php endif; ?>

                    <a href="../professor/professorAdmin.php" class="btn btn-secondary btn-voltar"><i
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