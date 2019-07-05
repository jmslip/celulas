<style>
    tr {font-size: larger;}
    td {cursor: pointer;}
    </style>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="box box-success">
            <div class="box-header with-border">
                {{ $infosGrid['title'] }}
            </div>
            @include('helpers/modal')
            <div class="box-body siscell-list">
                <table id="siscell-list" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        @foreach ($infosGrid['headers'] as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($dados) > 0)
                            @yield('siscell-body')
                        @else
                            <tr>
                                <td colspan="3" style="text-align: center; text-transform: uppercase">Dados não disponíveis</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        @foreach($infosGrid['headers'] as $footer)
                            <th>{{ $footer }}</th>
                        @endforeach
                    </tr>
                    </tfoot>
                </table>
                <div class="right">
                    <button type="button" id="edit" class="btn btn-lg btn-default siscell-edit" onclick="editModal('{{ $infosGrid['fnEditar'] }}')">Novo</button>
                    <button type="button" id="delete" class="btn btn-lg btn-danger siscell-delete" disabled onclick="confirmaExlusao('{{ $infosGrid['url'] }}')">Apagar</button>
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
