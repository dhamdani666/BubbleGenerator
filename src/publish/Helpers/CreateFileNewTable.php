<?php 

namespace App\Helpers;
use DB;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
/**
* 
*/
class CreateFileNewTable
{
  

    public static function CreateMigration($namatable='',$namamigration='',$checkboxmigration='',$checkboxsoftdelete='',$checkboxtimestamp='',$validasinamafield='',$validasidbtype='',$validasilength='',$validasifield='',$ai='')
{

$MigrationName = "".base_path()."/database/migrations/".str_replace(" ","_",str_replace("-","_",str_replace(":", "", Carbon::now())))."_".ucfirst($namamigration).".php";

if (!file_exists($MigrationName)) {


if (Schema::hasTable($namatable))
{
 echo 'Maaf Table Sudah Ada';
}else{



$newFileContent ='
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class '.ucfirst($namamigration).' extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("'.$namatable.'", function (Blueprint $table) {
          ';

for($i=0; $i<count($validasinamafield); $i++){

  if($validasilength[$i]=="" or $validasilength[$i]>="255"){
    $length = "255";
  }else{
    $length = $validasilength[$i];
  }
  if($i==$ai){
    $newFileContent .= '$table->increments("'. $validasinamafield[$i].'","'.$length.'");
    ';
  }else{
    $newFileContent .= '$table->'.$validasidbtype[$i].'("'. $validasinamafield[$i].'","'.$length.'");
    ';
    }
}

if($checkboxtimestamp==true){
$newFileContent .= '$table->timestamps();
    ';
}

if($checkboxsoftdelete==true){
$newFileContent .= '$table->softDeletes();
    ';
}

         $newFileContent .='   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("'.$namatable.'");
    }
}

';


if(file_put_contents($MigrationName,$newFileContent)!=false){

  if($checkboxmigration==true){
  Artisan::call('migrate');
}

    echo "Migration Telah Di Buat : (".basename($MigrationName).") <br>";
}else{
    echo "Migration Gagal Di Buat : (".basename($MigrationName).") <br>";
}

}
}else{
  echo 'Data Sudah ada';
}



}


  public static function CreateModel($namatable='',$namamodel='',$checkboxsoftdelete='',$checkboxtimestamp='')
{


if (Schema::hasTable($namatable))
{

 $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');
    $ModelName =  "".base_path()."/app/".ucfirst($namamodel).".php";

        if (!file_exists($ModelName)) {



$newFileContent = '<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
';
if($checkboxsoftdelete==true){
$newFileContent .='use Illuminate\Database\Eloquent\SoftDeletes;
';
}

$newFileContent .=' class '.ucfirst($namamodel).' extends Model
{ 
  ';

if($checkboxsoftdelete==true){
$newFileContent .=' use SoftDeletes;
';
}

 $newFileContent .=' protected $table = "'.$namatable.'";
 ';

if($checkboxtimestamp==false){
$newFileContent .='public $timestamps = false;';
}

$newFileContent .='
  protected $primaryKey = "'.$tablesPrimary[0]->Column_name.'";
  protected $fillable = [';
  
  foreach($tables as $datacoloumn){

                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at" && $datacoloumn->Field!="updated_at"){
                    $colomfield = $datacoloumn->Field;
                $newFileContent .= '"'.$colomfield.'",';
                }
             }


$newFileContent .= '];
';

if($checkboxsoftdelete==true){
$newFileContent .=' protected $dates = ["deleted_at"];
';
}


$newFileContent .= '}';



if(file_put_contents($ModelName,$newFileContent)!=false){
    echo "Model Telah Di Buat : (".basename($ModelName).") <br>";
}else{
    echo "Model Gagal Di Buat : (".basename($ModelName).") <br>";
}


        }else{
              echo 'Maaf File Model Di '.$ModelName.' telah ada <br>';
        }

  }



}

 public static function CreateControllers($namatable='',$namacontrollers='',$namaview='',$namamodel='',$namafield='',$namarequest='')

  {

if (Schema::hasTable($namatable))
{
    $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');
    $ControllersName =  "".base_path()."/app/Http/Controllers/".ucfirst($namacontrollers).".php";
    $Modelname = 'use App\\'.ucfirst($namamodel);
    $Requestname = 'use App\Http\Requests\\'.ucfirst($namarequest);

    if (!file_exists($ControllersName)) {


$newFileContent = '<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
'.$Modelname.';
'.$Requestname.';
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Datatables;
use Redirect;

class '.ucfirst($namacontrollers).' extends Controller
{
    
    public function getIndex(Request $request)
    {
         
                  if($request->ajax()){
            $'.$namatable.'s = '.ucfirst($namamodel).'::all();
                 return Datatables::of($'.$namatable.'s)
            ->addColumn("aksi", function ($'.$namatable.') {
                return kutip
                <a href="kutip.URL("getDetail'.$namaview.'/".$'.$namatable.'->'.$tablesPrimary[0]->Column_name.').kutip" class="btn btn-sm btn-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                <a href="kutip.URL("getUpdate'.$namaview.'/".$'.$namatable.'->'.$tablesPrimary[0]->Column_name.').kutip" class="btn btn-sm btn-primary" target="_blank"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a  id="deleteData" data-id="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" data-name ="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a> kutip;
            }) ->addColumn("no", function ($'.$namatable.') {
                return kutip <input type="checkbox" value="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" id="deleteRow" name="deleteRow"> # kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip kutip ;
            })
            ->make(true);
             

         }
  return view("'.$namaview.'/'.$namaview.'");

    }

   
    public function getCreate()
    {
   return view("'.$namaview.'/getCreate");
    }

   
    public function postCreate('.ucfirst($namarequest).' $request)
    {
    $'.$namatable.' = '.ucfirst($namamodel).'::create([';
foreach($namafield as $datafield){
$newFileContent .= '"'.$datafield.'"=>$request->'.$datafield.',';
}
$newFileContent .=' ]);
      if(!is_null($'.$namatable.')){
        return Redirect::to("'.$namaview.'")->with("message","Berhasil Menambah Data '.$namaview.' "); 
      }

      return Redirect::to("'.$namaview.'")->with("message","Gagal Menambah Data '.$namaview.' "); 

    }

    public function getDetail($id)
    {
               
                 $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
   if(!is_null($'.$namatable.')){
  return view("'.$namaview.'/getDetail",compact("'.$namatable.'"));
   }
 echo "Halaman Tidak Di Temukan";




    }

  
    public function getUpdate($id)
    {

                       $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
   if(!is_null($'.$namatable.')){
  return view("'.$namaview.'/getUpdate",compact("'.$namatable.'"));
   }
 echo "Halaman Tidak Di Temukan";

    }

    public function postUpdate('.ucfirst($namarequest).' $request)
    {
      $id = $request->id;

        $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
      if(!is_null( $'.$namatable.')){
         $'.$namatable.'->update([';
foreach($namafield as $datafield){
$newFileContent .= '"'.$datafield.'"=>$request->'.$datafield.',';
}
      $newFileContent .=' ]);

        return Redirect::to("'.$namaview.'")->with("message","Berhasil Mengubah Data '.$namaview.' "); 
      }

      return Redirect::to("'.$namaview.'")->with("message","Gagal Mengubah Data '.$namaview.'"); 
           
    }


    public function deleteData(Request $request){
      $idarray = $request->id;
          if($request->ajax()){
if(!is_null($idarray)){
    for($i=0; $i<count($idarray); $i++ ){
    $id = $request->id[$i];
            $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
       if(!is_null($'.$namatable.')){
    $'.$namatable.'->delete();
      }
   }
}
    }

}

}
';


if(file_put_contents($ControllersName,str_replace("kutip", "'", $newFileContent))!=false){
    echo "Controllers Telah Di Buat :  (".basename($ControllersName).") <br>";
}else{
    echo "Controllers Gagal Di Buat : (".basename($ControllersName).") <br>";
}

    }else{

echo 'Maaf File Controllers Di '.$ControllersName.' telah ada <br>';

    }

}else{

echo 'Maaf Table Yang Anda Masukan Tidak Tersedia';
}



  }

  public static function CreateControllersResource($namatable='',$namacontrollers='',$namaview='',$namamodel='',$namafield='',$namarequest='')

  {

if (Schema::hasTable($namatable))
{
    $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');
    $ControllersName =  "".base_path()."/app/Http/Controllers/".ucfirst($namacontrollers).".php";
    $Modelname = 'use App\\'.ucfirst($namamodel);
    $Requestname = 'use App\Http\Requests\\'.ucfirst($namarequest);

    if (!file_exists($ControllersName)) {


$newFileContent = '<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
'.$Modelname.';
'.$Requestname.';
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Datatables;
use Redirect;

class '.ucfirst($namacontrollers).' extends Controller
{
    
    public function index(Request $request)
    {
         
                  if($request->ajax()){
            $'.$namatable.'s = '.ucfirst($namamodel).'::all();
                 return Datatables::of($'.$namatable.'s)
            ->addColumn("aksi", function ($'.$namatable.') {
                return kutip
                <a href="kutip.URL("'.$namaview.'/".$'.$namatable.'->'.$tablesPrimary[0]->Column_name.').kutip" class="btn btn-sm btn-success" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                <a href="kutip.URL("'.$namaview.'/".$'.$namatable.'->'.$tablesPrimary[0]->Column_name.').kutip/edit" class="btn btn-sm btn-primary" target="_blank"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a  id="deleteData" data-id="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" data-name ="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a> kutip;
            }) ->addColumn("no", function ($'.$namatable.') {
                return kutip <input type="checkbox" value="kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip" id="deleteRow" name="deleteRow"> # kutip.$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'.kutip kutip ;
            })
            ->make(true);
             

         }
  return view("'.$namaview.'/'.$namaview.'");

    }

   
    public function create()
    {
   return view("'.$namaview.'/getCreate");
    }

   
    public function store('.ucfirst($namarequest).' $request)
    {
    $'.$namatable.' = '.ucfirst($namamodel).'::create([';
foreach($namafield as $datafield){
$newFileContent .= '"'.$datafield.'"=>$request->'.$datafield.',';
}
$newFileContent .=' ]);
      if(!is_null($'.$namatable.')){
        return Redirect::to("'.$namaview.'")->with("message","Berhasil Menambah Data '.$namaview.' "); 
      }

      return Redirect::to("'.$namaview.'")->with("message","Gagal Menambah Data '.$namaview.' "); 

    }

    public function show($id)
    {
               
                 $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
   if(!is_null($'.$namatable.')){
  return view("'.$namaview.'/getDetail",compact("'.$namatable.'"));
   }
 echo "Halaman Tidak Di Temukan";




    }

  
    public function edit($id)
    {

                       $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
   if(!is_null($'.$namatable.')){
  return view("'.$namaview.'/getUpdate",compact("'.$namatable.'"));
   }
 echo "Halaman Tidak Di Temukan";

    }

    public function update('.ucfirst($namarequest).' $request , $id)
    {

        $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
      if(!is_null( $'.$namatable.')){
         $'.$namatable.'->update([';
foreach($namafield as $datafield){
$newFileContent .= '"'.$datafield.'"=>$request->'.$datafield.',';
}
      $newFileContent .=' ]);

        return Redirect::to("'.$namaview.'")->with("message","Berhasil Mengubah Data '.$namaview.' "); 
      }

      return Redirect::to("'.$namaview.'")->with("message","Gagal Mengubah Data '.$namaview.'"); 
           
    }


    public function deleteData(Request $request){
      $idarray = $request->id;
          if($request->ajax()){
if(!is_null($idarray)){
    for($i=0; $i<count($idarray); $i++ ){
    $id = $request->id[$i];
            $'.$namatable.' = '.ucfirst($namamodel).'::find($id);
       if(!is_null($'.$namatable.')){
    $'.$namatable.'->delete();
      }
   }
}
    }

}

}
';


if(file_put_contents($ControllersName,str_replace("kutip", "'", $newFileContent))!=false){
    echo "Controllers Telah Di Buat :  (".basename($ControllersName).") <br>";
}else{
    echo "Controllers Gagal Di Buat : (".basename($ControllersName).") <br>";
}

    }else{

echo 'Maaf File Controllers Di '.$ControllersName.' telah ada <br>';

    }

}else{

echo 'Maaf Table Yang Anda Masukan Tidak Tersedia';
}



  }


  public static function CreateViewResource($namatable='',$namaview='',$namafield='',$htmltype='')
  {

  $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');

if (!is_dir(''.base_path().'/resources/views/'.$namaview.'/')) {
  // dir doesn't exist, make it
  mkdir(''.base_path().'/resources/views/'.$namaview.'');

$Viewindex =  "".base_path()."/resources/views/$namaview/".$namaview.".blade.php";

    if (!file_exists($Viewindex)) {

$newViewindex ='
@extends("bubblelayouts.form", ["urldelete" => "deleteData'.$namaview.'","table"=>"table'.$namaview.'"])
@section("content")
@if(Session::has("message"))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ Session::get("message") }}
    </div>
@endif

 <div class="panel panel-default">
  <!-- Default panel contents -->

   <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><span class="glyphicon glyphicon-th-list"></span> List Data '.$namaview.' </h4>
      <div class="btn-group pull-right">
        <a href="{{URL("'.$namaview.'/create")}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus " data-toggle="tooltip" data-placement="top" title="Tambah Data '.$namaview.'"></span></a>
        <a id="reloadTable" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh" data-toggle="tooltip" data-placement="top" title="Reload Data '.$namaview.'"></span></a>
      </div>
    </div>

  <div class="panel-body">
<div class="table-responsive">
 <table class="table table-bordered" id="Datatable">
        <thead>
            <tr><th>No</th>
             <th><input type="checkbox"  id="deleteSemua" /> <button id="prosesDelete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></th>';

  foreach($tables as $datacoloumn){

                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at"){
                $newViewindex .= '<th>'.$datacoloumn->Field.'</th>';
                }
             }

$newViewindex .='<th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
  </div>

</div>
@stop

@push("scripts")
<script>
   var Datatable =  $("#Datatable").DataTable({
        processing: true,
         "language": {
        "processing": "Sedang Membuka Data",
        searchPlaceholder: "Cari Kata Kunci Disini ..."
    },
        serverSide: true,
        ajax: "{{URL("'.$namaview.'")}}",
        columns: [
            { data: null,orderable: false, searchable: false},
            {data: "no", name: "no" , orderable: false, searchable: false},';
            $no = 0;
  foreach($tables as $datacoloumn){
                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at"){
                $newViewindex .= '{ data: "'.$datacoloumn->Field.'", name: "'.$datacoloumn->Field.'" },';
                }
                   if($datacoloumn->Field!="updated_at"){
                      $update = $no++;
                     }

             }
$newViewindex .='
             {data: "aksi", name: "aksi", orderable: false, searchable: false},
            
        ],
        order: [['.$update.', "desc"]],
        /* scrollY: 200,
    deferRender: true,
    scroller: {
        loadingIndicator: true
    }*/
    });


   Datatable.on( "order.dt search.dt draw.dt", function () {
       Datatable.column(0, {search:"applied", order:"applied"}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>
@endpush
';
file_put_contents($Viewindex,$newViewindex);
echo "View telah di buat : (".basename($Viewindex).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewindex.' telah ada <br>';
      }

$Viewcreate =  "".base_path()."/resources/views/$namaview/getCreate.blade.php";

 if (!file_exists($Viewcreate)) {
     
$newViewcreate ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Tambah Data '.$namaview.'</h4>
<hr>
@include("bubbleinformasi.validasi")
<form role="form" method="post" action="{{URL("'.$namaview.'")}}" enctype="multipart/form-data">
@include("'.$namaview.'.getFormCreate")
  <button type="submit" class="btn btn-default">Tambah Data</button>
</form>
<br>
@stop
';
file_put_contents($Viewcreate,$newViewcreate);
echo "View telah di buat : (".basename($Viewcreate).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewcreate.' telah ada <br>';
      }



$Viewdetail =  "".base_path()."/resources/views/$namaview/getDetail.blade.php";
 if (!file_exists($Viewdetail)) {


$newViewdetail ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Detail Data '.$namaview.'</h4>
<hr>
@include("'.$namaview.'.getFormDetail")
@stop
';
file_put_contents($Viewdetail,$newViewdetail);
echo "View telah di buat : (".basename($Viewdetail).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewdetail.' telah ada <br>';
      }




$Viewupdate =  "".base_path()."/resources/views/$namaview/getUpdate.blade.php";
 if (!file_exists($Viewupdate)) {


$newViewupdate ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Ubah Data '.$namaview.'</h4>
<hr>
@include("bubbleinformasi.validasi")
<form role="form" method="post" action="{{URL("'.$namaview.'/$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'")}}" enctype="multipart/form-data">
@include("'.$namaview.'.getFormUpdate")
  <button type="submit" class="btn btn-default">Ubah Data</button>
</form>
<br>
@stop
';
file_put_contents($Viewupdate,$newViewupdate);

      }else{
            echo 'Maaf File View Di '.$Viewupdate.' telah ada <br>';
      }
      


$FormDetail =  "".base_path()."/resources/views/$namaview/getFormDetail.blade.php";

 if (!file_exists($FormDetail)) {

$newFormDetail ='';
for($i=0; $i<count($namafield); $i++){



      if($namafield[$i] != $tablesPrimary[0]->Column_name){

        if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}"  readonly="">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'"  readonly="">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}" readonly="">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" readonly="">{{$'.$namatable."->".$namafield[$i].'}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{$'.$namatable."->".$namafield[$i].'}}">{{$'.$namatable."->".$namafield[$i].'}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"  readonly=""> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'" readonly=""> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}" readonly="">
  </div>';


      }
$newFormDetail .=''.$data.'';
      }
   


}
file_put_contents($FormDetail,$newFormDetail);
      }else{
            echo 'Maaf File View Di '.$FormDetail.' telah ada <br>';
      }



$FormUpdate =  "".base_path()."/resources/views/$namaview/getFormUpdate.blade.php";

 if (!file_exists($FormUpdate)) {

     
$newFormUpdate ='<input type="hidden" name="_token" value="{{csrf_token()}}">
<input name="_method" type="hidden" value="PUT">';
for($i=0; $i<count($namafield); $i++){

    if($namafield[$i] != $tablesPrimary[0]->Column_name){

 if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">{{$'.$namatable."->".$namafield[$i].'}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{$'.$namatable."->".$namafield[$i].'}}">{{$'.$namatable."->".$namafield[$i].'}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"  @if(!empty($required)) readonly="" @endif> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';


      }
$newFormUpdate .=''.$data.'';

    }
  


}
file_put_contents($FormUpdate,$newFormUpdate);



      }else{
            echo 'Maaf File View Di '.$FormUpdate.' telah ada <br>';
      }



$FormCreate =  "".base_path()."/resources/views/$namaview/getFormCreate.blade.php";

 if (!file_exists($FormCreate)) {


$newFormCreate ='<input type="hidden" name="_token" value="{{csrf_token()}}">';
for($i=0; $i<count($namafield); $i++){

  if($namafield[$i] != $tablesPrimary[0]->Column_name){
 if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">{{old("'.$namafield[$i].'")}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{old("'.$namafield[$i].'")}}">{{old("'.$namafield[$i].'")}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';


      }
$newFormCreate .=''.$data.'';

  }
  


}
file_put_contents($FormCreate,$newFormCreate);

echo "View telah di buat : (".basename($Viewupdate).") <br>";


      }else{
            echo 'Maaf File View Di '.$FormCreate.' telah ada <br>';
      }


}else{
    echo 'Maaf Folder View Di ".base_path()."/resources/views/'.$namaview.' telah ada <br>';
}


  }


  public static function CreateView($namatable='',$namaview='',$namafield='',$htmltype='')
  {

  $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');

if (!is_dir(''.base_path().'/resources/views/'.$namaview.'/')) {
  // dir doesn't exist, make it
  mkdir(''.base_path().'/resources/views/'.$namaview.'');

$Viewindex =  "".base_path()."/resources/views/$namaview/".$namaview.".blade.php";

    if (!file_exists($Viewindex)) {

$newViewindex ='
@extends("bubblelayouts.form", ["urldelete" => "deleteData'.$namaview.'","table"=>"table'.$namaview.'"])
@section("content")
@if(Session::has("message"))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ Session::get("message") }}
    </div>
@endif

 <div class="panel panel-default">
  <!-- Default panel contents -->

   <div class="panel-heading clearfix">
      <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><span class="glyphicon glyphicon-th-list"></span> List Data '.$namaview.' </h4>
      <div class="btn-group pull-right">
        <a href="{{URL("getCreate'.$namaview.'")}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus " data-toggle="tooltip" data-placement="top" title="Tambah Data '.$namaview.'"></span></a>
        <a id="reloadTable" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh" data-toggle="tooltip" data-placement="top" title="Reload Data '.$namaview.'"></span></a>
      </div>
    </div>

  <div class="panel-body">
<div class="table-responsive">
 <table class="table table-bordered" id="Datatable">
        <thead>
            <tr><th>No</th>
             <th><input type="checkbox"  id="deleteSemua" /> <button id="prosesDelete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></th>';

  foreach($tables as $datacoloumn){

                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at"){
                $newViewindex .= '<th>'.$datacoloumn->Field.'</th>';
                }
             }

$newViewindex .='<th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
  </div>

</div>
@stop

@push("scripts")
<script>
   var Datatable =  $("#Datatable").DataTable({
        processing: true,
         "language": {
        "processing": "Sedang Membuka Data",
        searchPlaceholder: "Cari Kata Kunci Disini ..."
    },
        serverSide: true,
        ajax: "{{URL("'.$namaview.'")}}",
        columns: [
            { data: null,orderable: false, searchable: false},
            {data: "no", name: "no" , orderable: false, searchable: false},';
            $no = 0;
  foreach($tables as $datacoloumn){
                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at"){
                $newViewindex .= '{ data: "'.$datacoloumn->Field.'", name: "'.$datacoloumn->Field.'" },';
                }
                   if($datacoloumn->Field!="updated_at"){
                      $update = $no++;
                     }

             }
$newViewindex .='
             {data: "aksi", name: "aksi", orderable: false, searchable: false},
            
        ],
        order: [['.$update.', "desc"]],
        /* scrollY: 200,
    deferRender: true,
    scroller: {
        loadingIndicator: true
    }*/
    });


   Datatable.on( "order.dt search.dt draw.dt", function () {
       Datatable.column(0, {search:"applied", order:"applied"}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>
@endpush
';
file_put_contents($Viewindex,$newViewindex);
echo "View telah di buat : (".basename($Viewindex).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewindex.' telah ada <br>';
      }

$Viewcreate =  "".base_path()."/resources/views/$namaview/getCreate.blade.php";

 if (!file_exists($Viewcreate)) {
     
$newViewcreate ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Tambah Data '.$namaview.'</h4>
<hr>
@include("bubbleinformasi.validasi")
<form role="form" method="post" action="{{URL("postCreate'.$namaview.'")}}" enctype="multipart/form-data">
@include("'.$namaview.'.getFormCreate")
  <button type="submit" class="btn btn-default">Tambah Data</button>
</form>
<br>
@stop
';
file_put_contents($Viewcreate,$newViewcreate);
echo "View telah di buat : (".basename($Viewcreate).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewcreate.' telah ada <br>';
      }



$Viewdetail =  "".base_path()."/resources/views/$namaview/getDetail.blade.php";
 if (!file_exists($Viewdetail)) {


$newViewdetail ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Detail Data '.$namaview.'</h4>
<hr>
@include("'.$namaview.'.getFormDetail")
@stop
';
file_put_contents($Viewdetail,$newViewdetail);
echo "View telah di buat : (".basename($Viewdetail).") <br>";

      }else{
            echo 'Maaf File View Di '.$Viewdetail.' telah ada <br>';
      }




$Viewupdate =  "".base_path()."/resources/views/$namaview/getUpdate.blade.php";
 if (!file_exists($Viewupdate)) {


$newViewupdate ='
@extends("bubblelayouts.form")
@section("content")
<button type="button" class="btn btn-danger btn-sm" id="Kembali">Kembali</button>
  <br><br>
<h4>Ubah Data '.$namaview.'</h4>
<hr>
@include("bubbleinformasi.validasi")
<form role="form" method="post" action="{{URL("postUpdate'.$namaview.'/$'.$namatable.'->'.$tablesPrimary[0]->Column_name.'")}}" enctype="multipart/form-data">
@include("'.$namaview.'.getFormUpdate")
  <button type="submit" class="btn btn-default">Ubah Data</button>
</form>
<br>
@stop
';
file_put_contents($Viewupdate,$newViewupdate);

      }else{
            echo 'Maaf File View Di '.$Viewupdate.' telah ada <br>';
      }
      


$FormDetail =  "".base_path()."/resources/views/$namaview/getFormDetail.blade.php";

 if (!file_exists($FormDetail)) {

$newFormDetail ='';
for($i=0; $i<count($namafield); $i++){



      if($namafield[$i] != $tablesPrimary[0]->Column_name){

        if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}"  readonly="">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'"  readonly="">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}" readonly="">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" readonly="">{{$'.$namatable."->".$namafield[$i].'}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{$'.$namatable."->".$namafield[$i].'}}">{{$'.$namatable."->".$namafield[$i].'}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"  readonly=""> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'" readonly=""> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}" readonly="">
  </div>';


      }
$newFormDetail .=''.$data.'';
      }
   


}
file_put_contents($FormDetail,$newFormDetail);
      }else{
            echo 'Maaf File View Di '.$FormDetail.' telah ada <br>';
      }



$FormUpdate =  "".base_path()."/resources/views/$namaview/getFormUpdate.blade.php";

 if (!file_exists($FormUpdate)) {

     
$newFormUpdate ='<input type="hidden" name="_token" value="{{csrf_token()}}">
';
for($i=0; $i<count($namafield); $i++){

    if($namafield[$i] != $tablesPrimary[0]->Column_name){

 if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">{{$'.$namatable."->".$namafield[$i].'}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{$'.$namatable."->".$namafield[$i].'}}">{{$'.$namatable."->".$namafield[$i].'}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"  @if(!empty($required)) readonly="" @endif> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{$'.$namatable."->".$namafield[$i].'}}">
  </div>';


      }
$newFormUpdate .=''.$data.'';

    }
  


}
file_put_contents($FormUpdate,$newFormUpdate);



      }else{
            echo 'Maaf File View Di '.$FormUpdate.' telah ada <br>';
      }



$FormCreate =  "".base_path()."/resources/views/$namaview/getFormCreate.blade.php";

 if (!file_exists($FormCreate)) {


$newFormCreate ='<input type="hidden" name="_token" value="{{csrf_token()}}">';
for($i=0; $i<count($namafield); $i++){

  if($namafield[$i] != $tablesPrimary[0]->Column_name){
 if($htmltype[$i]=="text"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';

      }else if($htmltype[$i]=="file"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="file" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  </div>';
      }
      else if($htmltype[$i]=="date"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <input type="date" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';
      }
      else if($htmltype[$i]=="textarea"){
         $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label>
    <textarea class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">{{old("'.$namafield[$i].'")}}</textarea>
  </div>';
      }
      else if($htmltype[$i]=="select"){
        $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
   <select  class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'">
  <option value="{{old("'.$namafield[$i].'")}}">{{old("'.$namafield[$i].'")}}</option>
</select>
  </div>';
      }
      else if($htmltype[$i]=="checkbox"){
              $data ='<div class="form-group">
    <label for="'.$namafield[$i].' ">'.$namafield[$i].' :</label><br>
    <input type="checkbox"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }
      else if($htmltype[$i]=="radio"){
                $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].' :</label><br>
    <input type="radio"  id="'.$namafield[$i].'" name="'.$namafield[$i].'"> '.$namafield[$i].'
  </div>';
      }else{
          $data ='<div class="form-group">
    <label for="'.$namafield[$i].'">'.$namafield[$i].':</label>
    <input type="text" class="form-control" id="'.$namafield[$i].'" name="'.$namafield[$i].'" value="{{old("'.$namafield[$i].'")}}">
  </div>';


      }
$newFormCreate .=''.$data.'';

  }
  


}
file_put_contents($FormCreate,$newFormCreate);

echo "View telah di buat : (".basename($Viewupdate).") <br>";

      }else{
            echo 'Maaf File View Di '.$FormCreate.' telah ada <br>';
      }


}else{
    echo 'Maaf Folder View Di ".base_path()."/resources/views/'.$namaview.' telah ada <br>';
}


  }

  public static function CreateRequest($namatable='',$namarequest='',$namafield='',$validasifield='')

  {


 /* echo rtrim("a,b,c,d,e,", ",");*/
/*  echo $namafield[$i]." - ".$validasifield[$i];*/

    $tables = DB::select('SHOW COLUMNS FROM '.$namatable.'');
    $tablesPrimary = DB::select('SHOW INDEX FROM '.$namatable.'');
    $RequestName =  "".base_path()."/app/Http/Requests/".ucfirst($namarequest).".php";
    if (!file_exists($RequestName)) {

      $newFileContent = '<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class '.ucfirst($namarequest).' extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

return [';
for($i=0; $i<count($namafield); $i++){


    if($namafield[$i] != $tablesPrimary[0]->Column_name){
  $data = '
  "'.$namafield[$i].'" => "'.str_replace(",", "|", $validasifield[$i]).'",';
  $newFileContent.= ''.$data.'';
    }

}
$newFileContent .='
];
    }

       public function messages()
    {

 return [';
           
for($i=0; $i<count($namafield); $i++){

  $validasiefieldexplode = explode(",",$validasifield[$i]);

foreach($validasiefieldexplode as $field){
    $datafield = $field;
  $field = str_replace(":", "", $field);
  $field =  preg_replace('/[0-9]+/', '', $field);
  if($field=="required"){
    $message = $namafield[$i]." Belum Terisi";
  }
  else if($field=="email"){
    $message = $namafield[$i]." Harus Berformat Email";
  }
   else if($field=="min"){
    $message = $namafield[$i]." Minimal Charachter Yang Harus Di Masukan ".str_replace("min:", "", $datafield);
  }
   else if($field=="max"){
  $message = $namafield[$i]." Maximal Charachter Yang Harus Di Masukan ".str_replace("max:", "", $datafield);
  }
   else if($field=="numeric"){
    $message = $namafield[$i]." Harus Berformat Number";
  }
   else if($field=="required"){
    $message = $namafield[$i]." Belum Terisi";
  }else{
       $message = $namafield[$i]." Gagal Terisi";
  }

      if($namafield[$i] != $tablesPrimary[0]->Column_name){
  $data = '
  "'.$namafield[$i].'.'.$field.'" => "'.$message.'"';
  $newFileContent .=''.$data.',';
      }


}
}
    $newFileContent .='];
    }

}


';


if(file_put_contents($RequestName,$newFileContent)!=false){
    echo "Validasi Telah Di Buat : (".basename($RequestName).") <br>";
}else{
    echo "Validasi Gagal Di Buat : (".basename($RequestName).") <br>";
}

    }else{

echo 'Maaf File Request Untuk Validasi Di '.$RequestName.' telah ada <br>';
    }



  }


}
?>