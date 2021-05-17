@extends('front.layout.app')
@include('front.layout.header')
@section ('content')
   
      
      <section id="page" class="container">
        <!--/.frame -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 clearfix">
                  <hr>
                <div class="hr-link">
                    <h2>My Coupons</h2>
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
            </div>
            <div class="row">
                 @foreach($coupon as $coupon)
              <div class="col-sm-4">
                <div class="deal-entry  green">
                  <!--<div class="offer-discount">-->
                  <!--  -81%-->
                  <!--</div>-->
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($coupon->coupon_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                   
                  </div>
                  <!-- /.image -->
                     <div class="title">
                         <input type="text" value="{{$coupon->coupon_code}}" id="myInput{{$coupon->coupon_id}}" style="border: none; width: 49%;">


                        <button class="btn btn-raised ripple-effect btn-success btn-block" onclick="myFunction{{$coupon->coupon_id}}()">Copy code</button>
                    <h3 >
                      <script>
                          function myFunction{{$coupon->coupon_id}}() {
                              /* Get the text field */
                              var copyText = document.getElementById("myInput"+{{$coupon->coupon_id}});
                            
                              /* Select the text field */
                              copyText.select();
                            
                              /* Copy the text inside the text field */
                              document.execCommand("copy");
                            
                              /* Alert the copied text */
                              alert("Copied the text: " + copyText.value);
                            }

                      </script>
                    </h3>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>discount:</b>{{$coupon->coupon_discount}}</p>
                     <p>{{$coupon->description}}</p>
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                        <h4><b style="color:blue !important">store name: </b></h4>
                     <h4 align="center"><b>{{$coupon->store_name}}</b></h4>
                     
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