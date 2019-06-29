<style>
    .bg-green-celula {background: #008283; color: #E9EDF2}
</style>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green-celula">
            <div class="inner">
                <h3>{{ $qtCelulas }}</h3>

                <p>Células</p>
            </div>
            <div class="icon">
                <i class="fa fa-home"></i>
            </div>
            <a href="/siscell/celulas" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $qtMembros }}</h3>

                <p>Membros</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="/siscell/membros" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="qtMinistracoes">0</h3>

                <p>Ministrações</p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
            <a href="#" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="qtRelatorios">0</h3>

                <p>Relatório</p>
            </div>
            <div class="icon">
                <i class="fa fa-files-o"></i>
            </div>
            <a href="#" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
