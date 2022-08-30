<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\VenderShop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminManageShop extends Component
{
    public $user;
    public function deleteShop($id){
        $vendor = VenderShop::find($id);
        $vendor->delete();
        session()->flash('message','Shop has been deleted successfully');
    }
    


    // Activation for shops
    public function Activation($id,$is_active){
        $vendor = VenderShop::find($id);
        $user = User::find($vendor->user_id);
        $vendor->is_active = $is_active;
        if($is_active == "1"){
            $vendor->is_active = "1";
            $message = 'Shop Activated successfully!';
            $user->usertype = "Vendor";
            
        }
        elseif($is_active == "0"){
            $vendor->is_active = "0";
            $message = 'Shop does not active anymore!';
            $user->usertype = "pending";
        }
        $vendor->save();
        $user->save();
        session()->flash('message',$message);
    }


   

    public function render()
    {
        
        $vendors = VenderShop::paginate(10);
        return view('livewire.admin.admin-manage-shop',['vendors'=>$vendors])->layout('layouts.admin');
    }
}
