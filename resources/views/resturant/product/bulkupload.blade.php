@extends('resturant.layout.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<style>
    .material-icons{
        margin-top:0px !important;
        margin-bottom:0px !important;
    }
    a:hover {
 cursor:pointer;
}

</style>
@section ('content')
<div class="container-fluid">
    
 <div class="row">
<div class="col-lg-12">
@if (session()->has('success'))
<div class="alert alert-success">
@if(is_array(session()->get('success')))
        <ul>
            @foreach (session()->get('success') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
            {{ session()->get('success') }}
        @endif
    </div>
@endif
 @if (count($errors) > 0)
  @if($errors->any())
    <div class="alert alert-danger" role="alert">
      {{$errors->first()}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  @endif
@endif
</div>

<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">{{ __('messages.Products_Upload')}}</h4>
    </div>
    
<div class="container"><br>    
<form class="forms-sample" action="{{route('restaurantimport')}}" method="post" enctype="multipart/form-data">
 {{csrf_field()}}
    <p>{{ __('messages.csv_format')}} <a onclick="showImage();" ><span style="color:blue">{{ __('messages.click_here')}}</span></a></p>
    <div class="col-md-12">
    <img id="loadingImage"  class="img-responsive" src="{{url('assets/img/product.png')}}" style="display:none;    width: 100%;"/>
    </div>
<div class="col-md-12">   
 <input type="file" name="select_file" accept=".csv" class="form-control"/><br>
<button type="submit" class="btn btn-primary" style="width:15%;padding: 3px 0px 3px 0px;"><i class="material-icons"></i>{{ __('messages.Bulk_product_Upload')}}</button>
</div>

</form>
  <a href="productdownload" class="btn btn-large pull-right"><i class="icon-download-alt"> </i>{{ __('messages.Download_CSV')}}</a>

    </div>
    </div>
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">{{ __('messages.Product_Varients_Upload')}}</h4>
    </div>
    
<div class="container"><br>    
<form class="forms-sample" action="{{route('restaurantimport_varients')}}" method="post" enctype="multipart/form-data">
 {{csrf_field()}}
    <p>{{ __('messages.csv_format')}} <a onclick="showImage2();" ><span style="color:blue">{{ __('messages.click_here')}}</span></a></p>
    <div class="col-md-12">
    <img id="loadingImage2"  class="img-responsive" src="{{url('assets/img/variant.png')}}" style="display:none;    width: 100%;"/>
    </div>
<div class="col-md-12">   
 <input type="file" name="select_file" accept=".csv" class="form-control"/><br>
<button type="submit" class="btn btn-primary" style="width:15%;padding: 3px 0px 3px 0px;"><i class="material-icons"></i>{{ __('messages.Bulk_varient_Upload')}}</button>
</div> <br><br>
</form>
  <a href="variantdownload" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> {{ __('messages.Download_CSV')}} </a>

    </div>
    </div>
    </div>
    </div>
    </div>
    <div>
    </div>
   
     
    @endsection
 <script type="text/javascript">

    function showImage(){
        document.getElementById('loadingImage').style.display="block";
    }
    </script>
    <script>
    function executeDownload(url) {
      window.location.href = url;
    }
  </script>
     <script type="text/javascript">

    function showImage2(){
        document.getElementById('loadingImage2').style.display="block";
    }
    
    function onOpen() {
  SpreadsheetApp.getUi()
                .createMenu('csv')
                .addItem('export as csv files', 'dialog')
                .addToUi();
}

function dialog() {
  var html = HtmlService.createHtmlOutputFromFile('download');
  SpreadsheetApp.getUi().showModalDialog(html, 'CSV download dialog');
}

function saveAsCSV() {
    var filename = "product.csv"; // CSV file name
    var folder = ""; // Folder ID

    var csv = "";
    var v = SpreadsheetApp
            .getActiveSpreadsheet()
            .getActiveSheet()
            .getDataRange()
            .getValues();
    v.forEach(function(e) {
      csv += e.join(",") + "\n";
    });
    var url = DriveApp.getFolderById(folder)
              .createFile(filename, csv, MimeType.CSV)
              .getDownloadUrl()
              .replace("?e=download&gd=true","");
    return url;
}
    </script>
</div>