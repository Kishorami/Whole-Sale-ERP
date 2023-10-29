<div>  

    @section('title','SERP | Make Sells')
    
    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Make Sells</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Make Sells</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-teal card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Invoice</h3>
                            </div>
                            <div class="card-body">

                                <form role="form" method="post" enctype="multipart/form-data" wire:submit.prevent="Store()">
                                    @csrf

                                    <div class="col-sm-6" wire:ignore>
                                        <strong>Select Customer:</strong>
                                        <select id="select-customer" class="form-control" required>

                                            <option value="">Select Customer</option>

                                            @foreach ($customers as $key=>$value)
                                                <option value="{{ $value->id }}">{{ $value->id }} : {{ $value->firm_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                        @error('customer_id') <span class="error text-danger">{{ $message }}</span> @enderror

                                    @if($customer_id)
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="mb-0"><strong>Firm Name: </strong> {{ $selected_customer->firm_name }}.</p>
                                                <p class="mb-0"><strong>Contact Person: </strong> {{ $selected_customer->contact_person }}.</p>
                                                <p class="mb-0"><strong>Present Address: </strong> {{ $selected_customer->present_address }}.</p>
                                                <p class="mb-0"><strong>Mobile/Land Phone: </strong> {{ $selected_customer->mobile_phone }} / {{ $selected_customer->land_phone }}.</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0"><strong>Credit Limit: </strong> {{ $selected_customer->credit_limit }} BDT</p>
                                                <p class="mb-0"><strong>Balance: </strong> {{ $selected_customer->balance }} BDT</p>
                                                <p class="mb-0"><strong>Point: </strong> {{ $selected_customer->point }}</p>
                                            </div>                                    
                                        </div>
                                    @endif
                                    <hr>

                                    <table class="table table-bordered nowrap" width="100%">
                                        <thead style="text-align: center;">
                                        <tr>
                                            <th width="5%">S/N</th>
                                            <th width="45%">Product</th>
                                            <th width="15%">Unit Price</th>
                                            <th width="15%">Quantity</th>
                                            <th width="15%">Total</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($product_list as $key=>$value)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $value['name'] }}</td>
                                                    <td>
                                                        <input type="number" value="{{ $value['price'] }}" class="form-control input-sm" min="1" step="any" wire:keyup.debounce.300ms="updatePrice({{ $loop->index }}, $event.target.value)">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="{{ $value['quantity'] }}" class="form-control input-sm" min="1" step="any" wire:keyup.debounce.300ms="updateQty({{ $loop->index }}, $event.target.value)">
                                                    </td>
                                                    <td style="text-align: right;">{{ $value['quantity'] * $value['price'] }}</td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm" wire:click="remove({{ $loop->index }})" style="margin:auto;"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach

                                            <tr>
                                                <th colspan="4" style="text-align:right;">Sub Total:</th>
                                                <th style="text-align: right;">{{ $sub_total }}</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align:right;">Grand Total:</th>
                                                <th style="text-align: right;">{{ $grand_total }}</th>
                                                <th></th>
                                            </tr>
                                            
                                        </tbody>
                                    </table>


                                

                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-4">Store Sale</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card card-olive card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="d-flex justify-content-between">
                                    <input type="text" name="barcode" class="form-control col-md-3" placeholder="Barcode" autofocus  wire:keydown.enter="addWithBarcode($event.target.value)" wire:model="barcode">

                                    <input type="search" wire:model.debounce.300ms="search" class="form-control col-md-5" placeholder="Search">
                                </div>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Desc.</th>
                                            <th>Import Code</th>
                                            <th>SKU</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            @foreach($product as $key=>$value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->item_description }}</td>
                                                    <td>{{ $value->import->import_code }}</td>
                                                    <td>{{ $value->sku }}</td>
                                                    <td>{{ $value->stock }}</td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" wire:click="addToList('{{ $value->id }}')">Add</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            <tr>
                                                <th colspan="4" style="text-align:right;">Total Stock</th>
                                                <th>{{ stock_info($product)['stock_total'] }}</th>
                                                <th></th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    @push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#select-customer').select2();
            $('#select-customer').on('change', function (e) {
                var data = $('#select-customer').select2("val");
                @this.set('customer_id', data);
            });
        });

        Livewire.on('reset_customer', postId => {
            $('#select-customer').val("").trigger('change');
        })

    </script>

    @endpush

</div>