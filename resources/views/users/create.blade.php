@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Usuarios</h1>
</div>
<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if (count($errors) > 0)
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error )
                <p> {{$error}} </p>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Fomulario de usuarios</h5>
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Rol</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="role" required>
                                    <option selected>Selecciones un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="seller">Vendedor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection