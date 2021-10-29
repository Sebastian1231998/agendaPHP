<main class="contenedor">

    <div class="container-card">

        <h3>Actualizar un contacto</h3>
        <div class="form-card">

            <form method="POST" id="form-contacto">

                <legend>Todos los campos son obligatorios</legend>

                <div class="flex">

                    <div class="flex-column">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre Contacto" value="<?php echo sanitizar($contacto->nombre) ?>">
                    </div>

                    <div class="flex-column">
                        <label for="empresa">Empresa:</label>
                        <input type="text" id="empresa" name="empresa" placeholder="Empresa" value="<?php echo sanitizar($contacto->empresa) ?>">
                    </div>

                    <div class="flex-column">
                        <label for="telefono">Telefono:</label>
                        <input type="text" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo sanitizar($contacto->telefono) ?>">
                    </div>

                </div>

                <div class="submit">

                    <input type="submit" id="submit" value="actualizar">
                </div>
            </form>



        </div>



</main>