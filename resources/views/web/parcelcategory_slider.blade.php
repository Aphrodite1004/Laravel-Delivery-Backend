<div class="indo_fback">
         <div class="container" >
            <div class="row">
               <div class="owl-carousel owl-theme" id="owl-two"  style="transform: translate3d(0px, 7px, 0px);">
               <?php foreach($category as $cat){ ?>
                  <div class="item shadow sli_back">
                  <a href="{{url('parcelsender')}}/{{$cat->parcel_cat_id}}">
                     <center >
                        <img src="{{ url(''.$cat->cat_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $cat->cat_name }}</p>
                     </center>
                     </a>
                  </div>
                  <?php }?>
            </div>
         </div>
      </div>
   </div>