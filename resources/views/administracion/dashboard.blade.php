@extends('layouts.layouts-dash.master-layout')

@section('styles')
    
@endsection

@section('content')
        <div class="row">
            <div class="col-md-3" >
                <div class="card text-white bg-primary mb-2"  >
                    <div class="card-body text-center p-0 pt-1"> 
                        <h2>100</h2>
                      <span>Total de solicitudes</span>
                    </div>
                  </div>
            </div>
            <div class="col-md-3" >
                <div class="card text-white bg-warning mb-2"  >
                    <div class="card-body text-center p-0 pt-1"> 
                        <h2>30</h2>
                      <span >Solicitudes pendientes</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="card text-white bg-success mb-2"  >
                    <div class="card-body text-center p-0 pt-1"> 
                        <h2>$1,500</h2>
                      <span>Pagos recolectados</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="card text-white bg-danger mb-2"  >
                    <div class="card-body text-center p-0 pt-1"> 
                        <h2>$1,500</h2>
                      <span>Pagos pendientes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 "><hr></div>
            <div class="col-md-6 mb-3"><canvas id="horizontalBar"></canvas></div>
            <div class="col-md-6 mb-3"><canvas id="labelChart"></canvas></div>
            <div class="col-md-12 "><hr></div>

            <div class="col-md-6 mb-3"><canvas id="doughnutChart"></canvas></div>
            <div class="col-md-6 mb-3"><canvas id="barChart"></canvas></div>
           
        </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/graficos/barrahorizontal.js') }}"></script>
    <script src="{{ asset('js/graficos/barra.js') }}"></script>
    <script src="{{ asset('js/graficos/pastel.js') }}"></script>
    <script src="{{ asset('js/graficos/dona.js') }}"></script>
@endsection