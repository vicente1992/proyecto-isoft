@extends('layouts.app')

@section('content')

<div class="pagetitle">
  <h1>Reporte de Ventas</h1>
</div>
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card top-selling">
      <div class="card-body pb-0">
        <h5 class="card-title text-center">Por favor seleccione una fecha inicial y una fecha final para generar el
          reporte</h5>

        <form class="mb-5 form-report" action="{{ route('reports.store') }}" method="POST">
          @csrf
          <div class="row justify-content-center">
            <div class="col-2">
              <label for="yourUsername" class="form-label">Fecha Inicial</label>
              <input type="date" name="startDate" class="form-control" required />
            </div>
            <div class="col-2">
              <label for="yourUsername" class="form-label">Fecha Final</label>
              <input type="date" name="endDate" class="form-control" required />
            </div>
            <div class="col-2">
              <div class="wrapper-button" style="margin-top: 30px">
                <button type="submit" class="btn btn-secondary">
                  Buscar
                </button>
              </div>
            </div>
          </div>
        </form>
        <input type="hidden" name="dataGraph" id="dataGraph" value="{{json_encode($data)}}">
        @if (count($data)>0)
        <h5 class="card-title text-center">Reporte De ventas por fecha</h5>
        <div id="reportsChart"></div>
        @endif
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
  const dataGraph = JSON.parse(document.getElementById('dataGraph').value);
  new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
        name: 'Ingresos',
        data: dataGraph.dataSales,
        // data: [31, 40, 28, 51, 42, 82, 56],
        }, {
        name: 'Egresos',
        data: dataGraph.dataBills,
        // data: [11, 32, 45, 32, 34, 52, 41]
        }],
        chart: {
        height: 350,
        type: 'area',
        toolbar: {
        show: false
        },
        },
        markers: {
        size: 4
        },
        colors: ['#2eca6a', '#ff771d'],
        fill: {
        type: "gradient",
        gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.3,
        opacityTo: 0.4,
        stops: [0, 90, 100]
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'smooth',
        width: 2
        },
        xaxis: {
        type: 'datetime',
        categories: dataGraph.dataDaysLabels
        //
        },
        tooltip: {
        x: {
        format: 'dd/MM/yy HH:mm'
        },
        }
  }).render();
  });
</script>
@endsection