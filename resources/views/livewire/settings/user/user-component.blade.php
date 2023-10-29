<div>  

    @section('title','SERP | Users')
    
    <style type="text/css">
       /* The switch - the box around the slider */
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }

        /* The slider */
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }

        input:checked + .slider {
          /*background-color: #2196F3;*/
          background-color: #0fa83b;
        }

        input:focus + .slider {
          /*box-shadow: 0 0 1px #2196F3;*/
          box-shadow: 0 0 1px #0fa83b;
        }

        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        } 
    </style>


    <div class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                        <h3 class="card-title">All Users</h3>
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
                                        <a data-toggle="modal" data-target="#modalAdd" class="btn btn-success float-right text-white"> Add New User </a>
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
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($users as $key=>$value)
                                            <tr>
                                                

                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->user_type }}</td>
                                                <td class="text-center">
                                                    @if($value->id != auth()->user()->id)
                                                        <label class="switch">
                                                          <input type="checkbox" wire:click="toggleActive({{ $value->id }})" @if($value->user_status) checked @endif>
                                                          <span class="slider round"></span>
                                                        </label>
                                                    @endif
                                                </td>

                                                <td>

                                                    @if($value->id != auth()->user()->id)
                                                         <a wire:click="getItem('{{ $value->id }}')" data-toggle="modal" data-target="#modalEdit" class=" btn btn-warning btn-sm"><i class="fas fa-pen-fancy mr-2"></i> Edit </a>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links() }}
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
                                        <h4 class="modal-title">Add User</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                      </div>
                                      <!--=====================================
                                        MODAL BODY
                                      ======================================-->
                                      <div class="modal-body">
                                        <div class="box-body">

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Name:</strong>
                                                <input type="text" class="form-control" name="name" placeholder="Name" required wire:model="name">
                                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Email:</strong>
                                                <input type="email" class="form-control" name="email" placeholder="Email" required wire:model="email">
                                                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Password:</strong>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required wire:model="password">
                                                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Select Role:</strong>
                                                <select class="form-control" name="user_type" required wire:model="user_type">
                                                    
                                                    <option value="">Select User Type</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="seller">Seller</option>

                                                </select>
                                                @error('user_type') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <h4 class="modal-title">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                      </div>
                                      <!--=====================================
                                        MODAL BODY
                                      ======================================-->
                                      <div class="modal-body">
                                        <div class="box-body">

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Name:</strong>
                                                <input type="text" class="form-control" name="e_name" placeholder="Name" required wire:model="e_name">
                                                @error('e_name') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Email:</strong>
                                                <input type="email" class="form-control" name="e_email" placeholder="Email" required wire:model="e_email">
                                                @error('e_email') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Password:</strong>
                                                <input type="password" class="form-control" name="e_password" placeholder="Password" wire:model="e_password">
                                                @error('e_password') <span class="error text-danger">{{ $message }}</span> @enderror
                                              </div>
                                            </div>

                                            <div class="input-group">             
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong>Select Role:</strong>
                                                <select class="form-control" name="e_user_type" required wire:model="e_user_type">
                                                    
                                                    <option value="">Select User Type</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="seller">Seller</option>

                                                </select>
                                                @error('e_user_type') <span class="error text-danger">{{ $message }}</span> @enderror
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