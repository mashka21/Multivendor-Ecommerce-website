 <div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="pull-left card-title">All Products</p>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('admin.Addproduct')}}" class="btn btn-success pull-right">Add Products</a>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Search..." wire:model="searchTerm">
                            </div>
                        </div>
                    </div>

                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <div class="table-responsive">
                    <style>
                        table td{
                            padding: 1.125rem 0.6rem !important;
                        }
                    </style>
                    <table class="table table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Shop Name</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Category</th>
                                <th>Product Status</th>
                                <th>Action</th>
                                <th>Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img src="{{asset('assets/images/products')}}/{{$product->image}}" alt="products" width="60"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->Shop_name}}</td>
                                    <td>${{$product->regular_price}}</td>
                                    <td>${{$product->sale_price}}</td>
                                    <td>{{$product->category->name}}</td>
                                    @if (Auth::user()->usertype === 'ADM')
                                        @if ($product->product_status == 'pending')
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" type="submit" data-toggle="dropdown">Status
                                                        <span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-item"><a href="#" wire:click.prevent="updateProductStatus({{$product->id}},'approved')">Approval</a></li>
                                                        <li class="dropdown-item"><a href="#" wire:click.prevent="updateProductStatus({{$product->id}},'rejected')">Reject</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @else
                                            <td>{{$product->product_status}}</td>
                                        @endif
                                        
                                    @else
                                        @if ($product->product_status == 'approved')
                                            <td class="text-center">
                                                <i class="fa-solid fa-check text-success"><span class="ml-2">{{$product->product_status}}</span></i>
                                            </td>
                                        @elseif ($product->product_status == 'rejected')
                                            <td class="text-center text-danger">
                                                <i class="fa-solid fa-repeat"><span class="ml-2">{{$product->product_status}}</span>
                                            </td>
                                        @else
                                            <td class="text-center text-info">
                                                <i class="fa-solid fa-clock"> <span class="ml-2">{{$product->product_status}}</span></i>
                                            </td>
                                        @endif
                                    @endif
                                    
                                    <td>
                                        <a href="{{route('admin.editproduct',['product_slug'=>$product->slug])}}"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Are you sure to Delete this product?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{$product->id}})"><i class="fa fa-times fa-2x text-danger" style="margin-left: 10px;"></i></a>
                                    </td>
                                    <td>{{$product->created_at}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
