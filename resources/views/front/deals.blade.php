@extends('front.layout.app')
@include('front.layout.header')
@section ('content')
  
      
      <section id="page" class="container">
        <!--/.frame -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 clearfix">
                <div class="hr-link">
                    <h2>Coupons</h2>
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
                 @if(count($coupon)==0)
                <h4 align="center">No Coupons available</h4>
                @endif
              </div>
            </div>
            <div class="row">
                 @foreach($coupon as $coupon)
              <div class="col-sm-4">
                <div class="deal-entry  green">
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($coupon->coupon_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                  </div>
                  <!-- /.image -->
                     <div class="title">
                    <marquee><p>{{$coupon->description}}</p></marquee>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>discount:</b>{{$coupon->coupon_discount}}</p>
                      <p><b>min purchase value:</b>rs. {{$coupon->cart_value}}</p>
                       <p><b>coupon price:</b>${{$coupon->price}}</p>
                      
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                     
                      <li class="info_link col-sm-5 col-xs-6 col-lg-4">
                        <a href="{{route('buycoupon',[$coupon->coupon_id])}}" class="btn btn-block btn-default btn-raised btn-sm">
                          Buy Coupon
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
    
          <!-- /main row -->
        </div>
    <hr>
      <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 clearfix">
                <div class="hr-link">
                    
                    <h2>Store Offers</h2>
                
                </div>
                @if(count($offer)==0)
                <h4 align="center">no offers available</h4>
                @endif
              </div>
            </div>
            <div class="row">
                 @foreach($offer as $offer)
              <div class="col-sm-4">
                <div class="deal-entry  green">
                  <!--<div class="offer-discount">-->
                  <!--  -81%-->
                  <!--</div>-->
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($offer->offer_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                    
                  </div>
                  <!-- /.image -->
                     <div class="title">
                    <a href="#" target="_blank" title="ATLETIKA 3 mēnešu abonements">
                      {{$offer->offer_name}}
                    </a>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>discount:</b>{{$offer->offer_discount}}</p>
                    
                      <p>{{$offer->discription}}</p>
                    </div>
                    
                  </div>
                </div>
              </div>@endforeach
         
            </div>
            <!--/row -->
            
          </div>
          <!-- /col 8 -->
    
          <!-- /main row -->
        </div>   
        
        
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
      <!-- /.CTA -->
      
  <!-- /animitsion -->
@endsection