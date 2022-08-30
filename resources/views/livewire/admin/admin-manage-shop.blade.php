<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if (Auth::user()->usertype === 'ADM')
                                    <p class="pull-left card-title">Manage All Registered Shops</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <table class="table table-striped table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th>shop ID</th>
                                    <th>Shop Name</th>
                                    <th>Shop Descripion</th>
                                    <th>Status</th>
                                    <th>Registered Date</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors  as $vendor)
                                    <tr>
                                        <td>{{$vendor->id}}</td>
                                        <td>{{$vendor->shop_name}}</td>
                                        <td style="width: 100px important;">{{$vendor->description}}</td>
                                        {{-- <td>
                                            @if($vendor->is_active === 1)
                                            <span class="btn-success btn-sm">Active</span>
                                            @else
                                            <span class="btn-info btn-sm">In active</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-success btn-sm dropdown-toggle" type="submit" data-toggle="dropdown">Status
                                                    <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item"><a href="#" wire:click.prevent="Activation({{$vendor->id}},'1')">Active</a></li>
                                                    <li class="dropdown-item"><a href="#" wire:click.prevent="Activation({{$vendor->id}},'0')">In Active</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{$vendor->created_at}}</td>
                                        <td>
                                            {{-- @if (Auth::user()->usertype === 'vendor')
                                                <a href="{{route('vendor.edit_vendors',['vendor_id'=>$vendor->id])}}"><i class="fa fa-edit fa-2x"></i></a>
                                            @else --}}
                                            <a href="{{route('admin.editshop',['id'=>$vendor->id])}}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('Are you sure to delete this Shop?') || event.stopImmediatePropagation()" wire:click.prevent="deleteShop({{$vendor->id}})"><i class="fa fa-times fa-2x text-danger" style="margin-left: 10px;"></i></a>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$vendors->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
