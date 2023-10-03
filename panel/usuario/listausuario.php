        
      <?php
                
                include("../../connections/conexion.php");
                
                $start_from=$_POST['start'];
                $search_in_sql = "";
                if(isset($_POST['texto']) && !empty($_POST['texto'])){
                    $texto=$_POST['texto'];
                    $search_in_sql .= " WHERE (usuario like '%".$texto."%'  OR nombres like '%".$texto."%'  OR rol like '%".$texto."%'  OR celular like '%".$texto."%'  OR habilitado like '%".$texto."%' ) ";
                }

                // if(strlen(trim($search_in_sql)) == 0){
                //     $search_in_sql .= " WHERE ";
                // }else{
                //     $search_in_sql .= " AND ";
                // }

                $sql=" SELECT * FROM tblUsuario $search_in_sql ORDER BY idUsuario DESC offset $start_from ROWS FETCH NEXT 10 ROWS ONLY;";
                // echo $sql;
                $query=sqlsrv_query($con,$sql);      
                $count_row=sqlsrv_has_rows($query);
                if($count_row === false){
                    echo "<div style='text-align:center'><h2>Lista de Usuario vacia!</h2></div>";
                }else{       

                    $resultado='<div class="table-responsive">
                        <table style="text-align:center" class="table table-hover">
                            <tr>
                                <th>
                                    Información      
                                </th>
                                  
                                    <th>
                                        Usuario
                                    </th>
                                
                                    <th>
                                        Nombre
                                    </th>
                                
                                    <th>
                                        Rol
                                    </th>
                                
                                    <th>
                                        Celular
                                    </th>
                                
                                    <th>
                                        Habilitado
                                    </th>
                                
                                <th>
                                    Opciones
                                </th>
                            </tr>
                            ';

                $t=time();
                while($row=sqlsrv_fetch_array($query)){ 

                    $id=$row['idUsuario'];
                    $expand="expand";
                    $sector="sector".$id;
                    
                          $url="../../images/admins/".$id.".jpg"; 
                          if(!file_exists($url)){
                            $url="../../images/empty.jpg"; 
                          }
                          $url .= "?r=".$t;
                       
                    $otro="    
                                    <div id='sector".$id."' class='email' onclick='this.classList.add(\"$expand\")'>
                                        <div class='from'>
                                            <div class='from-contents'>
                                            <div class='avatar me' style='background-image: url($url)'></div>
                                            <div class='name'>".$row['usuario']."</div>
                                            </div>
                                        </div>
                                        <div class='to'>
                                            <div class='to-contents'>
                                            <div class='top'>
                                                <div class='avatar-large me' style='background-image: url()'></div>
                                                <div class='name-large'>".$row['usuario']."</div>
                                                <div class='x-touch' onclick='document.getElementById(\"$sector\").classList.remove(\"$expand\");event.stopPropagation();'>
                                                <div class='x'>
                                                    <div class='line1'></div>
                                                    <div class='line2'></div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class='bottom'>
                                                <div class='row2'>

                                                        
                                <div style='text-align:center'>
                                        <img style='width:200px;height:200px' src='".$url."'>
                                </div>
                              

                                                        <div class='table-responsive'>
                                                                <table style='margin:5px auto; width: 85%; border-collapse: separate;border:hidden;' class='table tdstyle' border='1' >  
                                                                                 
                                    <tr>
                                        <td >Usuario</td>
                                        <td >".$row["usuario"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Contraseña</td>
                                        <td >".$row["password"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Nombre</td>
                                        <td >".$row["nombres"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Rol</td>
                                        <td >".$row["rol"]."</td>
                                    </tr>
                             
                                    <!--
                                    <tr>
                                        <td >ColorNav</td>
                                        <td >".$row["colorNav"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >ColorFondo</td>
                                        <td >".$row["colorFondo"]."</td>
                                    </tr>
                                    -->
                             
                                    <tr>
                                        <td >Celular</td>
                                        <td >".$row["celular"]."</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Habilitado</td>
                                        <td >".$row["habilitado"]."</td>
                                    </tr>
                            <tr>
                                <td >Fecha de caducidad</td>
                                <td >".formato_fechas_server($row["fechaCaduca"],'d/m/Y')."</td>
                            </tr>                                                                            
                                                                </table>  
                                                            </div> 
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    ";


                    $resultado.=' <tr style="cursor: default">
                                            <td>
                                                '.$otro.'
                                            </td>
                                            <td>' . $row['usuario'] . '</td><td>' . $row['nombres'] . '</td><td>' . $row['rol'] . '</td><td>' . $row['celular'] . ' <a href="https://wa.me/'.$row['celular'].'" target="_blank"><i class="fab fa-whatsapp fa-lg" style="color:green"></i> </a></td><td>' . $row['habilitado'] . '</td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_usuario" data-id="'.$row['idUsuario'].'"> <i class="fas fa-trash"></i></button>
                                                <button class="btn btn-primary" onclick="edit_usuario(\''.$row['idUsuario'].'\')"> <i class="fas fa-edit"></i></button>
                                            </td>
                                      </tr>
                            ';

                    }

                    $resultado.="
                                </table>
                            </div>
                            
                    ";
    
                    echo $resultado;          
            }

        ?>
