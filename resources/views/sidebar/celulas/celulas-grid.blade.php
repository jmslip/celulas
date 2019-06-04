<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="box box-success">
            <div class="box-header with-border">
                {{ $tituloCelulasGrid }}
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
                          @foreach ($celulas as $celula)
                              <tr>
                                  <td>
                                    <button type="button" id="edit" class="btn btn-default" onclick="editarCelula('{{$celula->id}}')"><i class="fa fa-edit"></i></button>
                                    <button type="button" id="delete" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                                  </td>
                                  <td>{{ $celula->name }}</td>
                                  <td>{{ $celula->endereco->street }}, {{ $celula->endereco->number }} -
                                              {{ $celula->endereco->neiborhood }}, {{ $celula->endereco->city }}, {{ $celula->endereco->state }}</td>
                                  <td>
                                    @foreach ($celula->pessoas as $key => $lider)
                                      @if ($key < count($celula->pessoas)-1)
                                        {{ $lider->name }},
                                        @else
                                          {{ $lider->name }}
                                      @endif
                                    @endforeach
                                  </td>
                              </tr>
                          @endforeach
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

@section('js')
  <script type="text/javascript">
    function editarCelula(id) {
      $.getJSON('/api/celulas/'+id, function (data) {
        if (data !== null || data !== undefined) {
          $('#title-form').text('Editar Célula');
          $('#btnLimpar').val('cancelar');
          $('#btnLimpar').text('Cancelar');

          $('#nome').val(data.description);
          $('#cep').val(data.cep);
          $('#rua').val(data.street);
          $('#bairro').val(data.neiborhood);
          $('#numero').val(data.number);
          $('#cidade').val(data.city);
          $('#estado').val(data.state);

          const arr_lideres = [];
          for (let i = 0; i < data.quantidadeLideres; i++) {
            arr_lideres.push(data['pessoa-'+i]);
          }
          $('#select-lider-celula').val(arr_lideres).trigger('change');
        } else {
          console.log('Erro ao tentar encontrar dados');
        }

      });
    }

    $('#btnLimpar').click(function() {
      let btnValue = $(this).val();
      if (btnValue === 'cancelar') {
        $(this).val('limpar');
        $(this).text('Limpar');
        $('#title-form').text('Nova Célula');
        $('#select-lider-celula').val('').trigger('change');
      }
    });
  </script>
@endsection
