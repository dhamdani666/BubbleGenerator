<?php 

namespace BubbleGenerator\Generator\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Carbon\Carbon;
use Datatables;
use CreateFile;
use CreateFileNewTable;
use Config;
use Illuminate\Support\Facades\Schema;

class BubbleGeneratorController extends Controller
{


  public function getIndex(){
   
            return view('bubblegenerator::home');
    }

    public function getNewtable(){
            return view('bubblegenerator::newtable');
    }

    public function getTable(){
          $defaultkoneksi=  Config::get('database.default');
      $database= Config::get('database.connections.'.$defaultkoneksi.'.database');
      if(($database)){
     
            $tables = DB::select('SHOW TABLES');
             return view('bubblegenerator::table',compact('tables'));
      }else{
        echo 'Anda Belum Memasukan Nama Databasenya';
      }

           
    }


        public function PostCreateController_Table(Request $request){

$routesphp = file_get_contents(''.base_path().'/app/Http/routes.php');

        if($request->target=="table"){


        $namatable = $request->namatable_table;
        $checkboxtable = $request->checkboxtable_table;
        $namamodel = $request->namamodel_table;
        $namavalidasi = $request->namavalidasi_table;
        $namacontroller = $request->namacontroller_table;
        $namaview = $request->namaview_table;

        $validasihtmltype = $request->htmltype_validasitable;
        $validasinamafield =  $request->namafield_validasitable;
        $validasifield = $request->validasifield_validasitable;
        $checkroutes = $request->checkboxroutes_table;
        $allvalidasi = $request->allvalidasi;


  CreateFile::CreateModel($namatable,$namamodel);
  CreateFile::CreateRequest($namatable,$namavalidasi,$validasinamafield,$validasifield);


  if($checkroutes=="Resource"){
  CreateFile::CreateControllersResource($namatable,$namacontroller,$namaview,$namamodel,$validasinamafield,$namavalidasi);

   if(strpos($routesphp, "Route::resource('".$namaview."', '".ucfirst($namacontroller)."')") !== false)
 {
echo "Maaf Code : Route::resource('".$namaview."', '".ucfirst($namacontroller)."'); Telah Ada di Routes.php <br>";
 }else{
$routes ="
Route::resource('".$namaview."', '".ucfirst($namacontroller)."');";
    $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php',  "$routes" , FILE_APPEND);
 }

   if(strpos($routesphp, "Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData')") !== false)
 {
echo "Maaf Code : Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData'); Telah Ada di Routes.php <br>";
 }else{
$routes ="Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData');";
   $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php', "\r\n$routes" , FILE_APPEND);
 }

  CreateFile::CreateViewResource($namatable,$namaview,$validasinamafield,$validasihtmltype);
  }else{
  CreateFile::CreateControllers($namatable,$namacontroller,$namaview,$namamodel,$validasinamafield,$namavalidasi);
  $routes = "
Route::get('".$namaview."', '".ucfirst($namacontroller)."@getIndex');
Route::get('getCreate".$namaview."', '".ucfirst($namacontroller)."@getCreate');
Route::get('getUpdate".$namaview."/{id?}', '".ucfirst($namacontroller)."@getUpdate');
Route::get('getDetail".$namaview."/{id?}', '".ucfirst($namacontroller)."@getDetail');
Route::post('postUpdate".$namaview."/{id?}', '".ucfirst($namacontroller)."@postUpdate');
Route::post('postCreate".$namaview."', '".ucfirst($namacontroller)."@postCreate');
Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData');
  ";
   $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php', "\r\n$routes" , FILE_APPEND);
    CreateFile::CreateView($namatable,$namaview,$validasinamafield,$validasihtmltype);
  }


  echo '<br> <a href="'.$namaview.'" target="_blank"><button type="button" class="btn btn-sm btn-primary btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lihat  '.$namaview.'</button></a>';

        }else{

      $namatable = $request->namatable_newtable;
      $checkroutes = $request->checkboxroutes_newtable;
      $checkboxtable = $request->checkboxtable_newtable;
      $checkboxmigration = $request->checkboxmigration_newtable;
      $checkboxsoftdelete = $request->checkboxsoftdelete_newtable;
      $checkboxtimestamp = $request->checkboxtimestamp_newtable;

      $namamodel = $request->namamodel_newtable;
      $namavalidasi = $request->namavalidasi_newtable;
      $namacontroller = $request->namacontroller_newtable;
      $namaview = $request->namaview_newtable;
      $namamigration = $request->namemigration;


      $validasinamafield =  $request->namafield_newtable;
      $validasidbtype = $request->typefield_newtable;
      $validasilength = $request->lengthfield_newtable;
      $validasifield = $request->validasifield_newtable;
      $validasihtmltype = $request->htmltype_newtable;
      $allvalidasi = $request->allvalidasi;

      $ai = $request->ai_newtable;

    CreateFileNewTable::CreateMigration($namatable,$namamigration,$checkboxmigration,$checkboxsoftdelete,$checkboxtimestamp,$validasinamafield,$validasidbtype,$validasilength,$validasifield,$ai);
    CreateFileNewTable::CreateModel($namatable,$namamodel,$checkboxsoftdelete,$checkboxtimestamp);
    CreateFileNewTable::CreateRequest($namatable,$namavalidasi,$validasinamafield,$validasifield);

  if($checkroutes=="Resource"){
  CreateFileNewTable::CreateControllersResource($namatable,$namacontroller,$namaview,$namamodel,$validasinamafield,$namavalidasi);

   if(strpos($routesphp, "Route::resource('".$namaview."', '".ucfirst($namacontroller)."')") !== false)
 {
echo "Maaf Code : Route::resource('".$namaview."', '".ucfirst($namacontroller)."'); Telah Ada di Routes.php <br>";
 }else{
$routes ="
Route::resource('".$namaview."', '".ucfirst($namacontroller)."');";
    $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php',  "$routes" , FILE_APPEND);
 }

   if(strpos($routesphp, "Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData')") !== false)
 {
echo "Maaf Code : Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData'); Telah Ada di Routes.php <br>";
 }else{
$routes ="Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData');";
   $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php', "\r\n$routes" , FILE_APPEND);
 }
  CreateFileNewTable::CreateViewResource($namatable,$namaview,$validasinamafield,$validasihtmltype);


}else{
  CreateFileNewTable::CreateControllers($namatable,$namacontroller,$namaview,$namamodel,$validasinamafield,$namavalidasi);
  $routes = "
Route::get('".$namaview."', '".ucfirst($namacontroller)."@getIndex');
Route::get('getCreate".$namaview."', '".ucfirst($namacontroller)."@getCreate');
Route::get('getUpdate".$namaview."/{id?}', '".ucfirst($namacontroller)."@getUpdate');
Route::get('getDetail".$namaview."/{id?}', '".ucfirst($namacontroller)."@getDetail');
Route::post('postUpdate".$namaview."/{id?}', '".ucfirst($namacontroller)."@postUpdate');
Route::post('postCreate".$namaview."', '".ucfirst($namacontroller)."@postCreate');
Route::post('deleteData".$namaview."', '".ucfirst($namacontroller)."@deleteData');
  ";
     $addroutes = file_put_contents(''.base_path().'/app/Http/routes.php', "\r\n$routes" , FILE_APPEND);
       CreateFileNewTable::CreateView($namatable,$namaview,$validasinamafield,$validasihtmltype);
  }


echo '<br> <a href="'.$namaview.'" target="_blank"><button type="button" class="btn btn-sm btn-primary btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lihat  '.$namaview.'</button></a>';

        }



  /*
if($allvalidasi==true){
  dd($request->all());
}else{
  echo 'tidak ada';
}*/

  /*   CreateFile::test($validasinamafield,$validasifield);

*/


    }



    public function PostShowTable(Request $request){
       if(empty($request->namatable)){
        echo 'gagal';
       }else{
          $tables = DB::select('SHOW COLUMNS FROM '.$request->namatable.'');
                 $tablesPrimary = DB::select('SHOW INDEX FROM '.$request->namatable.'');
            foreach($tables as $datacoloumn){
                if($datacoloumn->Field != $tablesPrimary[0]->Column_name && $datacoloumn->Field!="created_at" && $datacoloumn->Field!="deleted_at" && $datacoloumn->Field!="updated_at"){
                 echo '<div class="row">
<div class="col-md-4">
    <input type="text" name="namafield_validasitable[]" class="form-control" placeholder="Nama Field" readonly="" value="'.$datacoloumn->Field.'">
</div>

<div class="col-md-5">
  <input type="text" name="validasifield_validasitable[]" value="required" class="form-control" placeholder="required,email,min:6,max:10" id="readonlyvalidasitable">
</div>
<div class="col-md-3">
  <select name="htmltype_validasitable[]" class="form-control">
    <option value="">Pilih Html Type</option>
    <option value="text">Text</option>
     <option value="file">File</option>
      <option value="textarea">TextArea</option>
      <option value="select">Select</option>
    <option value="date">Date</option>
    <option value="checkbox">CheckBox</option>
    <option value="radio">Radio Button</option>
  </select>
</div>
  
</div><p></p>';
                }
            }
       }

    }


}