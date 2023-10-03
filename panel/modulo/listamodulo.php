<?php

include("../../connections/conexion.php");

$start_from = $_POST['start'];
$search_in_sql = "";
if (isset($_POST['texto']) && !empty($_POST['texto'])) {
  $texto = $_POST['texto'];
  $search_in_sql .= " WHERE (modulo like '%" . $texto . "%'  OR curso like '%" . $texto . "%' ) ";
}

// if(strlen(trim($search_in_sql)) == 0){
//     $search_in_sql .= " WHERE ".tblModulo. = .
// }else{
//     $search_in_sql .= " AND ".tblModulo. = .
// }

$sql = " SELECT * FROM tblModulo 
                JOIN tblCurso
                ON tblModulo.idCurso = tblCurso.idCurso
                $search_in_sql ORDER BY idModulo DESC offset $start_from ROWS FETCH NEXT 10 ROWS ONLY;";
$query = sqlsrv_query($con, $sql);
$count_row = sqlsrv_has_rows($query);
if ($count_row === false) {
  echo "<div style='text-align:center'><h2>Lista de Modulos vacia!</h2></div>";
} else {

  $resultado = '
                    <div class="table-responsive">
                        <table style="text-align:center" class="table table-hover">
                            <tr>
                                <th>
                                    Módulo-Información      
                                </th>
                                
                                    <th>
                                        Curso
                                    </th>
                                
                                <th>
                                    Opciones
                                </th>
                            </tr>
                            ';

  $t = time();
  while ($row = sqlsrv_fetch_array($query)) {

    $id = $row['idModulo'];
    $expand = "expand";
    $sector = "sector" . $id;
    $url = "";
    $otro = "    
                                    <div id='sector" . $id . "' class='email' onclick='this.classList.add(\"$expand\")'>
                                        <div class='from'>
                                            <div class='from-contents'>
                                            <div class='avatar me' style='background-image: url($url)'></div>
                                            <div class='name'>" . $row['modulo'] . "</div>
                                            </div>
                                        </div>
                                        <div class='to'>
                                            <div class='to-contents'>
                                            <div class='top'>
                                                <div class='avatar-large me' style='background-image: url()'></div>
                                                <div class='name-large'>" . $row['modulo'] . "</div>
                                                <div class='x-touch' onclick='document.getElementById(\"$sector\").classList.remove(\"$expand\");event.stopPropagation();'>
                                                <div class='x'>
                                                    <div class='line1'></div>
                                                    <div class='line2'></div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class='bottom'>
                                                <div class='row2'>

                                                        

                                                        <div class='table-responsive'>
                                                                <table style='margin:5px auto; width: 85%; border-collapse: separate;border:hidden;' class='table tdstyle' border='1' >  
                                                                                 
                                    <tr>
                                        <td >Módulo</td>
                                        <td >" . $row["modulo"] . "</td>
                                    </tr>
                             
                                    <tr>
                                        <td >Curso</td>
                                        <td >" . $row["curso"] . "</td>
                                    </tr>
                                                                                                        
                                                                </table>  
                                                            </div> 
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    ";


    $resultado .= ' <tr style="cursor: default">
                                            <td>
                                                ' . $otro . '
                                            </td>
                                            <td>' . $row['curso'] . '</td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_modulo" data-id="' . $row['idModulo'] . '"> <i class="fas fa-trash"></i></button>
                                                <button class="btn btn-primary" onclick="edit_modulo(\'' . $row['idModulo'] . '\')"> <i class="fas fa-edit"></i></button>
                                            </td>
                                      </tr>
                            ';

  }

  $resultado .= "
                                </table>
                            </div>
                            
                    ";

  echo $resultado;
}

?>