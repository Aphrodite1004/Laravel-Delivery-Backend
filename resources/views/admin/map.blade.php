@extends('admin.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
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
            	<form action="{{route('updatemap')}}" method="post">   
    			{{csrf_field()}}
    			    <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="google_map" class="radio" @if($mset->mapbox == 1) checked @endif><span class="radio"></span>Google Map Key</label>
                    <div class="form-group">
                      
                      <input type="test" class="form-control" value="{{$g->map_api_key}}" id="exampleInputName1" name="api">
                    </div>

    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">On GMap Key</button>
    			</div>
    			</form>
    			
    			<form action="{{route('updatemapbox')}}" method="post">   
    			{{csrf_field()}}
    			<input type="radio" name="colorRadio" 
                       value="mapbox" class="radio" @if($mset->mapbox == 1) checked @endif><span class="radio"></span>MapBox</label>
                    <div class="form-group">
                      
                      <input type="text" class="form-control" value="{{($m->mapbox_api)}}" id="exampleInputName1" name="api">
                    </div>

    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">On Map Box</button>
    			</div>
    			</form>
                                			
                                			
@endsection                                			
                                			