<main class="contenedor">

    <div class="container-card">

        <h3>Añada un contacto</h3>
        <div class="form-card">

            <form method="POST" id="form-contacto">

                <legend>Todos los campos son obligatorios</legend>

                <div class="flex">

                    <div class="flex-column">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre Contacto" value="">
                    </div>

                    <div class="flex-column">
                        <label for="empresa">Empresa:</label>
                        <input type="text" id="empresa" name="empresa" placeholder="Empresa" value="">
                    </div>

                    <div class="flex-column">
                        <label for="telefono">Telefono:</label>
                        <input type="text" id="telefono" name="telefono" placeholder="Telefono" value="">
                    </div>

                </div>

                <div class="submit">

                    <input type="submit" id="submit" value="crear">
                </div>
            </form>



        </div>



</main>

<div class="contenedor seccion-contactos">


    <div class="margin-top">
        <div class="container-card heigth-auto">
            <h3>Contactos</h3>
            <div class="form-card container-buscador">

                <input class="buscador" type="text" placeholder="Busca un contacto" value="" name="contacto">

            </div>

            <h3><span class="num-contacto">1</span> Contactos</h3>

            <table class="container-buscador">

                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>



                </thead>

                <tbody id="registro_contacto">

                <?php foreach($contactos as $contacto): ?> 

                    <tr>
                        <td><?php echo $contacto->nombre ?></td>
                        <td><?php echo $contacto->empresa ?></td>
                        <td><?php echo $contacto->telefono ?></td>
                        <td>
                            <div class="flex-icon">

                                <a href="models/actualizar?id=<?php echo $contacto->id?>"><i class="fas fa-pencil-alt"></i></a>
                                <a data-set="<?php echo $contacto->id?>" class="eliminar"><i class="fas fa-trash-alt"></i></a>

                            </div>
                        </td>


                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>
        </div>


    </div>