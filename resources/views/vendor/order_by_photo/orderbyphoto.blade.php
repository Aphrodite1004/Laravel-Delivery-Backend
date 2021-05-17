@extends('vendor.layout.app')
<link rel="stylesheet" href="{{url('assets/fsselect/fstdropdown.css')}}">
<style>
.selecteeee {
    width: 100%;
    height: 450px;
}
.fstdropdown > .fstlist {
    display: none;
    max-height: 430px !important;
    overflow-y: auto;
    overflow-x: hidden;
}
.table .td-actions .btn {
    margin: 0px;
    height: 25px;
    padding: 25px 8px 11px 8px !important;
}
</style>
@section ('content')
 <div class="container-fluid">
          <div class="row">
             <div class="col-lg-12">
                @if (session()->has('success'))
               <div class="alert alert-success">
                @if(is_array(session()->get('success')))
                        <ul>
                            @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @else
                            {{ session()->get('success') }}
                        @endif
                    </div>
                @endif
                 @if (count($errors) > 0)
                  @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      {{$errors->first()}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  @endif
                @endif
                </div> 
            <div class="col-md-5">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Select Products</h4></div>
                  <div class="col-md-12" align="center"><img src="{{url($u->list_photo)}}" style="width:200px !important"></div>
         <form class="forms-sample" action="{{route('listadded_product')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                
                <div class="card-body">
                       <input type="hidden" value="{{$u->ord_id}}" name="pic_id" >
                       <input type="hidden" value="{{$u->user_id}}" name="user_id" >
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Select Products for add to cart</label><br>
                        <select class='fstdropdown-select' style="max-height: 500px;" multiple="multiple" id="eightieth" data-opened="true" name="prod[]">
                          @foreach($products as $product)
                          <option value="{{$product->varient_id}}">{{$product->product_name}}({{$product->quantity}}{{$product->unit}})</option>
                          @endforeach
                        </select>
                  
                        </div>
                      </div>

                    </div>

                    <button type="submit" class="btn btn-primary pull-center">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-7">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">User Cart</h4>
                  <form class="forms-sample" action="{{route('process_orderby', $u->ord_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <button type="submit" class="btn btn-secondary">Process Order</button> 
                    </form>
                 </div>
                     <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th style="width:33.33%">Product Name</th>
                                <th class="text-center" style="width:33.33%">order_qty</th>
                                <th class="text-right" style="width:33.33%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                    @if(count($selected)>0)
                      @php $i=1; @endphp
                      @foreach($selected as $sel)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td><p>{{$sel->product_name}}({{$sel->quantity}} {{$sel->unit}})</p></td>
                        <td align="center"> 
                        <form class="forms-sample" action="{{route('add_qty_to_cart', $sel->l_cid)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="col-md-12">
                          <div class="col-md-8" style="float:left">
                             <div class="form-group">
                              <input type="number" name="stock" class="form-control" value="{{$sel->l_qty}}" >
                            </div>
                          </div>
                          <div class="col-md-4" style="float:left;margin-left: -20px;">
                          <button type="submit" style="border:none;background-color:transparent;float:left;width: 60px !important;height: 40px;border-radius: 50%;"><i class="material-icons">add</i></button>
                            </div>
                            </form>
                        </td>
                        <td class="td-actions text-right">
                           <a href="{{route('delete_product_from_cart', $sel->l_cid)}}" rel="tooltip" class="btn btn-danger">
                                <i class="material-icons">close</i>
                            </a>
                        </td>
                    </tr>
                      @php $i++; @endphp
                             @endforeach
                              @else
                                <tr>
                                  <td>No data found</td>
                                </tr>
                              @endif
                        </tbody>
                    </table>
              
                </div>
              </div>
            </div>
			</div>
          </div>      
@endsection
<script src="{{url('assets/fsselect/fstdropdown.js')}}"></script>
    <script>
        function setDrop() {
            if (!document.getElementById('third').classList.contains("fstdropdown-select"))
                document.getElementById('third').className = 'fstdropdown-select';
            setFstDropdown();
        }
        setFstDropdown();
        function removeDrop() {
            if (document.getElementById('third').classList.contains("fstdropdown-select")) {
                document.getElementById('third').classList.remove('fstdropdown-select');
                document.getElementById("third").fstdropdown.dd.remove();
            }
        }
        function addOptions(add) {
            var select = document.getElementById("fourth");
            for (var i = 0; i < add; i++) {
                var opt = document.createElement("option");
                var o = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                var last = o == undefined ? 1 : Number(o.value) + 1;
                opt.text = opt.value = last;
                select.add(opt);
            }
        }
        function removeOptions(remove) {
            for (var i = 0; i < remove; i++) {
                var last = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                if (last == undefined)
                    break;
                Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0].remove();
            }
        }
        function updateDrop() {
            document.getElementById("fourth").fstdropdown.rebind();
        }
    </script>



