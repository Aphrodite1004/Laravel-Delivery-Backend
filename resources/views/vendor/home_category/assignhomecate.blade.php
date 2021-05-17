@extends('vendor.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
            
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assign Home Category</h4>
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
                  <form class="forms-sample" action="{{route('inserthomecategory')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label>Home Category</label>
                     
                      <div class="input-group col-xs-12">
                      <input type="text" name="homecate_name" value="{{ $homecat->homecat_name }}" class="form-control"  required readonly>
                      <input type="hidden" name="homecat_id" value="{{$homecat->homecat_id }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">All Category</label>
                      <!--<input type="text" class="form-control" id="exampleInputName1" name="category_name" placeholder="category name" value="" required>-->
                      <select name="selectedcat[]" class="form-control" multiple>
                            <?php foreach($cityadminCategory as $category){ ?>
                                <option value="<?= $category->category_id ?>" <?php if (in_array($category->category_id, $aci)){ echo "style='background: #eaecf4;' disabled"; } ?> ><?= $category->category_name ?>
                                </option>
                            <?php }?>
                          
                      </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th align="center">Category Name</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th align="center">Category Name</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($assigned_categoroy_list)>0)
          @php $i=1; @endphp
          @foreach($assigned_categoroy_list as $HomeCategory)
        <tr>
            <td>{{$i}}</td>
            <td>{{$HomeCategory->category_name}}</td>
            <td>
              <a href="{{route('deletehomecategory', [$HomeCategory->assign_id])}}" class="btn btn-danger">Delete</a>
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
        </div>
</div>
 @endsection