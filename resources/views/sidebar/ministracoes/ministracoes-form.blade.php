<style>
    .div {padding-top: 3%}
</style>
@section('siscell-form-group-up')
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label for="numeroMinistracao">Número da ministração</label>
            <input type="number" class="form-control" name="numeroMinistracao" id="numeroMinistracao" value="">
        </div>
    </div>
    <div class="row div">
        <div class="col-md-12 col-lg-12">
            <input type="hidden" name="idMinstracao" id="idMinistracao" value="">
            <label for="nome">Título</label>
            <input type="text" class="form-control" name="nome" id="nome" value="" placeholder="Título da ministração">
        </div>
    </div>
    <div class="row div">
        <div class="col-md-12 col-lg-12">
            <label for="ministracao">Descrição da Ministração</label>
            <textarea class="form-control" name="ministracao" id="ministracao" cols="20" rows="10" placeholder="Escreva a ministração aqui..."></textarea>
        </div>
    </div>
@endsection
@section('siscell-form-group-down')
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label for="anexar">Anexar arquivo?</label>
                <input type="checkbox" name="anexar" id="anexar">
            </div>
        </div>
        <div class="row file">
            <div class="col-md-12 col-lg-12">
                <input type="file" name="fministracao" id="fministracao">
            </div>
        </div>
    </div>
@endsection