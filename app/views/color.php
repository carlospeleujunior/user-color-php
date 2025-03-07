<!DOCTYPE html>
<html>
<head>
    <title>Cores Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .custom-title {
            background-color: #f0f0f0;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
        }

        .custom-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header custom-title">
                Adicionar ou Remover Cores
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cor</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cores as $key => $c) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $c['cor'] ?></td>
                            <td class="text-center">
                                <?= $c['status'] == 1 ? "<i style='color:green' title='Cor Ativa' class='fas fa-check'></i>" : "<i style='color:red' title='Cor Inativa' class='fas fa-times'></i>" ?>
                            </td>
                            <td>
                                <?= $c['status'] == 0 ? "<a data-in_status='1' data-addcor='". $c['id'] ."' class='btn btn-success btn-sm btn_cor'> <i class='fas fa-plus'></i> Adicionar</a>" :
                                "<a  data-in_status='0' data-addcor='". $c['id'] ."' class='btn btn-danger btn-sm btn_cor'> <i class='fas fa-trash'></i> Excluir</a>"?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-right">
            <a href="index.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
        </div>
        
    </div>
    <input type="hidden" value="<?= $id_cli ?>" name="id_cliente" id="id_cliente">
</body>
</html>

<script>
    const buttons = document.querySelectorAll('.btn_cor');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const addCorValue = button.getAttribute('data-addcor');
            let idCliente = $('#id_cliente').val();
            const inStatus = button.getAttribute('data-in_status');

            $.ajax({
                type: 'POST',
                url: 'index.php?action=add_cor',
                data: { 
                    addcor: addCorValue,
                    id_client:  idCliente,
                    action: 'add_cor',
                    in_status: inStatus

                },
                success: function(response) {
                    if (response.status === 'success') {
                        setTimeout(function() {
                            window.location.href = 'index.php?action=add_cores&id='+idCliente;
                        }, 1000); 
                    }
                },
                error: function(error) {
                    console.error('Erro AJAX:', error);
                }
            });
        });
    });

</script>