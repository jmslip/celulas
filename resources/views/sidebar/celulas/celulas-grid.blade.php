@foreach ($celulas as $celula)
    <tr>
        <td>Editar | Excluir</td>
        <td>{{ $celula->name }}</td>
        <td>{{ $celula->endereco->street }}, {{ $celula->endereco->number }} -
                    {{ $celula->endereco->neiborhood }}, {{ $celula->endereco->city }}, {{ $celula->endereco->state }}</td>
        <td>Jorge, Wesley</td>
    </tr>
@endforeach
