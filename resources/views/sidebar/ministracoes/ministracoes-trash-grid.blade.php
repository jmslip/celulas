@section('siscell-body')
    @foreach ($dados as $ministracao)
        <tr>
            <input type="hidden" name="id" value="{{ $ministracao->id }}">
            <td id="{{ $ministracao->id }}">{{ $ministracao->number }}</td>
            <td>{{ $ministracao->name }}</td>
            <td>{{ $ministracao->description }}</td>
            <td>
                @if ($ministracao->attachment == 1)
                    <i class="fa fa-check"></i>
                @endif
            </td>
        </tr>
    @endforeach
@endsection
@section('siscell-btn-grid')
    <button type="button" id="restaurar" class="btn btn-lg btn-default siscell-ministracao" disabled onclick="confirmaRestauracao('{{ $ministracao->number }}')">Restaurar</button>
    <button type="button" id="delete" class="btn btn-lg btn-danger siscell-delete" disabled onclick="confirmaExlusao('{{ $infosGrid['url'] }}')">Apagar</button>
@endsection