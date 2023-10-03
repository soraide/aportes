        <?php  
                                
                                include("../../connections/conexion.php");
                                $id= $_POST["idUsuario"];  
                                
                                 $usuario= $_POST["usuario"];  $password= $_POST["password"];  $nombres= $_POST["nombres"];  $rol= $_POST["rol"];  $colorNav= $_POST["colorNav"];  $colorFondo= $_POST["colorFondo"];  $celular= $_POST["celular"];  $habilitado= $_POST["habilitado"];  $fechaCaduca= $_POST["fechaCaduca"];  $update=" UPDATE tblUsuario set  usuario = '$usuario' , password = '$password' , nombres = '$nombres' , rol = '$rol' , colorNav = '$colorNav' , colorFondo = '$colorFondo' , celular = '$celular' , habilitado = '$habilitado' , fechaCaduca = '$fechaCaduca'  WHERE idUsuario=$id; " ; 
                                
                                    $sql_rep="SELECT * FROM tblUsuario WHERE (usuario='$usuario' AND nombres='$nombres') AND idUsuario<> $id";
                                    $query_rep=sqlsrv_query($con,$sql_rep);
                                    $count_rep=sqlsrv_has_rows($query_rep);
                                    if($count_rep === false){
                            
                                    $query=sqlsrv_query($con,$update);
                                    if($query){ 
                                        
                                        
                    if(isset($_POST['idbase1']) && !empty($_POST['idbase1'])){
                        $imagen = $_POST['idbase1'];
                        $base_to_php = explode(',', $imagen);
                        $data = base64_decode($base_to_php[1]);
                        $filepath = "../../images/admins/".$id.".jpg";
                        file_put_contents($filepath, $data);
                    }
                     

                                        echo 1;
                                    }else{
                                        echo 2;
                                    }
                                 
                                        }else{
                                            echo 7;
                                        }

                            ?>