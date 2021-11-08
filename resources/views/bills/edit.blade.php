@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Egresos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Productos</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if (count($errors) > 0)
            <div class="card mt-5">
                <div class="card-body">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error )
                        <p> {{$error}} </p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Fomulario de egresos</h5>
                    <form action="{{ route('bills.update', $bill->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$bill->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Precio</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="price" value="{{$bill->price}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="quantity" value="{{$bill->quantity}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height: 100px" name="description">{{$bill->description}}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

</section>

@endsection