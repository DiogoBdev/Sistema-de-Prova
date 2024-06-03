<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de alunos</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="../css/styles.css" rel="stylesheet">

    <style>
        .top-form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .div-rounded {
            border-radius: 10px;
            width: 80%;
        }
    </style>
</head>

<body>
    <div class="top-form">
        <div class="div-rounded">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-center">Sistema escolar</h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid text-center py-4">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-2">
                                <a href="provasAgendadas.php" class="btn btn-primary btn-lg btn-block btn-square">
                                    <i class="fas fa-calendar-alt"></i> <br> Provas Agendadas
                                </a>
                            </div>
                            <div class="col-4 col-lg-2">
                                <a href="../provas/provasRealizadas.php" class="btn btn-secondary btn-lg btn-block btn-square">
                                    <i class="fas fa-check"></i> <br> Provas Realizadas
                                </a>
                            </div>
                            <div class="col-4 col-lg-2">
                                <a href="../login.php" class="btn btn-danger btn-lg btn-block btn-square">
                                    <i class="fas fa-sign-out-alt"></i> <br> Logout
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Incluindo o JavaScript do Bootstrap (opcional, mas recomendado para funcionalidades como o menu responsivo) -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <!-- Utilizando jQuery completo -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <!-- Incluindo Font Awesome para ícones (se necessário) -->
                    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
