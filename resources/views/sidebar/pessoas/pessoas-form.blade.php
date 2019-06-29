<style>
    .div {padding-top: 3%}
</style>
@section('siscell-form-group-up')
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <input type="hidden" name="idMembro" id="idMembro" value="">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="" placeholder="Insira um nome" required>
        </div>
        <div class="col-md-6 col-lg-6">
            <label for="sobrenome">Sobrenome</label>
            <input type="text" class="form-control" id="sobrenome" value="" placeholder="Insira um sobrenome" required>
        </div>
    </div>
    <div class="row div">
        <div class="col-md-6 col-lg-6">
            <label for="dtnascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="dtnascimento" value="">
        </div>
        <div class="col-md-6 col-lg-6">
            <label for="celula">Célula</label>
            <select class="form-control select2" data-placeholder="Selecione a célula" id="select-celula" style="width: 100%;">
                <option value="0" selected="true">Selecione...</option>
                @foreach($celulas as $celula)
                    <option value="{{ $celula->id }}">{{ $celula->description }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row div">
        <div class="col-md-6 col-lg-6">
            <label for="telefone">Telefone fixo:</label>
            <input type="text" class="form-control" name="telefone" id="telefone" value="" placeholder="(XX)XXXX-XXXX">
        </div>
        <div class="col-md-6 col-lg-6">
            <label for="celular">Celular:</label>
            <input type="text" class="form-control" name="celular" id="celular" value="" placeholder="(XX)XXXXX-XXXX">
        </div>
    </div>
    <div class="row div">
        <div class="col-md-12 col-lg-12">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Insira o e-mail">
        </div>
    </div>
@endsection
@section('siscell-form-group-down')
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label for="lider">Líder?</label>
                <input type="checkbox" name="lider" id="lider">
            </div>
        </div>
    </div>
@endsection
