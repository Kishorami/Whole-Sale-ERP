<div>  

    @section('title','SERP | Edit Customer')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
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
                    <form role="form" enctype="multipart/form-data" wire:submit.prevent="Update()">
                            @csrf
                            <!--=====================================
                                MODAL HEADER
                            ======================================-->  
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Customer</h4>
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
                                                <strong>Firm Name:</strong>
                                                <input type="text" class="form-control" name="firm_name" placeholder="Firm Name" required wire:model="firm_name">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Trade License No:</strong>
                                                <input type="text" class="form-control" name="trade_license" placeholder="Trade License No" required wire:model="trade_license">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Income Tax NO:</strong>
                                                <input type="text" class="form-control" name="income_tax_no" placeholder="Income Tax NO" required wire:model="income_tax_no">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>BIN No:</strong>
                                                <input type="text" class="form-control" name="bin_no" placeholder="BIN No" required wire:model="bin_no">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Contact Person:</strong>
                                                <input type="text" class="form-control" name="contact_person" placeholder="Contact Person" required wire:model="contact_person">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>NID No:</strong>
                                                <input type="text" class="form-control" name="nid_no" placeholder="NID No" required wire:model="nid_no">
                                              </div>
                                            </div>
                                          </div>


                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Present Address:</strong>
                                                <textarea class="form-control" name="present_address" placeholder="Present Address" wire:model="present_address"></textarea>
                                              </div>
                                            </div>
                                          </div>

                                          
                                        </div>

                                        <div class="col-md-6">

                                          <div class="form-group">          
                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Permanent Address:</strong>
                                                <textarea class="form-control" name="permanent_address" placeholder="Permanent Address" wire:model="permanent_address"></textarea>
                                              </div>
                                            </div>
                                          </div>

                                            <div class="form-group">          
                                              <div class="input-group">             
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <strong>Mobile Number:</strong>
                                                  <input type="text" class="form-control" name="mobile_phone" placeholder="Mobile Number" wire:model="mobile_phone">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">          
                                              <div class="input-group">             
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <strong>Land Phone:</strong>
                                                  <input type="text" class="form-control" name="land_phone" placeholder="Land Phone" wire:model="land_phone">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">          
                                              <div class="input-group">             
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <strong>Email:</strong>
                                                  <input type="email" class="form-control" name="email" placeholder="Email" wire:model="email">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">          
                                              <div class="input-group">             
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <strong>Credit Limit:</strong>
                                                  <input type="number" step="any" class="form-control" name="credit_limit" placeholder="Credit Limit" wire:model="credit_limit">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">          
                                              <div class="input-group">             
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <strong>Balance:</strong>
                                                  <input type="number" step="any" class="form-control" name="balance" placeholder="Balance" wire:model="balance" readonly>
                                                </div>
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
                                {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
                                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                              </div>
                        </form>
                </div>
                
            </div>
                
                        
                        
                    
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>