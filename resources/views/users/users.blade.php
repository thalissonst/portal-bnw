@extends('layout.app')

@section('title', 'Gerenciamento de Usuários')

@section('contents')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gerenciamento de Usuários</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus fa-sm text-white-50"></i> Cadastrar Usuário</button>
</div>

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }} 
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">          
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>E-mail</th>
                        <th>Permissão</th>
                        <th>Criação</th>
                        <th>Atualização</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0) 
                        @foreach ($users as $i)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $i->name }}</td>
                            <td class="align-middle">{{ $i->role }}</td>
                            <td class="align-middle">{{ $i->email }}</td>
                            <td class="align-middle">{{ $i->permission }}</td>
                            <td class="align-middle">{{ date( 'd/m/Y H:m:s' , strtotime($i->created_at))}}</td>
                            <td class="align-middle">{{ date( 'd/m/Y H:m:s' , strtotime($i->updated_at))}}</td>
                            <td class="align-middle">
                                <a href="{{ route('users.show', $i->id) }}" type="button" class="btn btn-outline-primary btn-sm" title="Detalhes do Usuário" ><i class="fas fa-fw fa-user"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="5">Nenhum usuário cadastrado no portal.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal de Cadastrar um Novo Usuário -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar um Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="role" class="labels">Função</label>
                            <input type="text" id="role" name="role" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Permissão</label>
                            <select class="form-control" id="permission" name="permission">
                                <option value="" disabled selected></option>
                                <option value="common">Comum</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection