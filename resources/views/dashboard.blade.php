@extends('layout.app')
  
@section('title', 'Dashboard')
@section('page_title', 'Seja bem vindo ao Portal BNW!')
  
@section('contents')

    @if (auth()->user()->permission == 'admin')
    <div class="row"> 
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Usuários</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('users') }}"><i class="fas fa-users fa-2x text-gray-300"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection


