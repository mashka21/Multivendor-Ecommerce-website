<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use App\Models\category;
use App\Models\product;
use App\Models\ProductAttribute;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use illuminate\Support\Str;
use Livewire\WithFileUploads;

class AddNewProductComponent extends Component
{

    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $shop_name;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $images;
    public $category_id;
    public $scategory_id;

    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values;

    public function mount(){
        $this->stock_status = 'instock';
        $this->sale_price = 0;
        if(Auth::user()->usertype === 'Vendor'){
            $this->shop_name = Auth::user()->Shop->shop_name;
        }
        $this->featured = 0;
    }

    // add attribute
    public function add(){
        if(!in_array($this->attr,$this->attribute_arr)){
            array_push($this->inputs,$this->attr);
            array_push($this->attribute_arr,$this->attr);
        }
    }
    //remove attribute
    public function remove($attr){
        unset($this->inputs[$attr]);
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpg,jpeg,png',
            'category_id'=>'required'
        ]);
    }

    public function addProduct(){

        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpg,jpeg,png',
            'category_id'=>'required'
        ]);

        $product = new product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        if(Auth::user()->usertype==='Vendor'){
            $product->Shop_name = $this->shop_name;
        }
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;

        if($this->images){
            $imagesname = '';
            foreach($this->images as $key=>$image){
                $imgName = Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname . ',' .$imgName;
            }
            $product->images = $imagesname;
        }

        $product->category_id = $this->category_id;
        if($this->scategory_id){
            $product->subcategory_id = $this->scategory_id;
        }

        $product->save();

        if($this->attr){
        foreach($this->attribute_values as $key => $attribute_value){
            $values = explode(",",$attribute_value);
            foreach($values as $value){
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $value;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
    }
        Session()->flash('message','One Product has been added Successfully');
    }

    public function changeSubcategory(){
        $this->scategory_id =0;
    }
    public function render()
    {
        $categories = category::all();
        $scategories = subcategory::where('category_id',$this->category_id)->get();
        $pattributes = ProductAttribute::all();
        return view('livewire.admin.add-new-product-component',['categories'=>$categories,'scategories'=>$scategories,'pattributes'=>$pattributes])->layout('layouts.admin');
    }
}
