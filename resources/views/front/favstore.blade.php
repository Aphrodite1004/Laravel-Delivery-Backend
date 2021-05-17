@extends('front.layout.app')
@include('front.layout.header')
@section ('content')
 <style>

 
  </style>
      <section id="page" class="container">
            
              
        <!--/.frame -->
             <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 clearfix">
                  <hr>
                <div class="hr-link">
                    <h2>Favourite Stores</h2>
                  <hr class="mBtm-50 mTop-30" data-symbol="FEATURED DEALS">
                
                </div>
                 @if (count($errors) > 0)
                                @if($errors->any())
                                  <div class="alert alert-primary" style="border: 1px solid red !important; background-color: #ff00006b;" role="alert">
                                    <strong>Alert : </strong>{{$errors->first()}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                @endif
                              @endif
              </div>
            </div>
            <div class="row">
                 @foreach($favourite as $stores)
              <div class="col-sm-4">
                <div class="deal-entry  green">
                  <div class="offer-discount">
                    <a href="{{route('removefav',[$stores->store_id])}}"><i class="fa fa-close" style="border:none !important;font-size: 29px;"></i></a>
                  </div>
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($stores->store_image)}}" alt="#" class="img-responsive" style="height: 183px !important;width: 100% !important;">
                    </a>
                    <span class="bought">
                      <i class="ti-tag">
                      </i>
                      19
                    </span>
                  </div>
                  <!-- /.image -->
                     <div class="title">
                    <a href="#" target="_blank" title="ATLETIKA 3 mēnešu abonements">
                      {{$stores->store_name}}
                    </a>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>address:</b>{{$stores->address}}</p>
                      <p><b>services:</b>{{$stores->services}}</p>
                      <p><b>contact:</b>{{$stores->phone}}</p>
                    <p><b>Facebook_link:</b><span style="color:blue">{{$stores->facebook_link}}</span></p>
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                     
                      <li class="info_link col-sm-5 col-xs-6 col-lg-4">
                        <a href="{{route('maindeals',[$stores->store_id])}}" class="btn btn-block btn-default btn-raised btn-sm">
                          view deals
                        </a>
                      </li>
                    </ul>
                  </footer>
                </div>
              </div>@endforeach
         
            </div>
            <!--/row -->
            
          </div>
          <!-- /col 8 -->
    
            </div>
            <!--/row -->
      </section>
      <!-- /#page ends -->
      <div class="cta-box bg-blue-1 clearfix">
        <div class="container">
          <div class="row">
            <h3>Amazing offers available on gonearby</h3> 

    <p>gonearby.com helps you discover the best things to do, eat and buy – wherever you are! Make every day awesome with nearbuy.com. Dine at the finest restaurants, relax at the best spas, pamper yourself with exciting wellness and shopping offers or just explore your city intimately… you will always find a lot more to do with nearbuy.com. From tattoo parlors to music concerts, movie tickets to theme parks, everything you want is now within reach. Don't stop yet! Take it wherever you go with the nearbuy.com mobile app. Based on your location and preference, our smart search engine will suggest new things to explore every time you open the app. What's more, with offers on everything around you... you are sure to try something new every time.</p>

          </div>
        </div>
      </div>
 @endsection 