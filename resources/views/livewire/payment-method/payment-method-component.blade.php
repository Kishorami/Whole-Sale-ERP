<div>  

    @section('title','SERP | Payment Method')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Method</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment Method</li>
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
                                <h3 class="card-title">All Payment Method</h3>
                            </div>
                            <div class="col-6">
                            </div>

                            <div class="col-2">
                            </div>

                            <div class="col-2">
                                <a class="btn btn-success float-right text-white" data-toggle="modal" data-target="#modalAdd">Add New Payment Method</a>
                            </div>
                        </div>             
                    </div>
                    <br>
                    <div class="col-12">

                        <div class="row">

                            {{-- <label for="paginate" class="ml-3" style="margin-top: auto;">Show</label> --}}
                            <div class="col-sm-2">
                                {{-- <select id="paginate" name="paginate" class="form-control input-sm" wire:model="paginate">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> --}}
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
                                    <th wire:click="sortBy('id')" style="width:5%">S/N</th>
                                    <th wire:click="sortBy('name')">Name</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($payment_methods as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>

                                        <td>

                                            <a wire:click="getItem('{{ $value->id }}')" data-toggle="modal" data-target="#modalEdit" class=" btn btn-warning btn-sm"><i class="fas fa-pen-fancy mr-2"></i> Edit </a>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $payment_methods->links() }}
                    </div>
                </div>
            </div>
            <!-- Main content end-->

            <!--==========================
              =  Modal window for Edit Content    =
              ===========================-->
            <!-- sample modal content -->
            <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="Store()">
                            @csrf
                            <!--=====================================
                                MODAL HEADER
                            ======================================-->  
                              <div class="modal-header">
                                <h4 class="modal-title">Add Payment Method</h4>
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
                                            <strong>Name:</strong>
                                            <input type="text" class="form-control" name="name" placeholder="Name" required wire:model="name">
                                          </div>
                                        </div>
                                      </div>

                                      
                                  
                                </div>
                              </div>
                              <!--=====================================
                                MODAL FOOTER
                              ======================================-->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
                              </div>
                        </form>
                        
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!--==========================
              =  Modal window for Edit Content    =
              ===========================-->
            <!-- sample modal content -->
            <div wire:ignore.self id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="Update()">
                            @csrf
                            <!--=====================================
                                MODAL HEADER
                            ======================================-->  
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Payment Method</h4>
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
                                            <strong>Name:</strong>
                                            <input type="text" class="form-control" name="e_name" placeholder="Name" required wire:model="e_name">
                                          </div>
                                        </div>
                                      </div>

                                      
                                  
                                </div>
                              </div>
                              <!--=====================================
                                MODAL FOOTER
                              ======================================-->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                              </div>
                        </form>
                        
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>