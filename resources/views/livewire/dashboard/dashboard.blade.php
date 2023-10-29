@extends('livewire.base.base_extends')

@section('content')

@section('title','SERP | Dashboard')
	 
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Product Stock</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> --}}
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="product_stock" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Product Fast To Slow Moving</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> --}}
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="fast_to_slow" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="card card-olive">
                      <div class="card-header">
                        <h3 class="card-title">Product Fast To Slow Moving With Profit</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> --}}
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="fast_to_slow_with_profit" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Customer By Profit</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> --}}
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="customer_by_profit" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="card card-dark">
                      <div class="card-header">
                        <h3 class="card-title">Customer By Balance Outstanding</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button> --}}
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="customer_by_balance" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    @push('scripts')

        @include('livewire.dashboard.dashboard_js')

    @endpush

@endsection