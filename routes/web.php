<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;

use App\Http\Livewire\Customer\CustomerComponent;
use App\Http\Livewire\Customer\AddCustomerComponent;
use App\Http\Livewire\Customer\EditCustomerComponent;

use App\Http\Livewire\Unit\UnitComponent;

use App\Http\Livewire\PaymentMethod\PaymentMethodComponent;

use App\Http\Livewire\Import\ImportComponent;
use App\Http\Livewire\Import\AddImportComponent;
use App\Http\Livewire\Import\ImportedProductComponent;

use App\Http\Livewire\Sell\MakeSellComponent;
use App\Http\Livewire\Sell\SellToApproveComponent;
use App\Http\Livewire\Sell\GiveApprovalComponent;
use App\Http\Livewire\Sell\ApprovedSellComponent;

use App\Http\Livewire\Ledger\LedgerComponent;

use App\Http\Livewire\Settings\User\UserComponent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('livewire.dashboard.dashboard');
//     })->name('dashboard');
// });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Dashboard routes----------------------------------------------------------------------
        Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    // Dashboard routes----------------------------------------------------------------------

    // Customer routes----------------------------------------------------------------------
        Route::get('/customers', CustomerComponent::class)->name('customers');
        Route::get('/add_customers', AddCustomerComponent::class)->name('add_customers');
        Route::get('/edit_customers/{id}', EditCustomerComponent::class)->name('edit_customers');
    // Customer routes----------------------------------------------------------------------

    // Unit routes----------------------------------------------------------------------
        Route::get('/units', UnitComponent::class)->name('units');
    // Unit routes----------------------------------------------------------------------

    // Payment Method routes----------------------------------------------------------------------
        Route::get('/payment_methods', PaymentMethodComponent::class)->name('payment_methods');
    // Payment Method routes----------------------------------------------------------------------

    // Import routes----------------------------------------------------------------------
        Route::get('/imports', ImportComponent::class)->name('imports');
        Route::get('/add_imports', AddImportComponent::class)->name('add_imports');

        Route::get('/imported_products/{id}', ImportedProductComponent::class)->name('imported_products');
    // Import routes----------------------------------------------------------------------

    // Sell routes----------------------------------------------------------------------
        Route::get('/make_sells', MakeSellComponent::class)->name('make_sells');
        Route::get('/sell_to_approve', SellToApproveComponent::class)->name('sell_to_approve');
        Route::get('/give_approval/{id}', GiveApprovalComponent::class)->name('give_approval');
        Route::get('/approved_sells', ApprovedSellComponent::class)->name('approved_sells');
    // Sell routes----------------------------------------------------------------------

    // Ledger routes----------------------------------------------------------------------
        Route::get('/ledgers/{id}',LedgerComponent::class)->name('ledgers');
    // Ledger routes----------------------------------------------------------------------

    // Invoice routes----------------------------------------------------------------------
        Route::get('/invoice/{bill_no}', [InvoiceController::class, 'invoice'])->name('invoice');
        Route::get('/challan/{bill_no}', [InvoiceController::class, 'challan'])->name('challan');

        Route::get('/money_receipt/{id}', [InvoiceController::class, 'money_receipt'])->name('money_receipt');
    // Invoice routes----------------------------------------------------------------------


    //Settings--------------------------------------------------------------------------------
        Route::get('/user', UserComponent::class)->name('user');
    //Settings--------------------------------------------------------------------------------
});
