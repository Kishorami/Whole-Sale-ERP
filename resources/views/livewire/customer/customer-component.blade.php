<div>  

    @section('title','SERP | Customers')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <h3 class="card-title">All Customers</h3>
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
                                <a href="{{-- {{ route('customers_export') }} --}}" class="btn btn-primary float-right text-white">Export Excel</a>
                            </div>

                            <div class="col-2">
                                <a class="btn btn-success float-right text-white" href="{{ route('add_customers') }}">Add New Customer</a>
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
                                    <th wire:click="sortBy('name')">Firm Name</th>
                                    <th>Trade License</th>
                                    <th>Income Tax No:</th>
                                    <th>BIN No:</th>
                                    <th>Contact Person</th>
                                    <th>NID</th>
                                    <th>Present Address</th>
                                    <th>Permanent Address</th>
                                    <th>Mobile</th>
                                    <th>Land Phone</th>
                                    <th>Email</th>
                                    <th>Credit Limit</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($allCustomers as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->firm_name }}</td>
                                        <td>{{ $value->trade_license }}</td>
                                        <td>{{ $value->income_tax_no }}</td>
                                        <td>{{ $value->bin_no }}</td>
                                        <td>{{ $value->contact_person }}</td>
                                        <td>{{ $value->nid_no }}</td>
                                        <td>{{ $value->present_address }}</td>
                                        <td>{{ $value->permanent_address }}</td>
                                        <td>{{ $value->mobile_phone }}</td>
                                        <td>{{ $value->land_phone }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->credit_limit }}</td>
                                        <td>{{ $value->balance }}</td>

                                        <td>

                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            


                                                    <a href="{{ route('ledgers',['id'=>$value->id]) }}" class="dropdown-item btn btn-primary btn-sm"><i class="fas fa-book-open mr-2"></i> Ledger</a>

                                                    <a href="{{ route('edit_customers', $value->id) }}" class="dropdown-item btn btn-warning btn-sm"><i class="fas fa-pen-fancy mr-2"></i> Edit Customer Info</a>

                                                    
                                                    {{-- <a class="dropdown-item btn btn-danger waves-effect waves-light btn-sm" wire:click="deleteID('{{ $value->id }}')" data-toggle="modal" data-target="#modalDeleteCustomer"><i class="fas fa-trash"></i> Delete</a> --}}

                                                    {{-- <a href="{{ route('old_ledger',['c_id'=>$value->id]) }}" class="dropdown-item btn btn-primary btn-sm"><i class="fas fa-book-open"></i> Old Ledger</a> --}}
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allCustomers->links() }}
                    </div>
                </div>
            </div>
            <!-- Main content end-->

            
        </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>