@extends('admin.layout.app')

@section ('content')
<div class="row">
  
<div class="col-md-3"></div>
		 <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add User</h4>
                  <!-- <p class="card-description">
                    Basic form elements
                  </p> -->
                  <form class="forms-sample" action="{{route('AddUserNew')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                     @if (count($errors) > 0)
                    @if($errors->any())
                   <div class="alert alert-primary" role="alert">
                  <strong>SUCCESS : </strong>{{$errors->first()}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>
                  @endif
                 @endif
                  
                    <div class="form-group">
                      <label for="exampleInputName1">User Name</label>
                      <input type="text" class="form-control" name="user_name"  id="exampleInputName1" placeholder="User Name">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">User Phone</label>
                      <input type="text" class="form-control" name="user_phone"  id="exampleInputName1" placeholder="User Phone">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">User email</label>
                      <input type="text" class="form-control" name="user_email"  id="exampleInputName1" placeholder="User email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">User Wallet</label>
                      <input type="text" class="form-control" name="user_wallet"  id="exampleInputName1" placeholder="User wallet">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Rewards</label>
                      <input type="text" class="form-control" name="user_reward"  id="exampleInputName1" placeholder="Add rewards">
                    </div>

                    
                  
                    <button type="submit" class="btn btn-success mr-2">Add</button>
                   
                  </form>
                </div>
              </div>
            </div>
  <div class="col-md-3"></div>

</div>
</div>
@endsection