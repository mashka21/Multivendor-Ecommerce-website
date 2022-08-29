<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-title">Edit This Shop</p>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.shops')}}" class="btn btn-success pull-right">All Shops Partners</a>
                            </div>
                        </div>
                    </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form wire:submit.prevent="updateVendorShop" class="form-samles">
                            <div class="form-group">
                                <label>Vendor Shop Name</label>
                                <input type="text" class="form-control input-md" placeholder="Shope Name" wire:model="shop_name">
                                @error('shop_name')<span class="text-danger">{{$message}}</span> @enderror <br>
                            </div>

                            <div class="form-group">
                                <label>Shop information</label>
                                <input type="text" class="form-control input-md" placeholder="Shop Decription" wire:model="shop_description">
                                @error('shop_description')<span class="text-danger">{{$message}}</span> @enderror <br>
                            </div>

                            <div class="form-group">
                                <label>Activate This Shop</label>
                                    <select class="form-control input-md" wire:model="is_active">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                  </select>
                                  @error('is_active')<span class="text-danger">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">Activate</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

