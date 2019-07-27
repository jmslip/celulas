@section('siscell-body')
      @foreach ($dados as $celula)
          <tr>
              <input type="hidden" name="id" value="{{ $celula->id  }}">
              <td id="{{ $celula->id }}">{{ $celula->name }}</td>
              <td>{{ $celula->street }}, {{ $celula->number }} -
                          {{ $celula->neiborhood }}, {{ $celula->city }}, {{ $celula->state }}</td>
              <td>
                @foreach ($celula->pessoas as $key => $lider)
                  @if ($key < count($celula->pessoas)-1)
                    {{ $lider->name }} {{ $lider->lastname }},
                    @else
                      {{ $lider->name }} {{ $lider->lastname }}
                  @endif
                @endforeach
              </td>
          </tr>
      @endforeach
@endsection
@section('siscell-btn-grid')
    @include('layouts/btn-grid-default')
@endsection
