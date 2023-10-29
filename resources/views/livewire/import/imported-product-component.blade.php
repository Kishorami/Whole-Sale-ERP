<div>  

    @section('title','SERP | Imported Products')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Imported Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('imports') }}">Imports</a></li>
                        <li class="breadcrumb-item active">Imported Products</li>
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
                                <h3 class="card-title">Imported Products</h3>
                            </div>
                            <div class="col-6">
                            </div>

                            <div class="col-2">
                            </div>

                            <div class="col-2">
                                <a class="btn btn-success float-right text-white" data-toggle="modal" data-target="#modalAdd">Add New Product</a>
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
                                    <th>S/N</th>
                                    <th>Import Code</th>
                                    <th>Item Description</th>
                                    <th>SKU</th>
                                    <th>Unit</th>
                                    <th>QTY</th>
                                    <th>Stock</th>
                                    <th>Sold</th>
                                    <th>Purchase Per Unit</th>
                                    <th>Cost Per Unit</th>
                                    <th>Unit Price</th>
                                    <th>Sell Price Low</th>
                                    <th>Sell Price High</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($importedItems as $key=>$value)
                                    <tr>
                                        

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->import->import_code }}</td>
                                        <td>{{ $value->item_description }}</td>
                                        <td>{{ $value->sku }}</td>
                                        <td>{{ $value->unit->name }}</td>
                                        <td style="text-align: right;">{{ $value->quantity }}</td>
                                        <td style="text-align: right;">{{ $value->stock }}</td>
                                        <td style="text-align: right;">{{ $value->sold }}</td>
                                        <td style="text-align: right;">{{ $value->purchase_per_unit }}</td>
                                        <td style="text-align: right;">{{ $value->cost_per_unit }}</td>
                                        <td style="text-align: right;">{{ $value->unit_price }}</td>
                                        <td style="text-align: right;">{{ $value->sell_price_low }}</td>
                                        <td style="text-align: right;">{{ $value->sell_price_high }}</td>

                                        <td>

                                            {{-- <a wire:click="getItem('{{ $value->id }}')" data-toggle="modal" data-target="#modalEdit" class=" btn btn-warning btn-sm"><i class="fas fa-pen-fancy mr-2"></i> Edit </a> --}}
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $allUnits->links() }} --}}
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
                                <h4 class="modal-title">Add Product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <!--=====================================
                                MODAL BODY
                              ======================================-->
                              <div class="modal-body">
                                <div class="box-body">

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Item Description:</strong>
                                            <input type="text" class="form-control" name="item_description" placeholder="Item Description" required wire:model="item_description">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="row">

                                        <div class="col-sm-6">
                                            
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>SKU</strong>
                                                <input type="text" class="form-control" name="sku" placeholder="SKU" required wire:model="sku">
                                                @error('sku') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Unit</strong>

                                                <select class="form-control" name="unit_id" required wire:model="unit_id">
                                                    
                                                    <option value="" disabled>Select Unit</option>

                                                    @foreach ($units as $key=>$value)
                                                        <option value="{{ $value->id }}">{{ $value->id }} : {{ $value->name }}</option>
                                                    @endforeach

                                                </select>

                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Quantity</strong>
                                                <input type="text" class="form-control" name="quantity" placeholder="Quantity" required wire:model="quantity">
                                              </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Purchase Per Unit</strong>
                                                <input type="number" step="any" class="form-control" name="purchase_per_unit" placeholder="Purchase Per Unit" required wire:model="purchase_per_unit">
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Cost Per Unit</strong>
                                                <input type="number" step="any" class="form-control" name="cost_per_unit" placeholder="Cost Per Unit" required wire:model="cost_per_unit">
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Sell Price Low</strong>
                                                <input type="number" step="any" class="form-control" name="sell_price_low" placeholder="Sell Price Low" required wire:model="sell_price_low">
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Sell Price High</strong>
                                                <input type="number" step="any" class="form-control" name="sell_price_high" placeholder="Sell Price High" required wire:model="sell_price_high">
                                              </div>
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
                                <h4 class="modal-title">Edit Unit</h4>
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
                                            <strong>Unit Name:</strong>
                                            <input type="text" class="form-control" name="e_name" placeholder="Unit Name" required wire:model="e_name">
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
            
        </div>
            
        </div><!-- /.container-fluid -->
    </section>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>