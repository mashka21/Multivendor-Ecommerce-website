<?php

namespace App\Http\Livewire;

use App\Mail\OpenShop as MailOpenShop;
use App\Models\User;
use App\Models\VenderShop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OpenShop extends Component
{
    public $shopname;
    public $discription;

    public function updated($fields){
        $this->validateOnly($fields,[
            'shopname' => 'required',
            'discription' => 'required',
        ]);
    }
    public function requesToOpenAShop(){
        $this->validate([
            'shopname' => 'required',
            'discription'=>'required'
        ]);

        $shop = new VenderShop();
        $shop->shop_name = $this->shopname;
        $shop->description = $this->discription;
        $shop->user_id = Auth::user()->id;
        $shop->save();
        session()->flash('message','Shop request sent.');
        session()->flash('message1','we will activate as soon as possible in the next 24h');
        $this->sendShopRequestMail($shop);
    }

    public function sendShopRequestMail($shop){
        Mail::to('adeegostore1to6@gmail.com')->send(new MailOpenShop($shop));
    }



    public function render()
    {
        return view('livewire.open-shop')->layout('layouts.home');
    }
}
