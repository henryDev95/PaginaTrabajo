<?= require('../templates/Header.php'); ?>
<?= require('../templates/Menu.php'); ?>

<div class="main-panel">

    <div class="container">

        <div class="row">

            <div class="col-sm-12">
            
                <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="fa fa-plus"></span> Nuevo</a>
                <a href="../views/reporte.view.php" class="btn btn-primary" ><span class="fa fa-file-pdf-o"></span> Generar Reporte</a>
                <?php
                session_start();
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php

                    unset($_SESSION['message']);
                }
                ?>
                <table class="table table-bordered table-striped" style="margin-top:20px;">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        <?php
                        // incluye la conexión
                        include_once('../BaseDatos/connection.php');

                        $database = new Connection();
                        $db = $database->open();
                        try {
                            $sql = 'SELECT * FROM members';
                            foreach ($db->query($sql) as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <a href="#edit_<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Editar</a>
                                        <a href="#delete_<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Eliminar</a>
                                    </td>
                                    <?php include('../templates/modal/delete_modal.php'); ?>
                                    <?php include('../templates/modal/edit_modal.php'); ?>
                                   
                                </tr>
                        <?php
                            }
                        } catch (PDOException $e) {
                            echo "There is some problem in connection: " . $e->getMessage();
                        }

                        //cerrar conexión
                        $database->close();

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php include('../templates/modal/add_modal.php'); ?>
<?= require('../templates/Footer.php'); ?>