         <?php
                            include_once("../../connections/conexion.php");
                    ?>
                
            <form style="padding:10px" id="add_modulo">
                <div class="row g-3 align-items-center">
                        <div class="" style="margin:30px auto">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-2">
                        <label class="col-form-label">Módulo</label>
                    </div>                             
                    <div class="col-9">
                        <input type="text" name="modulo" required  autocomplete="off"  class="form-control" placeholder="Escriba...">
                    </div>
                </div><br>

                <div class="row g-3 align-items-center">
                    <div class="col-2">
                        <label class="col-form-label">Curso</label>
                    </div>
                    <div class="col-9">
                        <select class="form-control" name="idCurso">
                            <?php
                                    $sql="SELECT * FROM tblCurso";
                                    $query=sqlsrv_query($con,$sql);
                                    while($row=sqlsrv_fetch_array($query)){
                                        $value=$row["idCurso"];
                                        $texto=$row["curso"];
                                        echo  " <option value='".$value."'>".$texto."</option> " ;
                                    }
                            ?>
                        </select>
                    </div>
                </div><br>
            </form>