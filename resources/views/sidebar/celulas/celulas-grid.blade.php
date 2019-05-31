@foreach ($celulas as $celula)
    <tr>
        <td>Editar | Excluir</td>
        <td>{{ $celula->name }}</td>
        <td>{{ $celula->endereco->street }}, {{ $celula->endereco->number }} -
                    {{ $celula->endereco->neiborhood }}, {{ $celula->endereco->city }}, {{ $celula->endereco->state }}</td>
        <td>
          @foreach ($celula->pessoas as $key => $lider)
            @if ($key < count($celula->pessoas)-1)
              {{ $lider->name }},
              @else
                {{ $lider->name }}
            @endif
          @endforeach
        </td>
    </tr>
@endforeach
