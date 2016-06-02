@extends('bubblegenerator::layouts.template')
@section('content')
<div class="container">
  <button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>

        <h4>CRUD By Table</h4>
                        <hr>
<div id="imageloading" style="display: none;">
  <center><img src="{{URL('img/loading.gif')}}" style="width:10%;"></center>
</div>
<div id="response" style="display: none;"></div>

  


                        <form id="formcrudtable" accept-charset="utf-8">
                 <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="target" name="target" value="table">     
                <select id="namatable_table" name="namatable_table" class="form-control">
                <option value="">Pilih Table Terlebih Dahulu</option>
                
                @foreach($tables as $table)
                 @foreach ($table as $key => $value)
                 @if($value!="migrations")
 <option value="{{$value}}">{{$value}}</option>
                 @endif

                 @endforeach
                   
                 @endforeach
                </select>
                <br>

                <div id="errorpointer" >
<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
    
      <span class="input-group-addon">
     <input type="radio" aria-label="..." name="checkboxroutes_table" checked="" value="Resource">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Resource">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..." name="checkboxroutes_table" value="Manual">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Manual">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
                <br>
               <div class="row">
  <div class="col-lg-2">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..." name="checkboxtable_table" checked="" value="TDatatables">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Datatables">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<p></p>
<div class="row">
  <div class="col-md-6">
<label>Ubah Nama Model</label>
<input type="text" id="namamodel_table" name="namamodel_table" value="" class="form-control">
<p></p>

<label>Ubah Nama Validasi</label>
<input type="text" id="namavalidasi_table" name="namavalidasi_table" value="" class="form-control">
  </div>

<div class="col-md-6">
<label>Ubah Nama Controller</label>
<input type="text" id="namacontroller_table" name="namacontroller_table" value="" class="form-control">
<p></p>
<label>Ubah Nama View</label>
<input type="text" id="namaview_table" name="namaview_table" value="" class="form-control">
</div>


</div>
<p></p>
<label>Validasi Field Or Table</label>
 <p></p>
<div id="fieldvalidasi">

</div>
<p></p>
 </form>
<button type="button" class="form-control" id="prosescrudtable">CRUD</button>
</div>
</div>
@stop
