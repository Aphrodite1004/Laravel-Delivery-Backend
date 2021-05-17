<div class="indo_fback">
         <div class="container" >
            <div class="row">
               <div class="owl-carousel owl-theme" id="owl-two"  style="transform: translate3d(0px, 7px, 0px);">
               <?php foreach($category as $cat){ ?>
                  <div class="item shadow sli_back">
                  <a href="{{url('groceryproduct')}}/{{$cat->category_id}}">
                     <center >
                        <img src="{{ url(''.$cat->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $cat->category_name }}</p>
                     </center>
                     </a>
                  </div>
                  <?php }?>
       
                  <?php foreach($category as $cat){ ?>
                  <div class="item shadow sli_back">
                  <a href="{{url('groceryproduct')}}/{{$cat->category_id}}">
                     <center >
                        <img src="{{ url(''.$cat->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $cat->category_name }}</p>
                     </center>
                     </a>
                  </div>
                  <?php }?>    
                  <?php foreach($category as $cat){ ?>
                  <div class="item shadow sli_back">
                  <a href="{{url('groceryproduct')}}/{{$cat->category_id}}">
                     <center >
                        <img src="{{ url(''.$cat->category_image)}}" class="sli_imag">
                        <p class="sli_p">{{ $cat->category_name }}</p>
                     </center>
                     </a>
                  </div>
                  <?php }?>    
               </div>
            </div>
         </div>
      </div>