@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Ventas</h1>
</div>
{{-- <section class="section dashboard">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card top-selling">
        <div class="card-body pb-0">
          <h5 class="card-title">Ventas realizadas </h5>
          <table class="table table-borderless">
            <thead>
              <tr>
                <th scope="col">Cliente</th>
                <th scope="col">identificación</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Monto toal</th>
                <th scope="col">Fecha</th>
                <th scope="col">Detalle</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sales as $sale )
              <tr>
                <td> {{$sale->customer}} </td>
                <td> {{$sale->id_customer}} </td>
                <td> {{$sale->sellerName}} </td>
                <td> {{"$ " . number_format($sale->amount, 0, ",", ".") }} </td>
                <td> {{$sale->created_at}} </td>
                <td>

                  <a href="#openModal{{$sale->id}}" class="btn btn-success btn-xs" id="btnPay">
                    <i class="fas fa-eye"></i></a>
                </td>
              </tr>
              @include('sales.modal')
              @endforeach
            </tbody>
          </table>
          <div class="justify-content-center mt-3">
            <span>
              {{$sales->links()}}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}

<section class="section" id="app">
  <viewsales-component></viewsales-component>
</section>

<script src="{{asset('js/app.js')}}"></script>

@endsection