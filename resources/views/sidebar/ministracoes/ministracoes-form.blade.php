<style>
    .div {padding-top: 3%}
</style>
@section('siscell-form-group-up')
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label for="numeroMinistracao">Número da ministração</label>
            <input type="number" class="form-control" name="numeroMinistracao" id="numeroMinistracao" value="" required>
        </div>
        <div class="col-md-4 col-lg-4">
            <label for="usuarioMinistracao">Usuário: </label>
        <input type="text" class="form-control" name="usuarioMinistracao" id="usuarioMinistracao" value="{{ $usuarioLogado }}" readonly>
        </div>
    </div>
    <div class="row div">
        <div class="col-md-12 col-lg-12">
            <input type="hidden" name="idMinistracao" id="idMinistracao" value="">
            <label for="nome">Título</label>
            <input type="text" class="form-control" name="nome" id="nome" value="" placeholder="Título da ministração" required>
        </div>
    </div>
    <div class="row div">
        <div class="col-md-12 col-lg-12">
            <label for="ministracao">Descrição da Ministração</label>
            <textarea class="form-control" name="ministracao" id="ministracao" cols="20" rows="10" placeholder="Escreva a ministração aqui..." required></textarea>
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
        <div class="row downloadMinistracao">
            <div class="col-md-1 col-lg-1">
                <a class="btn btn-success" name="downloadMinistracao" id="downloadMinistracao">
                    <i class="fa fa-download"></i>
                </a>
            </div>
            <div class="col-md-1 col-lg-1">
                <button type="button" class="btn btn-danger" name="removeMinistracao" id="removeMinistracao" onclick="apagaArquivo()">
                    <i class="fa fa-trash"></i>
                </a>
            </div>                
        </div>
        <div class="row div fileInformations">
            <div class="col-md-8 col-lg-8">
                <ul class="list-group">
                    <li class="list-group-item" id="fileName"></li>
                    <li class="list-group-item" id="fileSize"></li>
                    <li class="list-group-item" id="fileType"></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
