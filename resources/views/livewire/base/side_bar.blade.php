<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="/" class="brand-link">
		<img src="{{ asset('assets/dist/img/brm_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">SERP</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{ route('dashboard') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'dashboard') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('customers') }}" 
						class="nav-link {{ 
							(

							in_array(Route::currentRouteName(), array('customers', 'edit_customers', 'add_customers'))

							)

							 ? 'active' : '' }}">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Customers
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('units') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'units') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-weight"></i>
						<p>
							Units
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('payment_methods') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'payment_methods') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-file-invoice-dollar"></i>
						<p>
							Payment Method
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('imports') }}" 
					class="nav-link {{ 
							(

							in_array(Route::currentRouteName(), array('imports', 'imported_products', 'add_imports'))

							)

							 ? 'active' : '' }}">
						<i class="nav-icon fas fa-file-import"></i>
						<p>
							Imports
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('make_sells') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'make_sells') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-cart-arrow-down"></i>
						<p>
							Make Sells
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('sell_to_approve') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'sell_to_approve') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-check"></i>
						<p>
							Sells To Approve
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('approved_sells') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'approved_sells') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-check-double"></i>
						<p>
							Approved Sells
						</p>
					</a>
				</li>
				
				<li class="nav-header">Settings</li>

				<li class="nav-item">
					<a href="{{ route('user') }}" class="nav-link {{ (strpos(Route::currentRouteName(), 'user') === 0) ? 'active' : '' }}">
						<i class="nav-icon fas fa-user"></i>
						<p>
							User
						</p>
					</a>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>