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
                                    <button type="button" id="delete" class="btn btn-danger delete-celula" value="{{$celula->id}}"><i class="fa fa-trash"></i></button>
                                  </td>
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
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});
  </script>
@endsection
