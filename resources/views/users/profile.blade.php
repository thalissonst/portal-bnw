@extends('layout.app')

@section('title', 'Perfil de Usuário')
@section('page_title', 'Perfil de Usuário')

@section('contents')

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }} 
    </div>
@endif

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Detalhes</a>
        <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false">Trocar Senha</a>
    </div>
</nav>

<div class="col-md-12 border-right">
    <div class="p-3 py-5">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                <form method="POST" id="profile_setup_frm" action="{{ route('update.profile') }}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">E-mail</label>
                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Cargo</label>
                            <input type="text" name="role" class="form-control" value="{{ auth()->user()->role }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Cadastro</label>
                            <input type="text" name="created_at" class="form-control" value="{{ date('d/m/Y H:m:s', strtotime(auth()->user()->created_at)) }}" disabled>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Alterar</button></div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                <form action="{{ route('change.password') }}" method="POST" name="formAlterarSenha">
                    @csrf
                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Senha Atual</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nova Senha</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repita a nova senha</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection