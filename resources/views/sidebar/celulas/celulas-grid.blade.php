<style>
    tr {font-size: larger;}
</style>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="box box-success">
            <div class="box-header with-border">
                {{ $tituloCelulasGrid }}
            </div>
            @include('helpers/modal')
            <div class="box-body lista-celulas">
                <table id="lista-celulas" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Endereço</th>
                                <th>Líder</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($celulas as $celula)
                              <tr>
                                  <input type="hidden" name="id" value="{{ $celula->id  }}">
                                  <td>{{ $celula->name }}</td>
                                  <td>{{ $celula->street }}, {{ $celula->number }} -
                                              {{ $celula->neiborhood }}, {{ $celula->city }}, {{ $celula->state }}</td>
                                  <td>
                                    @foreach ($celula->pessoas as $key => $lider)
                                      @if ($key < count($celula->pessoas)-1)
                                        {{ $lider->name }} {{ $lider->lastname }},
                                        @else
                                          {{ $lider->name }} {{ $lider->lastname }}
                                      @endif
                                    @endforeach
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Endereço</th>
                                <th>Líder</th>
                            </tr>
                        </tfoot>
                </table>
                <div class="right">
                    <button type="button" id="edit" class="btn btn-lg btn-default edit-celula" disabled onclick="editarCelula()">Editar</button>
                    <button type="button" id="delete" class="btn btn-lg btn-danger delete-celula" disabled onclick="confirmaExlusao()">Apagar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
  <script type="text/javascript">
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});
  </script>
@endsection
