@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Productos</h1>
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
                            <a href="{{ route('product.create') }}" class="btn btn-secondary me-2">
                                Nuevo Producto
                            </a>
                        </div>
                        <div class="card-body pb-0">
                            <h5 class="card-title">Productos disponibles <span>| Hoy</span></h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product )
                                    <tr>
                                        <th scope="row">
                                            <img src="{{Storage::url($product->image)}}" alt="" width="80">
                                        </th>
                                        <td> {{$product->name}} </td>
                                        <td> {{$product->description}} </td>
                                        <td> {{"$ " . number_format($product->price, 0, ",", ".") }} </td>
                                        <td> {{$product->quantity}} </td>
                                        <td>
                                            @if ($product->quantity > 0)
                                            <span class="badge bg-success">Disponible</span>
                                            @else
                                            <span class="badge bg-danger">Agotado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-secondary btn-sm mx-2"
                                                    href=" {{ route('product.edit', $product->id) }}"><i
                                                        class="fas fa-pen"></i></a>
                                                @if (Auth::user()->role ==='admin')
                                                <form action="{{route('product.destroy',$product->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <div class="justify-content-center mt-3">
                                <span>
                                    {{$products->links()}}
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