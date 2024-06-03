<?php
 
require_once ('../conectar.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT id, nome, email FROM usuarios WHERE tipo = 'Aluno' ";
if ($search) {
    $sql .= " AND (nome LIKE '%$search%' OR email LIKE '%$search%')";
}

$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de alunos</title>
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
            justify-content: center;
        height: 90%; /* Mantido o tamanho de altura desejado */
        margin: auto; /* Centraliza a div na página */
        display: flex;
        flex-direction: column;
        }

        .table-container {
            max-height: 650px; /* Defina a altura máxima desejada */
                   overflow-y: auto; /* Adiciona a barra de rolagem vertical */
        }
    </style>
</head>

<body>





<div class="center-form">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">

 
                <h3 class="text-center">Alunos</h3>
            </div>
            <div class="card-body">
                <form method='get' class='mb-3'>
                    <div class='input-group'>
                        
                    <input type='text' class='form-control mr-2' placeholder='Buscar por nome ou email' name='search'
                            value='<?= htmlspecialchars($search) ?>'>
                    
                            <div class='input-group-append'>
                    
                            <button class='btn btn-primary mr-2' type='submit'><i class='bi bi-search'></i> Pesquisar</button>
                    
                            <a href='alunoAdicionar.php' class='btn btn-success'><i class='bi bi-plus'></i> Adicionar</a>
                        </div>
                    </div>
                </form>

                <?php if ($result->num_rows > 0): ?>
                    <div class='table-container'>
                        <table class='table table-striped'>
                            <thead class='thead-dark' style='position: sticky; top: 0; z-index: 2;'>
                                <tr>
                                    <th class='bg-dark text-light'>ID</th>
                                    <th class='bg-dark text-light'>Nome</th>
                                    <th class='bg-dark text-light'>E-mail</th>
                                    <th class='bg-dark text-light' style='width: 130px;'> </th>
                                    <th class='bg-dark text-light' style='width: 130px;'> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['nome'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><a href='alunoEditar.php?id=<?= $row['id'] ?>' class='btn btn-sm btn-warning'><i
                                                    class='bi bi-pencil-square'></i> Editar</a></td>
                                        <td><button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#confirmDeleteModal'
                                                data-id='<?= $row['id'] ?>'><i class='bi bi-trash'></i> Excluir</button></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                <?php else: ?>
                    <div class='alert alert-warning' role='alert'>Nenhum registro encontrado.</div>
                <?php endif; ?>
                
                <a href="../professor/professorAdmin.php" class="btn btn-secondary btn-voltar"><i class="bi bi-arrow-left"></i>
                    Voltar</a>
            </div>
        </div>
    </div>
</div>



    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este aluno?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="post" action="alunoExcluir.php" style="display: inline;">
                        <input type="hidden" name="id" id="deleteId">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botão que acionou o modal
            var id = button.data('id'); // Extrai a informação dos dados do botão
            var modal = $(this);
            modal.find('#deleteId').val(id);
        });
    </script>
</body>

</html>
