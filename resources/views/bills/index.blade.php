@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Egresos</h1>
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
                            <a href="{{ route('bills.create') }}" class="btn btn-secondary me-2">
                                Nuevo Egreso
                            </a>
                        </div>
                        <div class="card-body pb-0">
                            <h5 class="card-title">Listado de egresos</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Monto total</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill )
                                    <tr>
                                        <td> {{$bill->name}} </td>
                                        <td> {{$bill->description}} </td>
                                        <td> {{$bill->created_at}} </td>
                                        <td> {{$bill->quantity}} </td>
                                        <td> {{"$ " . number_format($bill->price, 0, ",", ".")  }}</td>
                                        <td>
                                            {{"$ " . number_format($bill->total_amount, 0, ",", ".")  }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-secondary btn-sm mx-2"
                                                    href=" {{ route('bills.edit', $bill->id) }}"><i
                                                        class="fas fa-pen"></i></a>

                                                <form action="{{route('bills.destroy',$bill->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <div class="justify-content-center mt-3">
                                <span>
                                    {{$bills->links()}}
                                </span>
                            </div>
                        </div>

                    </div>
                </div><!-- End Top Selling -->

            </div>
        </div><!-- End Left side columns -->


    </div>
</section>
@endsection