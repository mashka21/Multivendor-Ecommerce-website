<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\product;
use App\Models\VenderShop;
use Illuminate\Support\Facades\Auth;

class AdminProductComponent extends Component
{
    public $searchTerm;
    public function deleteProduct($id){
        $product = product::find($id);
        if($product->image){
            unlink('assets/images/products'.'/'.$product->image);
        }
        if($product->images){
            $images = explode(",",$product->images);
            foreach($images as $image){
                if($image){
                    unlink('assets/images/products'.'/'.$image);
                }
            }
        }
        $product->delete();
        Session()->flash('message', 'Product has been deleted Successfully');
    }


    // approval or reject product
    public function updateProductStatus($id,$status){
        $product = product::find($id);
        $product->product_status = $status;
        if($status == "approved"){
            $product->product_status = "approved";
            $message = 'Product has been APPROVED successfully!';
        }
        elseif($status == "rejected"){
            $product->product_status = "rejected";
            $message = 'Product has been REJECTED successfully!';
        }
        $product->save();
        session()->flash('message',$message);

    }


    public function render()
    {
        $search = '%'. $this->searchTerm . '%';
        $products = product::where('name','LIKE',$search)
                              ->orwhere('stock_status','LIKE',$search)
                              ->orwhere('regular_price','LIKE',$search)
                              ->orwhere('sale_price','LIKE',$search)
                              ->orderBy('id','DESC')->paginate(5);

        if(Auth::user()->usertype === 'Vendor'){
            $products = product::where('Shop_name',Auth::user()->Shop->shop_name)
                                ->where(function($query) use ($search) {
                                    return $query
                                    ->where('name','LIKE',$search)
                                    ->orwhere('stock_status','LIKE',$search)
                                    ->orwhere('regular_price','LIKE',$search)
                                    ->orwhere('sale_price','LIKE',$search);
                                })
                                ->orderBy('id','DESC')->paginate(5);
        }


        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.admin');
    }
}
