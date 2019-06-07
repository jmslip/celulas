<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="box box-success">
            <div class="box-header with-border" id="title-form">
                {{ $tituloCelulasForm }}
            </div>
            @include('helpers/modal')
            <div class="box-body">
              <form role="form" id="form-celula">
                    <div class="box-body">
                          <div class="form-group">
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
                      <button type="reset" id="btnLimpar" value="limpar" class="btn btn-danger">Limpar</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>
