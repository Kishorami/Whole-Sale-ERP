<div>  

    @section('title','SERP | Ledger')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ledger</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Ledger</li>
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
                                <h3 class="card-title">Ledger of <b>{{ $customer_info->firm_name }}</b> </h3>
                            </div>
                            <div class="col-6">
                            </div>

                            <div class="col-2">
                            </div>

                            <div class="col-2">
                                <a class="btn btn-success float-right text-white" data-toggle="modal" data-target="#modalAdd">New Debit</a>
                            </div>
                        </div>             
                    </div>
                    <br>
                    <div class="col-md-12">

                        <div class="row m-2">
                            <div class="col-sm-4">
                                <strong>Firm Name:</strong> {{ $customer_info->firm_name }}<br>
                                <strong>Trade License:</strong> {{ $customer_info->trade_license }}<br>
                                <strong>Income Tax No:</strong> {{ $customer_info->income_tax_no }}<br>
                                <strong>BIN No:</strong> {{ $customer_info->bin_no }}<br>
                                <strong>Contact Person:</strong> {{ $customer_info->contact_person }}<br>
                                <strong>NID:</strong> {{ $customer_info->nid_no }}<br>
                            </div>

                            <div class="col-sm-4">
                                <strong>Present Address:</strong> {{ $customer_info->present_address }}<br>
                                <strong>Permanent Address:</strong> {{ $customer_info->permanent_address }}<br>
                                <strong>Mobile:</strong> {{ $customer_info->mobile_phone }}<br>
                                <strong>Land Phone:</strong> {{ $customer_info->land_phone }}<br>
                                <strong>Email:</strong> {{ $customer_info->email }}<br>
                            </div>
                            <div class="col-sm-4">
                                <strong>Credit Limit:</strong> {{ $customer_info->credit_limit }} BDT <br>
                                <strong>Balance:</strong> {{ $customer_info->balance }} BDT <br>
                                <strong>Credit Left:</strong> {{ $customer_info->credit_limit - $customer_info->balance }} BDT <br>
                                <strong>Point:</strong> {{ $customer_info->point }}<br>

                                <h3>Total Profit: {{ customer_profit($customer_info->id) }} BDT </h3>

                            </div>
                        </div>

                        <hr>

                        <table id="datatable-makesales" class="table table-bordered table-striped nowrap data-table-makesales" style="overflow-wrap: anywhere;" width="100%">
                            <thead style="text-align: center;">
                            <tr>
                                <th>S/N</th>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Bill Code</th>
                                <th>Debit (জমা)</th>
                                <th>Credit (খরচ)</th>
                                <th>Balance</th>
                                <th width="10%">Payment Method</th>
                                <th width="15%">Note</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($records as $key=>$value)
                                    <tr>
                                        
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>{{ $value->particulars }}</td>
                                        <td>{{ $value->bill_code }}</td>
                                        <td style="text-align:right;">{{ $value->debit }}</td>
                                        <td style="text-align:right;">{{ $value->credit }}</td>
                                        <td style="text-align:right;">{{ $value->balance }}</td>
                                        <td>{{ $value->paymentMethod->name }}</td>
                                        <td>{{ $value->note }}</td>

                                        <td>

                                            @if($value->particulars != "Bill")

                                                <div class="btn-group dropleft">
                                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a href="{{ route('money_receipt',['id'=>$value->id]) }}" class="dropdown-item btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> Print Money Receipt</a>

                                                    <a class="dropdown-item btn btn-warning btn-sm" wire:click="getItem('{{ $value->id }}')" data-toggle="modal" data-target="#modalEdit"><i class="fas fa-pen-fancy"></i> Edit</a>

                                                    </div>
                                                </div>

                                            @else

                                                <div class="btn-group dropleft">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <a href="{{ route('invoice',['bill_no'=>$value->bill_code]) }}" class="dropdown-item btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> Print Bill</a>

                                                    <a href="{{ route('challan',['bill_no'=>$value->bill_code]) }}" class="dropdown-item btn btn-success btn-sm" target="_blank"><i class="fas fa-print"></i> Print Challan</a>

                                                    </div>
                                                </div>

                                            @endif
                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $records->links() }}

                    </div>
                </div>
            </div>
            <!-- Main content end-->

            <!--==========================
              =  Modal window for Add Content    =
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
                                <h4 class="modal-title">New Entry</h4>
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
                                            <strong>Date:</strong>
                                            <input type="datetime-local" class="form-control" name="date" placeholder="Date" required wire:model="date">
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Particular:</strong>
                                            <input type="text" class="form-control" name="particulars" placeholder="Particular" required wire:model="particulars">
                                          </div>
                                        </div>
                                      </div>

                                      
                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Debit:</strong>
                                            <input type="text" class="form-control" name="debit" placeholder="Debit" required wire:model="debit">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Note:</strong>
                                            <select id="select-payment-method" class="form-control" name="payment_method_id" required>
                                                <option value="">Select Payment Method</option>
                                                @foreach ($payment_methods as $key=>$value)
                                                    <option value="{{ $value->id }}">{{ $value->id }} : {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Note:</strong>
                                            <textarea class="form-control" name="note" placeholder="Note"  wire:model="note"></textarea>
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
              =  Modal window for Add Content    =
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
                                <h4 class="modal-title">Edit Debit Information</h4>
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
                                            <strong>Particular:</strong>
                                            <input type="text" class="form-control" name="e_particulars" placeholder="Particular" required wire:model="e_particulars">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Note:</strong>
                                            <select id="e-select-payment-method" class="form-control" name="e_payment_method_id" required>
                                                <option value="">Select Payment Method</option>
                                                @foreach ($payment_methods as $key=>$value)
                                                    <option value="{{ $value->id }}">{{ $value->id }} : {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group" wire:ignore>          
                                        <div class="input-group">             
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Note:</strong>
                                            <textarea class="form-control" name="e_note" placeholder="Note"  wire:model="e_note"></textarea>
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
    @push('scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            $('#select-payment-method').select2();
            $('#select-payment-method').on('change', function (e) {
                var data = $('#select-payment-method').select2("val");
                @this.set('payment_method_id', data);
            });
        });

        $(document).ready(function () {
            $('#e-select-payment-method').select2();
            $('#e-select-payment-method').on('change', function (e) {
                var data = $('#e-select-payment-method').select2("val");
                @this.set('e_payment_method_id', data);
            });
        });

        Livewire.on('set_payment_method', postId => {
            $('#e-select-payment-method').val(@this.e_payment_method_id).trigger('change');
        })

        Livewire.on('reset_payment_method', postId => {
            $('#select-payment-method').val("").trigger('change');
        })

    </script>

    @endpush
</div>