@extends('front.layout.app')
@include('front.layout.header')
@section ('content')
   <style>
       .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.item{
    border:2px solid grey; 
    border-radius:12px;
    margin-right:10px;
}
body { font-family:'Open Sans Semibold';}
h2 { margin:30px auto;}

#mixedSlider {
  position: relative;
}
#mixedSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 5%;
}
#mixedSlider .MS-content .item {
  display: inline-block;
  width: 47.3333%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  white-space: normal;
  padding: 0 10px;
}
@media (max-width: 991px) {
  #mixedSlider .MS-content .item {
    width: 50%;
  }
}
@media (max-width: 767px) {
  #mixedSlider .MS-content .item {
    width: 100%;
  }
}
#mixedSlider .MS-content .item .imgTitle {
  position: relative;
}
#mixedSlider .MS-content .item .imgTitle .blogTitle {
  margin: 0;
  text-align: left;
  letter-spacing: 2px;
  color: #252525;
  font-style: italic;
  position: absolute;
  background-color: rgba(255, 255, 255, 0.5);
  width: 100%;
  bottom: 0;
  font-weight: bold;
  padding: 0 0 2px 10px;
}
#mixedSlider .MS-content .item .imgTitle img {
  height: auto;
  width: 100%;
}
#mixedSlider .MS-content .item p {
  font-size: 16px;
  margin: 2px 10px 0 5px;
  text-indent: 15px;
}
#mixedSlider .MS-content .item a {
  float: right;
  margin: 0 20px 0 0;
  font-size: 16px;
  font-style: italic;
  color: rgba(173, 0, 0, 0.82);
  font-weight: bold;
  letter-spacing: 1px;
  transition: linear 0.1s;
}
#mixedSlider .MS-content .item a:hover {
  text-shadow: 0 0 1px grey;
}
#mixedSlider .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 50px;
  top: 95px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}
@media (max-width: 992px) {
  #mixedSlider .MS-controls button {
    font-size: 30px;
  }
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls button {
    font-size: 20px;
  }
}
#mixedSlider .MS-controls .MS-left {
  left: 0px;
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls .MS-left {
    left: -10px;
  }
}
#mixedSlider .MS-controls .MS-right {
  right: 0px;
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls .MS-right {
    right: -10px;
  }
}
.MS-left    {
    border:2px solid grey;
    margin-top: -46px;
    margin-left: 208px;
    }
.MS-right    {
    margin-top: -46px;
    }
h1,h2,h3,h4,p,b{
    font-family: sans-serif;
}
i.fa {
  display: inline-block;
  padding: 0.5px 0.6px;

}


</style>
      <!-- /.search form -->
      
      
      <div class="slider">
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
        <div class="container">
            <div class="row">
    @foreach($category as $category)
    <div class="col-lg-1 col-sm-3" style="margin: 13px;float:left">
       <a href="{{route('mainstore',[$category->category_id])}}"><img src="{{url($category->category_image)}}" style="width:50px;height: 55px;"> </a>
    </div>
    @endforeach</div>
          <div class="row">
            <div id="grid-slider" class="flexslider">
              <ul class="slides">
                  @foreach($banner1 as $banner1)
                <li class="flex-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                 <img src="{{url($banner1->banner_image)}}">
                </li>
                    @endforeach
              </ul>
            <!--<ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="ti-angle-left"></i></a></li><li class="flex-nav-next"><a class="flex-next" href="#"><i class="ti-angle-right"></i></a></li></ul></div>-->
          </div>
        </div>
      </div>
      
      <!-- /slider -->
      
      
      <section id="page" class="container">
          
        <div class="shadow bg-white mTop-30 frameLR">
          <div class="row">
              
            <div class="col-md-3 col-sm-4">
                <img src="https://thecodecafe.in/gonearby/background_images/extrasavings.png" style="margin-left: -30px;height: 180px;">
              <div class="centered"><h1><b>extra</b></h1><h2 style="line-height: 0; text-align: center;">Savings</h2><br></div>
            </div>
            <div id="mixedSlider">
                    <div class="MS-content">
                        @foreach ($offers as $offers)
                        <div class="item" style="border:2px solid grey; border-radius:12px;">
                            <h3 style="text-transform: capitalize;">{{$offers->store_name}}</h3>
                            <h4 style="text-transform: Uppercase;">{{$offers->offer_name}}</h4>
                            <div style="width:100%;">
                             <img src="{{url($offers->offer_image)}}" style="width:50px;float:right">
                             </div><br>
                           <h4 style="width:100%;">{{$offers->discription}}</h4>
                            <hr>
                            <p style="float:left;font-size:9px;margin-bottom: 7px;margin-top: -10px;margin-left: -17px !important;"><b>valid thru:</b>{{$offers->begin_date}}-{{$offers->end_date}}</p>
                        </div>@endforeach
                    </div>
                    <div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                </div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="{{url('public/frontjs/multislider.js')}}"></script> 
<script src="{{url('public/frontjs/multislider.min.js')}}"></script>

<script>
		$('#mixedSlider').multislider({
			duration: 750,
			interval: 3000
		});
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
          </div>
          <!--/.row -->
        </div>
        
        <div class="row">
          <div class="col-sm-12">
         <div class="row">
              <div class="col-sm-12 clearfix">
                  
                  <hr>
                  
                <div class="hr-link">
                    <h2>Popular right now</h2>
                  <hr class="mBtm-50 mTop-30" data-symbol="FEATURED DEALS">
                 
                </div>
              </div>
            </div>
                  <div class="row">
                      
                 @foreach($popular as $popular)
              <div class="col-sm-4 popular" style="height: 446;">
                <div class="deal-entry  green">
                    
                  <div class="offer-discount">
                    <a href="{{route('insertfav',[$popular->store_id])}}"><i class="fa fa-heart" style="border:none !important;font-size: 29px;color:red !important"></i></a>
                  </div>
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($popular->store_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                    <!--<span class="bought">-->
                    <!--  <i class="ti-star">-->
                    <!--  </i>-->
                    <!--  {{$popular->avg}}-->
                    <!--</span>-->
                  </div>
                  <!-- /.image -->
                  <div class="title">
                    <a href="#" target="_blank" title="ATLETIKA 3 mēnešu abonements">
                      {{$popular->store_name}}
                    </a>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>address:</b>{{$popular->address}}</p>
                      <p><b>services:</b>{{$popular->services}}</p>
                      <p><b>contact:</b>{{$popular->phone}}</p>
                    <p><b>Facebook_link:</b><span style="color:blue">{{$popular->facebook_link}}</span></p>
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                      <li class="info_link col-sm-5 col-xs-6 col-lg-4">
                        <a href="{{route('maindeals',[$popular->store_id])}}" class="btn btn-block btn-default btn-raised btn-sm">
                          View Deal
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
        <!--/.frame -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 clearfix">
                  <hr>
                <div class="hr-link">
                    <h2>Trending right now</h2>
                  <hr class="mBtm-50 mTop-30" data-symbol="FEATURED DEALS">
                
                </div>
              </div>
            </div>
            <div class="row">
                 @foreach($trend as $trending)
              <div class="col-sm-4"  style="height: 446;">
                <div class="deal-entry  green">
                   <div class="offer-discount">
                    <a href="{{route('insertfav',[$trending->store_id])}}"><i class="fa fa-heart" style="border:none !important;font-size: 29px;color:red !important"></i></a>
                  </div>
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($trending->store_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                    <!--<span class="bought">-->
                    <!--  <i class="ti-tag">-->
                    <!--  </i>-->
                    <!--  19-->
                    <!--</span>-->
                  </div>
                  <!-- /.image -->
                     <div class="title">
                    <a href="#" target="_blank" title="ATLETIKA 3 mēnešu abonements">
                      {{$trending->store_name}}
                    </a>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>address:</b>{{$trending->address}}</p>
                      <p><b>services:</b>{{$trending->services}}</p>
                      <p><b>contact:</b>{{$trending->phone}}</p>
                    <p><b>Facebook_link:</b><span style="color:blue">{{$trending->facebook_link}}</span></p>
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                     
                      <li class="info_link col-sm-5 col-xs-6 col-lg-4">
                        <a href="{{route('maindeals',[$trending->store_id])}}" class="btn btn-block btn-default btn-raised btn-sm">
                          View Deal
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