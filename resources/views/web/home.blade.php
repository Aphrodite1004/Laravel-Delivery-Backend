<!DOCTYPE html>
<html>
   <head>
      <title>index</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/4ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.theme.default.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/css/style2.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/css/style3.css') }}">


      <link href="https://fonts.googleapis.com/css?family=Philosopher&display=swap" rel="stylesheet">
   </head>
   <body>
   @include("web.header")
   @include("web.category_slider")

      <div class="container" >
         <div class="row">
            <div class="owl-carousel owl-theme" id="owl-three"  style="transform: translate3d(0px, 7px, 0px);">
            <?php foreach($services as $service){ ?>

               <div class="item">
                  <center >
                     <img src="{{ url(''.$service->category_image)}}" class="secimg_ban shadow">
                  </center>
               </div>
               <?php }?>
               <?php foreach($services as $service){ ?>
                  <div class="item">
                     <center >
                        <img src="{{ url(''.$service->category_image)}}" class="secimg_ban shadow">
                     </center>
                  </div>
                  <?php }?>
            </div>
         </div>
      </div>
      <div class="indo_trendback">
         <div class="container" >
            <p class="indo_trendp">Trending this week <a href="" class="indo_trendval">View all <i class="fas fa-angle-double-right"></i></a></p>
            <div class="row">
               <div class="owl-carousel owl-theme" id="owl-four"  style="transform: translate3d(0px, 7px, 0px);">
                  <div class="item">
                     <div class="card four_card2" style="width: 100%;">
                        <div style="position: relative;">
                           <img src="{{ url('frontassets/image/f1.jpg') }}" class="fourimg_ban shadow">
                           <div class="top-left">Promoted</div>
                           <div class="top-right"><i class="far fa-heart"></i></div>
                           <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                        </div>
                        <div class="card-body">
                           <p style="color: black">lorem ipsum dummy lorel</p>
                           <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                           <p class="index_para2to"><span><i class="far fa-clock"></i> 30-35 min <span style="float: right;"><i class="fas fa-rupee-sign"></i> 250 FOR TWO</span></span></p>
                           <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="card four_card2" style="width: 100%;">
                        <div style="position: relative;">
                           <img src="{{ url('frontassets/image/f2.jpg') }}" class="fourimg_ban shadow">
                           <div class="top-left">Promoted</div>
                           <div class="top-right"><i class="far fa-heart"></i></div>
                           <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                        </div>
                        <div class="card-body">
                           <p style="color: black">lorem ipsum dummy lorel</p>
                           <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                           <p class="index_para2to"><span><i class="far fa-clock"></i> 30-35 min <span style="float: right;"><i class="fas fa-rupee-sign"></i> 250 FOR TWO</span></span></p>
                           <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="card four_card2" style="width: 100%;">
                        <div style="position: relative;">
                           <img src="{{ url('frontassets/image/f3.jpg') }}" class="fourimg_ban shadow">
                           <div class="top-left">Promoted</div>
                           <div class="top-right"><i class="far fa-heart"></i></div>
                           <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                        </div>
                        <div class="card-body">
                           <p style="color: black">lorem ipsum dummy lorel</p>
                           <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                           <p class="index_para2to"><span><i class="far fa-clock"></i> 30-35 min <span style="float: right;"><i class="fas fa-rupee-sign"></i> 250 FOR TWO</span></span></p>
                           <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <div class="card four_card2" style="width: 100%;">
                        <div style="position: relative;">
                           <img src="{{ url('frontassets/image/f1.jpg') }}" class="fourimg_ban shadow">
                           <div class="top-left">Promoted</div>
                           <div class="top-right"><i class="far fa-heart"></i></div>
                           <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                        </div>
                        <div class="card-body">
                           <p style="color: black">lorem ipsum dummy lorel</p>
                           <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                           <p class="index_para2to"><span><i class="far fa-clock"></i> 30-35 min <span style="float: right;"><i class="fas fa-rupee-sign"></i> 250 FOR TWO</span></span></p>
                           <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid most_popindo">
            <p class="most_popara">Most popular <a href="" class="indo_trendval">26 places <i class="fas fa-angle-double-right"></i></a></p>
            <div class="row">
               <div class="col-sm-3">
                  <div class="card four_card2">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f1.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f2.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f3.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f1.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f1.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f2.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f3.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="card four_card2" style="width: 100%;">
                     <div style="position: relative;">
                        <img src="{{ url('frontassets/image/f1.jpg') }}" class="fiveimg_ban shadow">
                        <div class="top-left">Promoted</div>
                        <div class="top-right"><i class="far fa-heart"></i></div>
                        <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                     </div>
                     <div class="card-body">
                        <p style="color: black">lorem ipsum dummy lorel</p>
                        <p class="index_parae23">lorem - ipsum - dummy - lorel</p>
                        <p style="margin-top: -10px;">
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92"><i class="fas fa-star"></i></span>
                           <span class="shadow haed_star92" style="background-color: black"><i class="fas fa-star"></i></span>
                        </p>
                        <p style="font-size: 13px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid most_popindo">
            <p class="mostsalpara">Most sales <a href="" class="indo_trendval">26 places <i class="fas fa-angle-double-right"></i></a></p>
            <div class="row">
               <div class="col-sm-4" style="margin-bottom: 20px;">
                  <div class="card shadow">
                     <div class="row no-gutters">
                        <div class="col-sm-5">
                           <div style="position: relative;">
                              <img src="{{ url('frontassets/image/f1.jpg') }}" class="siximg_ban">
                              <div class="top-left">Promoted</div>
                              <div class="top-right"><i class="far fa-heart"></i></div>
                              <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="card-body">
                              <p class="mostsl_p1">lorem ipsum dummy </p>
                              <p class="mostsl_p2">lorem - ipsum - dummy </p>
                              <p class="mostsl_p3"><span><i class="far fa-clock"></i> 30-35 min </p>
                              <p style="font-size: 12px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4" style="margin-bottom: 20px;">
                  <div class="card shadow">
                     <div class="row no-gutters">
                        <div class="col-sm-5">
                           <div style="position: relative;">
                              <img src="{{ url('frontassets/image/f2.jpg') }}" class="siximg_ban">
                              <div class="top-left">Promoted</div>
                              <div class="top-right"><i class="far fa-heart"></i></div>
                              <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="card-body">
                              <p class="mostsl_p1">lorem ipsum dummy </p>
                              <p class="mostsl_p2">lorem - ipsum - dummy </p>
                              <p class="mostsl_p3"><span><i class="far fa-clock"></i> 30-35 min </p>
                              <p style="font-size: 12px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4" style="margin-bottom: 20px;">
                  <div class="card shadow">
                     <div class="row no-gutters">
                        <div class="col-sm-5">
                           <div style="position: relative;">
                              <img src="{{ url('frontassets/image/f3.jpg') }}" class="siximg_ban">
                              <div class="top-left">Promoted</div>
                              <div class="top-right"><i class="far fa-heart"></i></div>
                              <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="card-body">
                              <p class="mostsl_p1">lorem ipsum dummy </p>
                              <p class="mostsl_p2">lorem - ipsum - dummy </p>
                              <p class="mostsl_p3"><span><i class="far fa-clock"></i> 30-35 min </p>
                              <p style="font-size: 12px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-sm-4" style="margin-bottom: 20px;">
                  <div class="card shadow">
                     <div class="row no-gutters">
                        <div class="col-sm-5">
                           <div style="position: relative;">
                              <img src="{{ url('frontassets/image/f3.jpg') }}" class="siximg_ban">
                              <div class="top-left">Promoted</div>
                              <div class="top-right"><i class="far fa-heart"></i></div>
                              <div class="bottom-right"><i class="far fa-star"></i> 3.1 (330+)</div>
                           </div>
                        </div>
                        <div class="col-sm-7">
                           <div class="card-body">
                              <p class="mostsl_p1">lorem ipsum dummy </p>
                              <p class="mostsl_p2">lorem - ipsum - dummy </p>
                              <p class="mostsl_p3"><span><i class="far fa-clock"></i> 30-35 min </p>
                              <p style="font-size: 12px;margin-bottom: -2px;"><span class="card_offer">OFFER</span> 65% off</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include("web.footer")

   </body>
</html>
<script type="text/javascript">
   var a = 0;
   $(window).scroll(function() {
   
   var oTop = $('#counter').offset().top - window.innerHeight;
   if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },
   
        {
   
          duration: 3000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }
   
        });
    });
    a = 1;
   }
   
   });
</script>
<script src="{{ url('frontassets/owlcarousel/owl.carousel.min.js') }}"></script>
<script>
   $(document).ready(function(){
     $('#owl-two').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:8
           }
       }
   })
    $( "#owl-two .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:5px;" >');
      $( "#owl-two .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:5px;" >');  
   });
   
   
</script>
<script>
   $(document).ready(function(){
     $('#owl-three').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:4          
                }
       }
   })
    $( "#owl-three .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:115px;" >');
      $( "#owl-three .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:115px;" >');  
   });
   
   
</script>
<script>
   $(document).ready(function(){
     $('#owl-four').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:3          
                }
       }
   })
    $( "#owl-four .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:145px;" >');
      $( "#owl-four .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.PNG') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:145px;" >');  
   });
   
   
</script>