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
                        @yield('siscell-body')
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
                    @yield('siscell-btn-grid')
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
