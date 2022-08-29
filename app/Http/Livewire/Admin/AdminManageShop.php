<?php

namespace App\Http\Livewire\Admin;

use App\Models\VenderShop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminManageShop extends Component
{
    public function deleteShop($id){
        $vendor = VenderShop::find($id);
        $vendor->delete();
        session()->flash('message','Shop has been deleted successfully');
    }

    public function render()
    {
        $vendors = VenderShop::paginate(10);
        return view('livewire.admin.admin-manage-shop',['vendors'=>$vendors])->layout('layouts.admin');
    }
}
