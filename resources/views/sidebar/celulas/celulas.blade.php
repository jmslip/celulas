@extends('adminlte::page')

@section('content_header')
    <h1>Células Cadastradas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    Lista de Células
                </div>
                <div class="box-body">
                    <table id="lista-celulas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ação</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Líder</th>
                                </tr>
                            </thead>
                            <tbody>
                              @include('/sidebar/celulas/celulas-grid')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Ação</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Líder</th>
                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    Lista de Células
                </div>
                <div class="box-body">
                  <form role="form">
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
                                            <option value="1">Jorge</option>
                                            <option value="2">Fabiano</option>
                                            <option value="1">Gilbert</option>
                                            <option value="1">Marcilene</option>
                                        </select>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <button type="submit" class="btn btn-success">Salvar</button>
                          <button type="reset" class="btn btn-danger">Limpar</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@stop
