@extends('layout.app')

@section('title', 'Detalhes do Usuário')

@section('contents')

@if(Session::has('success'))
  <div class="alert alert-success" role="alert">
      {{ Session::get('success') }} 
  </div>
@endif

<div class="col-md-12 border-right">
  <div class="p-3 py-5">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row mt-2">
        <div class="col-md-6">
          <label class="labels">Nome</label>
          <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="col-md-6">
          <label class="labels">E-mail</label>
          <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6">
          <label class="labels">Cargo</label>
          <input type="text" name="role" class="form-control" value="{{ $user->role }}">
        </div>
        <div class="col-md-6">
          <label class="labels">Permissão</label>
          <select id="permission" name="permission" class="form-control form-select" aria-label="Default select example">
              <option value="common" <?= $user->permission == 'common' ? 'selected' : '' ?>> Comum </option>
              <option value="admin" <?= $user->permission == 'Admin' ? 'selected' : '' ?>> Administrador </option>
          </select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6">
          <label class="labels">Cadastro</label>
          <input type="text" name="created_at" class="form-control" value="{{ date('d/m/Y', strtotime($user->created_at)) }}" disabled>
        </div>
        <div class="col-md-6">
          <label class="labels">Última Atualização</label>
          <input type="text" name="updated_at" class="form-control" value="{{ date('d/m/Y', strtotime($user->updated_at)) }}" disabled>
        </div>
      </div>
      <div class="mt-5 text-right">
        <button type="button" id="btn" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Excluir</button>
        <button type="submit" id="btn" class="btn btn-primary">Atualizar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exclusão de Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          Confirma a exclusão do usuário: {{ $user->name }}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar</button>
        </div>
      <form>
    </div>
  </div>
</div>


@endsection