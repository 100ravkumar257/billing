<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;

class HeaderDataServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
   
        View::composer('*', function ($view) {
          
            $retailerId = session('retailer_id');

            $retailer = User::where('id', $retailerId)
            ->where('status', 1)
            ->select('name') 
    
            ->first();
    
            $categories = ProductCategory::where('status', 1)
            ->where('parent_category', 0)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->get();
    
            $products = Product::with(['variants' => function ($query) {
                $query->select('product_id', 'size'); 
            }])
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->get();
    

           
            $view->with(compact('categories'));
        });
    }
    
}


