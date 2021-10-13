<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6"><h2 class="font-weight-bold">Product List</h2></div>
                    <div class="col-md-6"><input wire:model="search" type="text" class="form-control" placeholder="Search Products..."></div>        
                </div>
                
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/images/'.$product->image)}}" alt="product image" class="img-fluid">
                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-weight-bold">{{$product->name}}</h6>
                                    <button wire:click='addItem({{$product->id}})' class="btn btn-primary btn-sm btn-block">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    @empty 
                        <h3 class=" text-center text-danger">No Products Found</h3>
                    @endforelse
                </div>
                
            </div>
            
        </div>
        <footer style="display:flex;justify-content:center">{{$products ->links()}}</footer>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">Cart</h2>
                <table class="table table-sm table-bordered table-striped table-hovered">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $index=>$cart)
                            <tr>
                                <td>{{$index + 1}}</td>                                
                                <td>
                                    <a href="#" class="font-weight-bold text-dark">{{$cart['name']}}</a>
                                    </td>
                                <td>
                                    
                                    {{$cart['qty']}}  
                                    <a href="#"  wire:click="decreaseItem('{{$cart['rowId']}}')" class="font-weight-bold text-danger" style="font-size = 18px">-</a>  
                                    <a href="#" wire:click="increaseItem('{{$cart['rowId']}}')" class="font-weight-bold text-succes" style="font-size = 18px">+</a>                                                                
                                    <a href="#" wire:click="removeItem('{{$cart['rowId']}}')" class="font-weight-bold text-danger" style="font-size = 18px" > x</a>
                                </td>
                                    
                                <td>Rp {{number_format($cart['price'],2,',','.')}}</td>
                            </tr>
                        @empty
                        <td colspan="3"><h6 class="text-center">Empty Cart</h6></td>
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="text-danger font-weight-bold">
                    @if (session()->has('error'))
                        {{session('error')}}
                        
                    @endif
                </h6>
                <h4 class="font-weight-bold">Cart Summary </h4>
                <h5 class="font-weight-bold">Sub Total: Rp {{number_format($summary['sub_total'],2,',','.')}}</h5> 
                {{-- <h5 class="font-weight-bold">Tax: {{$summary['pajak']}} </h5>  --}}
                <h5 class="font-weight-bold">Total: Rp {{number_format($summary['total'],2,',','.')}}</h5> 
                {{-- <div>
                    <button wire:click='enableTax' class="btn btn-primary btn-block"> Add Tax</button>
                    <button class="btn btn-danger btn-block">Remove Tax</button>
                </div> --}}
                <div class="mt-4">
                    <button class="btn btn-success active btn-block">Save Transaction</button>
                </div>
            </div>
        </div>
    </div>
 
</div>