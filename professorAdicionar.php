<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar professor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>



    <?php
    require_once ('../conectar.php');

    // Consulta para obter o próximo ID disponível
    $sql = "SELECT MAX(id) AS max_id FROM usuarios";
    $result = $con->query($sql);
    $next_id = 1; // Valor padrão se não houver registros ainda
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] + 1;
    }
    ?>




    <div class="center-form">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-center">Incluindo professor</h3>
                </div>
                <div class="card-body">
                    <div class="container">

                    <form action="professorGravar.php" method="post">
    <div class="form-group">
        <label for="id">ID:</label>
        <input type="text" class="form-control" id="id" name="id" value="<?= $next_id ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select class="form-control" id="tipo" name="tipo" required disabled>
            <option value="professor" selected>Professor</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Gravar</button>
    <a href="professorLista.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
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