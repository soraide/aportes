        <?php
                         
    include("../../connections/conexion.php");
    $id = $_POST["id"];
    $sql= "SELECT * FROM tblUsuario WHERE idUsuario='$id' " ;
    $query=sqlsrv_query($con,$sql);
    $row=sqlsrv_fetch_array($query);

     $usuario=$row["usuario"];  $password=$row["password"];  $nombres=$row["nombres"];  $rol=$row["rol"];  $colorNav=$row["colorNav"];  $colorFondo=$row["colorFondo"];  $celular=$row["celular"];  $habilitado=$row["habilitado"];  $fechaCaduca=$row["fechaCaduca"]; 
                        $t=time();

                       ?>
                        
                       <form style="padding:10px" id="edit_usuario">
                            <input type="hidden" name="idUsuario" value="<?php echo $id;?>">       
                            <div class="row g-3 align-items-center">
                                <div class="" style="margin:30px auto">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button type="button" onclick="listar_usuario(1)" class="btn btn-danger">Volver</button>
                                </div>
                            </div>
                            

                <?php
                    $url="../../images/admins/".$id.".jpg";
                    if(!file_exists($url)){
                        $url="../../images/empty.jpg"; 
                    }else{
                        $url="../../images/admins/".$id.".jpg?r=".$t;
                    }
                ?>

                <div class="row g-3 align-items-center">
                    <div class="col-12" style="  text-align: center;  margin: 10px;" id="prev1">
                        <img src="<?php echo $url;?>" style="width:200px;height:200px;border-radius:10px" alt="">
                    </div>
                </div>
    
                <div class="row g-3 align-items-center">
                    <div class="" style="margin:30px auto">
                        <input type="file" id="file-previ1" onchange="previ('prev1','idbase1','file-previ1')" class="form-control" autocomplete="off" aria-describedby="nombre">
                        <input type="hidden" id="idbase1" name="idbase1" value="">
                    </div>
                </div> 
                <br>
                            <div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Usuario</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="usuario" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $usuario?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Password</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="password" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $password?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Nombres</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="nombres" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $nombres?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Rol</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="rol" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $rol?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">ColorNav</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="colorNav" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $colorNav?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">ColorFondo</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="colorFondo" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $colorFondo?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Celular</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="celular" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $celular?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                                <div class="col-2">
                                                    <label class="col-form-label">Habilitado</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="habilitado" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo $habilitado?>">
                                                </div>
                                            </div><br><div class="row g-3 align-items-center">
                                            <div class="col-2">
                                                <label class="col-form-label">Fecha caduca</label>
                                            </div>
                                        <div class="col-9">
                                            <input type="date" name="fechaCaduca" required  autocomplete="off"  class="form-control" placeholder="Escriba..." value="<?php echo formato_fechas_server($fechaCaduca,'Y-m-d'); ?>">
                                        </div>
                                    </div><br>
                        </form>

    