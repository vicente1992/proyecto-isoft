@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Usuarios</h1>
</div>
<section class="section dashboard">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="filter">
                            {{-- <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i></button> --}}
                            <a href="{{ route('user.create') }}" class="btn btn-secondary me-2">
                                Nuevo Usuaurio
                            </a>

                        </div>
                        <div class="card-body pb-0">
                            <h5 class="card-title">Listado de usuarios</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user )
                                    @if (Auth::user()->id !== $user->id )
                                    <tr>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->role}} </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-secondary btn-sm mx-2"
                                                    href=" {{ route('user.edit', $user->id) }}"><i
                                                        class="fas fa-pen"></i></a>

                                                <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="justify-content-center mt-3">
                                <span>
                                    {{$users->links()}}
                            </span>
                        </div> --}}
                    </div>

                </div>
            </div><!-- End Top Selling -->

        </div>
    </div><!-- End Left side columns -->


    </div>
</section>
@endsection