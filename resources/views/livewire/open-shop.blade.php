<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-title">Request To Open New Shop</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="inline-block alert alert-success" role="alert">
                                {{Session::get('message')}}
                                <strong class="inline-block alert alert-info" role="alert">{{Session::get('message1')}}</strong>
                            </div>
                        @endif
                        {{-- @if (Session::has('message1'))
                            <strong class="inline-block alert alert-primary" role="alert">{{Session::get('message1')}}</strong>
                        @endif --}}
                        <form wire:submit.prevent="requesToOpenAShop" class="forms-sample" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="exampleFormControlInput1">Name of the shop</label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="shop name" wire:model="shopname">
                              @error('shopname')<span class="text-danger">{{$message}}</span> @enderror <br>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Some Description</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model="discription"></textarea>
                              @error('discription')<span class="text-danger">{{$message}}</span> @enderror <br>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary text-center">Request</button>
                               </div>
                             </div>
                          </form>
                        {{-- <form wire:submit.prevent="venderShop" class="forms-sample" enctype="multipart/form-data">
                          <div class="form-group">
                              <label>Name of the Shop</label>
                                <input type="text" class="form-control input-md" placeholder="Product Name" wire:model="name" wire:keyup="generateSlug">
                                @error('name')<span class="text-danger">{{$message}}</span> @enderror <br>
                          </div>
                          <div class="form-group">
                              <label>Description</label>
                                <input type="textarea" class="form-control input-md" placeholder="Product Slug" wire:model="slug">
                                @error('slug')<span class="text-danger">{{$message}}</span> @enderror <br>
                          </div>
                          
                          <div class="form-group text-center">
                             <button type="submit" class="btn btn-primary text-center">Submit</button>
                            </div>
                          </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





