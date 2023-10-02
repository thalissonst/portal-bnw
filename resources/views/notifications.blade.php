@extends('layout.app')
  
@section('title', 'Notificações')
  
@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Todas as Notificações</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">          
            <table class="table">
                <thead>
                    <tr role="row">
                        <th>Data</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($notifications->count() > 0) 
                        @foreach ($notifications as $i)
                        <tr>
                            <td class="align-middle">{{ date( 'd/m/Y H:m:s' , strtotime($i->created_at)) }}</td>
                            <td class="align-middle">{{ $i->message }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="5">Nenhuma notificação existente.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


