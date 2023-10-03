        
                            <div class="modal fade" id="modal_eliminar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                        <h2 class="text-center text-muted">Eliminar</h2>
                                        <p class="lead text-muted text-center" style="display: block;margin:10px">¿Está seguro?</p>
                                        <input type="hidden" id="id_usuario">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-lg btn-primary" data-dismiss="modal" onclick="borrar_usuario($('#id_usuario').val())">Aceptar</button>
                                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                            