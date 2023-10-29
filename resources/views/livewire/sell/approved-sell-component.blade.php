<div>  

    @section('title','SERP | Approved Sells')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Approved Sells</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Approved Sells</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            {{-- Content Here----
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif --}}

            <!-- Main content -->
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <h3 class="card-title">Sell To Approve</h3>
                            </div>
                            <div class="col-6">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                @if(Session::has('delete_message'))
                                    <div class="alert alert-danger" role="alert">{{ Session::get('delete_message') }}</div>
                                @endif
                            </div>

                            <div class="col-2">
                                
                            </div>

                            <div class="col-2">
                                {{-- <a class="btn btn-success float-right text-white" href="{{ route('add_customers') }}">Add New Customer</a> --}}
                            </div>
                        </div>             
                    </div>
                    <br>
                    <div class="col-12">

                        <div class="row">

                            <label for="paginate" class="ml-3" style="margin-top: auto;">Show</label>
                            <div class="col-sm-2">
                                <select id="paginate" name="paginate" class="form-control input-sm" wire:model="paginate">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>  
                            <div class="col-sm-6"></div>
                            <div class="col-sm-3 float-right">
                                <input type="search" wire:model="search" class="form-control input-sm" placeholder="Search">
                            </div>
                        </div>
                        <br>
                        <table id="datatable-makesales" class="table table-bordered table-striped nowrap data-table-makesales table-head-fixed" style="overflow-wrap: anywhere;" width="100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th wire:click="sortBy('id')">S/N</th>
                                    <th>Bill No</th>
                                    <th>Customer</th>
                                    <th>Invoice By</th>
                                    <th>Checked By</th>
                                    <th>Approved By</th>
                                    <th>Subtotal</th>
                                    <th>Discount %</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($approved_sells as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->bill_no }}</td>
                                        <td>{{ $value->customer->firm_name }}</td>
                                        <td>{{ $value->invoiceBy->name }}</td>
                                        <td>{{ $value->checkedBy->name }}</td>
                                        <td>{{ $value->ApprovedBy->name }}</td>
                                        <td>{{ $value->sub_total }}</td>
                                        <td>{{ $value->discount_percent }}</td>
                                        <td>{{ $value->grand_total }}</td>
                                        <td>{{ $value->created_at }}</td>

                                        <td>

                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a href="{{ route('invoice',['bill_no'=>$value->bill_no]) }}" class="dropdown-item btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> Print Bill</a>

                                                    <a href="{{ route('challan',['bill_no'=>$value->bill_no]) }}" class="dropdown-item btn btn-success btn-sm" target="_blank"><i class="fas fa-print"></i> Print Challan</a>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $approved_sells->links() }}
                    </div>
                </div>
            </div>
            <!-- Main content end-->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>