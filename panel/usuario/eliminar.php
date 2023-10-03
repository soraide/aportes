        <?php
                                    include("../../connections/conexion.php");
                                    $id=intval($_POST["id"]);
                                    $sql="DELETE FROM tblUsuario WHERE idUsuario=".$id.";";        
                                    $query_delete = sqlsrv_query($con,$sql);
                                    if ($query_delete){

                                            
                    if(file_exists('../../images/admins/' . $id . ".jpg")){
                        unlink('../../images/admins/'.$id.".jpg");
                        if(!file_exists('../../images/admins/'.$id.".jpg")){
                                echo 1;
                        }else{
                                echo 2;
                        } 
                    }else{
                        echo 1;
                    } 
                    
                                            
                                    } else{
                                            echo 2;
                                    }
                            ?>
                            