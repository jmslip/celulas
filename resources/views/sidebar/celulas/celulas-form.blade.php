@section('siscell-form-group-up')
    <input type="hidden" name="idCelula" id="idCelula" value="">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" placeholder="Insira um nome" value="" required>
@endsection
@section('siscell-form-group-down')
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
@endsection
