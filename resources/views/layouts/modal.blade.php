<div class="modal fade" id="form-celula-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="form-celula-modal-title"></h4>
            </div>
            <div class="modal-body" id="celula-modal-content">
                <div class="box-body form-celula">
                    <form role="form" id="form-celula" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                @yield('siscell-form-group-up')
                            </div>
                            @if ($isModalCEP)
                                <!-- /*Carrega parte do formulário de cep*/ -->
                                @include('helpers/form-cep')                                
                            @endif
                            @yield('siscell-form-group-down')
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="btnSubmit" class="btn btn-success">Salvar</button>
                            <button type="button" id="btnLimpar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
