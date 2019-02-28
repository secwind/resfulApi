<?php

use App\User;
use App\Model\Invoice;
use App\Model\Product;
use App\Model\Category;
use App\Model\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $this->call(UsersTableSeeder::class);
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        Invoice::truncate();
        DB::table('category_product')->truncate();
        DB::table('invoice_product')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();
        Invoice::flushEventListeners();

        $usersQuantity = 200;
        $categoriesQuantity = 30;
        $productsQuantity = 100;
        $transactionsQuantity = 100;

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();

        factory(Product::class, $productsQuantity)->create()->each(
        	function ($product) {
        		$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
        		$product->categories()->attach($categories);
        	});

        factory(Transaction::class, $transactionsQuantity)->create();
        factory(Invoice::class, $transactionsQuantity)->create();
    }
}
