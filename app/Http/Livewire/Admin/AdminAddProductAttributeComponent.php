<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminAddProductAttributeComponent extends Component
{
    public $name;

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
        ]);
    }
    public function storeAttribute(){
        $this->validate([
            'name' => 'required',
        ]);

        $pattribute = new ProductAttribute();
        $pattribute->name = $this->name;
        $pattribute->save();
        session()->flash('message','Attribute has been added Successfully!');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-product-attribute-component')->layout('layouts.admin');
    }
}
