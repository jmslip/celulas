<div class="modal fade" id="form-celula-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="celula-modal-title">{{ $tituloCelulasForm }}</h4>
            </div>
            <div class="modal-body" id="celula-modal-content">
                <div class="box-body form-celula">
                    <form role="form" id="form-celula">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="idCelula" id="idCelula" value="">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" placeholder="Insira um nome" value="" required>
                            </div>
                            <!-- /*Carrega parte do formulário de cep*/ -->
                            @include('helpers/form-cep')
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Líderes</label>
                                        <select class="form-control select2" multiple="multiple" data-placeholder="Selecione os líderes da célula" id="select-lider-celula" style="width: 100%;">
                                            @foreach ($lideres as $lider)
                                                <option value="{{ $lider->id }}">{{ $lider->name }} {{ $lider->lastname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="btnSubmit" class="btn btn-success">Salvar</button>
                            <button type="button" id="btnLimpar" value="limpar" data-dismiss="modal" class="btn btn-danger">Limpar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
