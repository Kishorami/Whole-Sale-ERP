<div>  

    @section('title','SERP | Imports')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Imports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Imports</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <div class="col-lg-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <h3 class="card-title">All Imports</h3>
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
                                <a class="btn btn-success float-right text-white" href="{{ route('add_imports') }}">Make New Import</a>
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
                                    <th>Import Code</th>
                                    <th>Region</th>
                                    <th>Note</th>
                                    <th>Import Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($allImports as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->import_code }}</td>
                                        <td>{{ $value->region }}</td>
                                        <td>{{ $value->note }}</td>
                                        <td>{{ $value->import_date }}</td>

                                        <td>

                                            <div class="btn-group dropleft">
                                                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a href="{{ route('imported_products', $value->id) }}" class="dropdown-item btn btn-warning btn-sm"><i class="fas fa-eye"></i> View Products</a>

                                                    <a wire:click="getItem('{{ $value->id }}')" data-toggle="modal" data-target="#modalEdit" class="dropdown-item btn btn-warning btn-sm"><i class="fas fa-pen-fancy mr-2"></i> Edit Enformation</a>

                                                    
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allImports->links() }}
                    </div>
                </div>
            </div>
            <!-- Main content end-->

            
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
                                <h4 class="modal-title">Edit Import</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <!--=====================================
                                MODAL BODY
                              ======================================-->
                              <div class="modal-body">
                                <div class="box-body">

                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Import Code:</strong>
                                        <input type="text" class="form-control" name="import_code" placeholder="Import Code" required wire:model="import_code">
                                        @error('import_code') <span class="error text-danger">{{ $message }}</span> @enderror
                                      </div>
                                    </div>

                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Region:</strong>
                                        <input type="text" class="form-control" name="region" placeholder="Region" required wire:model="region">
                                        @error('region') <span class="error text-danger">{{ $message }}</span> @enderror
                                      </div>
                                    </div>

                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Note:</strong>
                                        <textarea class="form-control" name="note" placeholder="Region" required wire:model="note"></textarea>
                                        @error('note') <span class="error text-danger">{{ $message }}</span> @enderror
                                      </div>
                                    </div>

                                    <div class="input-group">             
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>Import Date:</strong>
                                        <input type="date" class="form-control" name="import_date" required wire:model="import_date">
                                        @error('import_date') <span class="error text-danger">{{ $message }}</span> @enderror
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


        </div>
            
        </div><!-- /.container-fluid -->
    </section>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>