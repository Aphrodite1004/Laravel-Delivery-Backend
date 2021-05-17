<div class="indo_fback">
         <div class="container" >
            <div class="row">
               <div class="owl-carousel owl-theme" id="owl-two"  style="transform: translate3d(0px, 7px, 0px);">
               <?php foreach($services as $service){ ?>
                  <div class="item shadow sli_back">
                     <center >
                        <img src="{{ url(''.$service->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $service->category_name }}</p>
                     </center>
                  </div>
                  <?php }?>
                  <?php foreach($services as $service){ ?>
                  <div class="item shadow sli_back">
                     <center >
                        <img src="{{ url(''.$service->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $service->category_name }}</p>
                     </center>
                  </div>
                  <?php }?>
                  <?php foreach($services as $service){ ?>
                  <div class="item shadow sli_back">
                     <center >
                        <img src="{{ url(''.$service->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $service->category_name }}</p>
                     </center>
                  </div>
                  <?php }?>     
               </div>
            </div>
         </div>
      </div>