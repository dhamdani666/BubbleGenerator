@extends('bubblelayouts.template')
@section('content')

<div class="container">
  <button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>

<h4>CRUD New Table</h4>
                        <hr>
                        <div id="imageloading" style="display: none;">
  <center><img src="{{URL('bubbleassets/img/loading.gif')}}" style="width:10%;"></center>
</div>
<div id="response" style="display: none;"></div>
  <form id="formcrudtable" accept-charset="utf-8">
                 <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="target" name="target" value="newtable">
                  <input type="hidden" id="namemigration" name="namemigration" value="">     
<input type="text" id="namatable_newtable" name="namatable_newtable" value="" class="form-control" placeholder="Masukan Nama Table Disini">
<p></p>
              <div id="errorpointer" >
              <div class="row">
  <div class="col-lg-6">
    <div class="input-group">
    
      <span class="input-group-addon">
     <input type="radio" aria-label="..." name="checkboxroutes_newtable" checked="" value="Resource">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Resource">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..." name="checkboxroutes_newtable" value="Manual">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Manual">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
         <p></p>
               <div class="row">
  <div class="col-lg-2">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..." name="checkboxtable_newtable" checked="">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Datatables">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
    <div class="col-lg-2">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" aria-label="..." name="checkboxmigration_newtable" checked="">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Migration">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
      <div class="col-lg-2">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" aria-label="..." name="checkboxsoftdelete_newtable" checked="">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Soft Delete">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
        <div class="col-lg-2">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" aria-label="..." name="checkboxtimestamp_newtable" checked="">
      </span>
      <input type="text" class="form-control" aria-label="..." readonly="" value="Timestamp ? ">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
  <br>
<div class="row">
  <div class="col-md-6">
<label>Ubah Nama Model</label>
<input type="text" id="namamodel_newtable" name="namamodel_newtable" value="" class="form-control">
<p></p>

<label>Ubah Nama Validasi</label>
<input type="text" id="namavalidasi_newtable" name="namavalidasi_newtable" value="" class="form-control">
  </div>

<div class="col-md-6">
<label>Ubah Nama Controller</label>
<input type="text" id="namacontroller_newtable" name="namacontroller_newtable" value="" class="form-control">
<p></p>
<label>Ubah Nama View</label>
<input type="text" id="namaview_newtable" name="namaview_newtable" value="" class="form-control">
</div>



</div>
<p></p>
<label>Validasi Field Or Table</label>
<p></p>
<label>Field Table <i id=""></i></label>
<input type="hidden" name="ai_newtable" id="ai_newtable">
<input type="hidden" name="pk_newtable" id="pk_newtable">
<input type="hidden" name="uuid_newtable" id="uuid_newtable">
<div id="optionnewfield">
  

<div id="newfield">
<div class="row">
<div class="col-md-2">
    <input type="text" name="namafield_newtable[]" value="" class="form-control" placeholder="Masukan Nama Field">
</div>
<div class="col-md-2">
  <select name="typefield_newtable[]" id="typefield_newtable" class="form-control">
  <option value="string">DB Type</option>
       <option value="string">Varchar</option>
    <option value="integer">Integer</option>
        <option value="enum">Enum</option>
        <option value="text">Text</option>
    <option value="time">Date</option>
    <option value="timestamp">Date Time</option>
  </select>
</div>
<div class="col-md-1">
  <input type="text" name="lengthfield_newtable[]" value="" class="form-control" placeholder="255">
</div>
<div class="col-md-2">
  <input type="text" name="validasifield_newtable[]" class="form-control" value="required" placeholder="required,email,min:6,max:10">
</div>
<div class="col-md-2">
  <select name="htmltype_newtable[]" class="form-control">
    <option value="">Html Type</option>
     <option value="text">Text</option>
     <option value="email">Email</option>
     <option value="password">Password</option>
      <option value="textarea">TextArea</option>
      <option value="file">File</option>
      <option value="select">Select</option>
      <option value="date">Date</option>
    <option value="checkbox">CheckBox</option>
    <option value="radio">Radio</option>
  </select>
</div>
<div class="col-md-3">

  <input type="radio" name="primaryfield_newtable[]" id="primaryfield_newtable" checked="" > Primary
    <input type="radio" name="autoincrementsfield_newtable[]" id="autoincrementsfield_newtable" checked=""  > Auto Increments
         <input type="checkbox" name="uuidfield_newtable[]"  id="uuidfield_newtable" > UUID

</div>
  
</div>
</div>
</div>
<p></p>
<button type="button" id="tambahfield" class="btn btn-default">Tambah Field</button>
<p></p>
<button type="button" class="form-control" id="prosescrudtable" value="newtable">CRUD </button>
<p></p>
</div>
</div>
</form>
@stop