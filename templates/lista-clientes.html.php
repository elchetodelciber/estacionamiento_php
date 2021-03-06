<?php
    if (!isset($_SESSION)) {
        session_start();
    }  
?>

<?php
    if (isset($_SESSION['faltan_datos'])):
        echo    '<div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">'
                    . $_SESSION['faltan_datos'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        unset($_SESSION['faltan_datos']);
    endif;
?>

<div class="card card-signin my-5">
    <div class="row" style="margin:3px">
        <div class ="col">
            <a href="../functions/home-empleado.php" class="float-left btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="card-body">
        <h1>Lista de clientes</h1><br><br>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>PATENTE</th>
                        <th>DNI</th>
                        <th class="filter-select filter-exact" data-placeholder="Tipo de cliente">TIPO</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="7" class="ts-pager">
                            <div class="form-inline">
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary first" title="first">⇤</button>
                                <button type="button" class="btn btn-secondary prev" title="previous">←</button>
                            </div>
                            <span class="pagedisplay"></span>
                            <div class="btn-group btn-group-sm mx-1" role="group">
                                <button type="button" class="btn btn-secondary next" title="next">→</button>
                                <button type="button" class="btn btn-secondary last" title="last">⇥</button>
                            </div>
                            <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">All Rows</option>
                            </select>
                            <select class="form-control-sm custom-select px-4 mx-1 pagenum" title="Select page number"></select>
                            </div>
                        </th>   
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td>
                            <?=htmlspecialchars($cliente['NOMBRE_CLIENTE'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($cliente['EMAIL'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($cliente['PATENTE'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($cliente['DNI'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <?=htmlspecialchars($cliente['DESCRIPCION'], ENT_QUOTES, 'UTF-8')?>
                        </td>
                        <td>
                            <form action="./../functions/editar-cliente.php" method="post">
                                <input type="hidden" name="key" value="./../functions/editar-cliente.php">
                                <input type="hidden" name="editarCliente" value="<?=$cliente['PATENTE']?>">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-user-edit"></i> Editar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('form').submit(function (e) { 
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: dataForm,
            success: function (response) {
                $('#body').html(response);
                activateTablesorter();
            }
        });
    });
</script>