<div>  

    @section('title','SERP | Make Import')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Make Import</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('imports') }}">Imports</a></li>
                        <li class="breadcrumb-item active">Make Import</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="card container">
                <div class="container-fluid">
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Store()">
                        @csrf
                        <!--=====================================
                            MODAL HEADER
                        ======================================-->  
                          <div class="modal-header">
                            <h4 class="modal-title">Make Import</h4>
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            
                          </div>
                          <!--=====================================
                            MODAL BODY
                          ======================================-->
                          <div class="modal-body">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-6">

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Import Code:</strong>
                                            <input type="text" class="form-control" name="import_code" placeholder="Import Code" required wire:model="import_code">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Region:</strong>
                                            <input type="text" class="form-control" name="region" placeholder="Region" required wire:model="region">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Import Date:</strong>
                                            <input type="date" class="form-control" name="import_date" placeholder="Import Date" required wire:model="import_date">
                                          </div>
                                        </div>
                                      </div>

                                      
                                    </div>

                                    <div class="col-md-6">

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Note:</strong>
                                            <textarea class="form-control" name="Note" placeholder="Note" wire:model="note"></textarea>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Product Input Type:</strong>
                                            <select class="form-control" name="product_input_type" required wire:model="product_input_type">
                                                
                                                <option value="" disabled>Select Type</option>
                                                <option value="from_excel">From Excel</option>
                                                <option value="menual">Menual</option>

                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                      @if($product_input_type === 'from_excel')

                                      <div class="form-group">          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Select Excel:</strong>
                                            <input type="file" required wire:model="product_list_excel">
                                          </div>
                                        </div>
                                      </div>

                                      @endif

                                    </div>

                                </div>
                              
                            </div>
                          </div>
                          <!--=====================================
                            MODAL FOOTER
                          ======================================-->
                          <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
                            <button type="submit" class="btn btn-success waves-effect waves-light">Store</button>
                          </div>
                    </form>
                </div>
                
            </div>
               

            @if($product_input_type === 'from_excel')    
            <div class="card container">
                <div class="container-fluid">

                  <div class="modal-header">
                    <h4 class="modal-title">Sample Excel Format</h4>                    
                  </div>

                  <table class="table table-bordered" style="text-align:center;">
                    <thead>
                      <tr>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>E</th>
                        <th>F</th>
                        <th>G</th>
                        <th>H</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Product Description</th>
                        <th>SKU</th>
                        <th>Unit Code</th>
                        <th>Quantity</th>
                        <th>Unit Purchase Price</th>
                        <th>Cost Per Unit</th>
                        <th>Sell Price Low</th>
                        <th>Sell Price High</th>
                      </tr>
                    </tbody>
                  </table>

                </div>
            </div>
            @endif       
                        
                    
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>