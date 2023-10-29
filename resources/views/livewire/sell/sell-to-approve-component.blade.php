<div>  

    @section('title','SERP | Sell To Approve')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sell To Approve</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sell To Approve</li>
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
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($sellToApprove as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->bill_no }}</td>
                                        <td>{{ $value->customer->firm_name }}</td>
                                        <td>{{ $value->invoiceBy->name }}</td>
                                        <td>{{ $value->created_at }}</td>

                                        <td>

                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a href="{{ route('give_approval', $value->id) }}" class="dropdown-item btn btn-warning btn-sm"><i class="fas fa-check mr-2"></i> Give Approval</a>

                                                    
                                                    <a class="dropdown-item btn btn-danger waves-effect waves-light btn-sm" wire:click="deleteID('{{ $value->id }}')" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash mr-2"></i> Delete</a>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $sellToApprove->links() }}
                    </div>
                </div>
            </div>
            <!-- Main content end-->

            <!--==========================
              =  Modal window for Delete    =
              ===========================-->
            <!-- sample modal content -->
            <div wire:ignore.self id="modalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Unapproved Sale</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!--=====================================
                            MODAL BODY
                        ======================================-->
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group" wire:ignore>          
                                    <div class="input-group">             
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <h2 class="text-center" style="color:red;">Are you want to delete?</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <!--=====================================
                            MODAL FOOTER
                          ======================================-->
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="delete()" class="btn btn-success waves-effect waves-light">Confirm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                        
                        
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>