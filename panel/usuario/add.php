<?php
include("../../connections/conexion.php");
?>

        <form style="padding:10px" id="add_usuario">
            <div class="row g-3 align-items-center">
                <div class="" style="margin:30px auto">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" onclick="listar_usuario(1)" class="btn btn-danger">Volver</button>
                </div>
            </div>

            <div class="row g-3 align-items-center">
                <div class="col-12" style="  text-align: center;  margin: 10px;" id="prev1">
                    <img src="../../images/empty.jpg" style="width:200px;height:200px" alt="">
                </div>
            </div>

            <div class="row g-3 align-items-center">
                <div class="" style="margin:30px auto">
                    <input type="file" id="file-previ1" onchange="previ('prev1','idbase1','file-previ1')" required
                        class="form-control" autocomplete="off" aria-describedby="nombre">
                    <input type="hidden" id="idbase1" name="idbase1" value="">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Usuario</label>
                </div>
                <div class="col-9">
                    <input type="text" name="usuario" required autocomplete="off" class="form-control" placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Contraseña</label>
                </div>
                <div class="col-9">
                    <input type="text" name="password" required autocomplete="off" class="form-control"
                        placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Nombres</label>
                </div>
                <div class="col-9">
                    <input type="text" name="nombres" required autocomplete="off" class="form-control" placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Rol</label>
                </div>
                <div class="col-9">
                    <input type="text" name="rol" required autocomplete="off" class="form-control" placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">ColorNav</label>
                </div>
                <div class="col-9">
                    <input type="text" name="colorNav" required autocomplete="off" class="form-control"
                        placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">ColorFondo</label>
                </div>
                <div class="col-9">
                    <input type="text" name="colorFondo" required autocomplete="off" class="form-control"
                        placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Celular</label>
                </div>
                <div class="col-9">
                    <input type="text" name="celular" required autocomplete="off" class="form-control" placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Habilitado</label>
                </div>
                <div class="col-9">
                    <input type="text" name="habilitado" required autocomplete="off" class="form-control"
                        placeholder="Escriba...">
                </div>
            </div><br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Fecha caduca</label>
                </div>
                <div class="col-9">
                    <input type="date" name="fechaCaduca" required autocomplete="off" class="form-control">
                </div>
            </div><br>
        </form>