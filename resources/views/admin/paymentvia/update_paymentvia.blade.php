@extends('admin.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Payment_method')}}</h4>
                  @if (count($errors) > 0)
                      @if($errors->any())
                        <div class="alert alert-primary" role="alert">
                          {{$errors->first()}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                      @endif
                  @endif
                  <form class="forms-sample" action="{{route('adminUpdatepaymentvia', [$paymentvia->paymentvia_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Payment_method')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="payment_mode" value="{{$paymentvia->payment_mode}}">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.API key')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="payment_key" value="{{$paymentvia->payment_key}}">
                    </div>
                     <div class="form-group">
                      <label>Status</label></label>
                      <input type="checkbox" name="status" value="1" <?php if($paymentvia->status==1){?> checked <?php } ?> ><br>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.submit')}}</button>
                    <a href="{{route('paymentvia')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-2">
		  </div>
     
          </div>
        </div>
</div>
 @endsection