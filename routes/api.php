<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/***
	*Buyers 
*/  
Route::resource('buyers', 'Buyer\BuyerController')->only(['index', 'show']);
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController')->only(['index']);
Route::resource('buyers.categories', 'Buyer\BuyerCategoryController')->only(['index']);
Route::resource('buyers.products', 'Buyer\BuyerProductController')->only(['index']);
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController')->only(['index']);
Route::resource('buyers.invoices', 'Buyer\BuyerInvoiceController')->only(['index']);
  

/***
	*Categories 
*/ 
Route::resource('categories', 'Category\CategoryController')->except([ 'create', 'edit']);
Route::resource('categories.sellers', 'Category\CategorySellerController')->only(['index']);
Route::resource('categories.buyers', 'Category\CategoryBuyerController')->only(['index']);
Route::resource('categories.products', 'Category\CategoryProductController')->only(['index']);
Route::resource('categories.transactions', 'Category\CategoryTransactionController')->only(['index']);
Route::resource('categories.invoices', 'Category\CategoryInvoiceController')->only(['index']);

/***
	*Products 
*/    
Route::resource('products', 'Product\ProductController')->only(['index', 'show']);
Route::resource('products.transactions', 'Product\ProductTransactionController')->only(['index']);
Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController')->only(['store']);
Route::resource('products.buyers', 'Product\ProductBuyerController')->only(['index']);
Route::resource('products.categories', 'Product\ProductCategoryController')->only(['index','update','destroy']);


/***
	*Sellers 
*/
Route::resource('sellers', 'Seller\SellerController')->only(['index', 'show']);
Route::resource('sellers.transactions', 'Seller\SellerTransactionController')->only(['index']);
Route::resource('sellers.categories', 'Seller\SellerCategoryController')->only(['index']);
Route::resource('sellers.buyers', 'Seller\SellerBuyerController')->only(['index']);
Route::resource('sellers.products', 'Seller\SellerProductController')->only(['index', 'store','update', 'destroy']);
    

/***
	*Transactions 
*/
Route::resource('transactions', 'Transaction\TransactionController')->only(['index', 'show']);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController')->only(['index', 'show']);
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController')->only(['index', 'show']);
    

/***
	*Invoices 
*/
Route::resource('invoices', 'Invoice\InvoiceController')->only(['index', 'show']);
Route::resource('invoices.buyers', 'Invoice\InvoiceBuyerController')->only(['index']);
Route::resource('invoices.sellers', 'Invoice\InvoiceSellerController')->only(['index']);
Route::resource('invoices.products', 'Invoice\InvoiceProductController')->only(['index']);


/***
	*Users 
*/
Route::resource('users', 'User\UserController');
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');


// Route::get('secwind', 'User\UserController@secwind');