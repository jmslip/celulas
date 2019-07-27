@section('siscell-body')
    @foreach($dados as $membro)
        <tr>
            <input type="hidden" name="id" value="{{ $membro->id }}">
            <td id="{{ $membro->id }}">{{ $membro->name }}</td>
            <td>{{ $membro->lastname }}</td>
            <td>{{ $membro->street }}, {{ $membro->number }} - {{ $membro->neiborhood }}, {{ $membro->city }}, {{ $membro->state }}</td>
            <td>{{ date('d/m/Y', strtotime($membro->birthday)) }}</td>
            @if (count($membro->celulas) > 0)
                @foreach($membro->celulas as $celula)
                    <td>{{ $celula->description }}</td>
                @endforeach
            @else
                <td>N/A</td>
            @endif
        </tr>
    @endforeach
@endsection
@section('siscell-btn-grid')
    @include('layouts/btn-grid-default')
@endsection
