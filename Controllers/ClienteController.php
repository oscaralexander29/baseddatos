<?php

require_once '../Model/Cliente.php';

if (isset($_GET['consult'])) { //Mostrar Usuarios
    $ClienteModel = new Cliente();

?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

    <table id="example" class="table table-striped table-hover table-bordered">
        <thead class="btn-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th width="8%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ClienteModel->MostrarCliente() as $data) {

            ?>

                <tr><input type="hidden" id="nombre_<?php echo $data['idcliente']; ?>" value="<?php echo $data['nombre']; ?>">
                    <input type="hidden" id="direccion_<?php echo $data['idcliente']; ?>" value="<?php echo $data['direccion']; ?>">

                    <td><?php echo $data['idcliente']; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['direccion']; ?></td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-bs-whatever="@mdo" onclick="editar(<?php echo $data['idcliente']; ?>)"><span class="fas fa-edit"></span></button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $data['idcliente']; ?>)"><span class="fas fa-trash"></span></button>

                        </div>
                    </td>
                </tr>


            <?php
            }

            ?>
        </tbody>
    </table>


<?php
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
    $ClienteModel = new Cliente();

    $ClienteModel->nombre = htmlentities($_POST['nombres']);
    $ClienteModel->direccion = htmlentities($_POST['direccion']);



    $client = $ClienteModel->RegistrarCliente($ClienteModel);

    if ($client) {
        echo "exito";
    } else {
        echo "error";
    }
} else if (isset($_GET['action']) && $_GET['action'] == "eliminar") {
    $$ClienteModel = new Cliente();

    $ClienteModel->id = htmlentities($_GET['id']);




    $client = $ClienteModel->eliminarCliente($ClienteModel);

    if ($client) {
        echo "exito";
    } else {
        echo "error";
    }
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $ClienteModel = new Cliente();
    $ClienteModel->idcliente = htmlentities($_POST['idedit']);
    $ClienteModel->nombre = htmlentities($_POST['nombresedit']);
    $ClienteModel->direccion = htmlentities($_POST['direccionedit']);



    $client = $ClienteModel->eliminarCliente($ClienteModel);

    if ($client) {
        echo "exito";
    } else {
        echo "error";
    }
}
?>