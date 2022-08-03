<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminProductAttributesComponent extends Component
{
    public function deleteAttribute($attribute_id){
        $pattribute = ProductAttribute::find($attribute_id);
        $pattribute->delete();
        session()->flash('message','Attribute has been deleted successfully!');
    }
    public function render()
    {
        $pattributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-product-attributes-component',['pattributes'=>$pattributes])->layout('layouts.admin');
    }
}
