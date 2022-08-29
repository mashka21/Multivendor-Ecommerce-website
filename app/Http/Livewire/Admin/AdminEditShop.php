<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\VenderShop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminEditShop extends Component
{
    public $shop_name;
    public $shop_description;
    public $is_active;
    public $shop_id;
    public $user_id;



    public function mount($id) {
        $shop = VenderShop::where('id',$id)->first();
        $this->shop_name = $shop->shop_name;
        $this->shop_description = $shop->description;
        $this->is_active = $shop->is_active;
        $this->shop_id = $shop->id;
        $this->user_id = $shop->user_id;

    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'shop_name'=>'required',
            'shop_description'=>'required',
            'is_active'=>'required'
        ]);
    }

    public function updateVendorShop(){
        $this->validate([
            'shop_name'=>'required',
            'shop_description'=>'required',
            'is_active'=>'required'
        ]);


     $vendor = VenderShop::find($this->shop_id);
     $vendor->shop_name = $this->shop_name;
     $vendor->description = $this->shop_description;
     $vendor->is_active = $this->is_active;
     $user = User::find($this->user_id);
     if($this->is_active == true) {
        $user->usertype = "vendors";
        $user->save();
     }else if($this->is_active == false){
        $user->usertype = "USR";
        $user->save();
     }
     
     $vendor->save();
     session()->flash('message', 'vendor has been updated successfully');
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-shop')->layout('layouts.admin');
    }
}
