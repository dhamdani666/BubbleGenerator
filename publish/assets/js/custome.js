
 $(document).ready(function(){

$("#errorpointer *").prop("disabled", true);
$('#Kembali').click(function() {
     window.history.go(-1);
   });

keyupaddnewtable();
var namamodel_newtable = $("#namamodel_newtable");
var namacontroller_newtable = $("#namacontroller_newtable");
var namaview_newtable = $("#namaview_newtable");
var namavalidasi_newtable = $("#namavalidasi_newtable");
var namemigration = $("#namemigration");


var namamodel_table = $("#namamodel_table");
var namacontroller_table = $("#namacontroller_table");
var namaview_table = $("#namaview_table");
var namavalidasi_table = $("#namavalidasi_table");
var token = $("#_token").val();


$('#namatable_table').change(function(){ 
    changetable($(this).val());

});

$('#tambahfield').click(function() {
    $('#newfield').append('<p></p><div id="newfield"><div class="row"><div class="col-md-2"><input type="text" name="namafield_newtable[]" value="" class="form-control" placeholder="Masukan Nama Field"></div><div class="col-md-2"><select name="typefield_newtable[]" id="typefield_newtable" class="form-control"><option value="string">DB Type</option><option value="string">Varchar</option><option value="integer">Integer</option><option value="enum">Enum</option><option value="text">Text</option><option value="time">Date</option><option value="timestamp">Date Time</option><option value="Date">Geometry</option><option value="Date">Polygon</option></select></div><div class="col-md-1"><input type="text" name="lengthfield_newtable[]" value="" class="form-control" placeholder="255"></div><div class="col-md-2"><input type="text" name="validasifield_newtable[]" value="required" class="form-control" placeholder="required,email,min:6,max:10" ></div><div class="col-md-2"><select name="htmltype_newtable[]" class="form-control"><option value="">Html Type</option><option value="text">Text</option><option value="textarea">TextArea</option><option value="file">File</option><option value="select">Select</option><option value="date">Date</option><option value="checkbox">CheckBox</option><option value="radio">Radio</option></select></div><div class="col-md-3"><input type="radio" name="primaryfield_newtable[]" id="primaryfield_newtable" > Primary <input type="radio" name="autoincrementsfield_newtable[]" id="autoincrementsfield_newtable"  > Auto Increments <input type="checkbox" name="uuidfield_newtable[]" id="uuidfield_newtable"  > UUID</div></div> <p></p><button id="hapusfield" class="btn btn-danger btn-sm">Hapus</button><p></p></div>');
});
$('#optionnewfield').on('click','#hapusfield',function() {
 	$(this).parent().remove();
});
  
function keyupaddnewtable (){
      $("#namatable_newtable").keyup(function(){
           namamodel_newtable.val(''+$(this).val()+'Model');
             namacontroller_newtable.val(''+$(this).val()+'Controller');
               namaview_newtable.val($(this).val());
                 namavalidasi_newtable.val(''+$(this).val()+'Validasi');
                 namemigration.val('Create'+$(this).val()+'Table');
             if($('#namatable_newtable').val()==""){
$("#errorpointer *").prop("disabled", true);
             }else{
              $("#errorpointer *").prop("disabled", false);
             }
        });
       

  }



  function changetable (val){
  namamodel_table.val(''+val+'Model');
             namacontroller_table.val(''+val+'Controller');
               namaview_table.val(val);
                 namavalidasi_table.val(''+val+'Validasi');

                 $.ajax({
      type:"POST",
      data:{namatable: val, _token: token},
      url:"ShowTable"
      ,success:function(sukses)
        {

          if(sukses=="gagal"){
              $('#fieldvalidasi').html('');
          $('#fieldvalidasi').fadeIn('slow');
$("#errorpointer *").prop("disabled", true);
          }else{
              $('#fieldvalidasi').hide();
        $('#fieldvalidasi').html(sukses);
          $('#fieldvalidasi').fadeIn('slow');
$("#errorpointer *").prop("disabled", false);
          }

      }
      ,error:function(a,b,c)
        {
  $('#response').hide();
        $('#response').html('<div class="alert alert-danger" role="alert">Maaf Terjadi Error</div>');
          $('#response').fadeIn('slow');
          $("#errorpointer *").prop("disabled", false);
      }
    });

  }


$('#prosescrudtable').click(function() {
if($(this).val()=="newtable"){
CreateCRUDNewTable();
}else{
  CreateCRUDTable();
}
   });


function CreateCRUDNewTable(){
   if( $('#newfield #primaryfield_newtable:checked').length > 0 ){  // at-least one checkbox checked
var primary = $('#newfield #primaryfield_newtable');
var typefield = $('#newfield #typefield_newtable');
var autoincrement = $('#newfield #autoincrementsfield_newtable');
for(var i=0; i<primary.length; i++){

if(autoincrement[i].checked){
  if(primary[i].checked==false){
    $('#imageloading').hide();
      $('#response').hide();
  $('#response').html('<div class="alert alert-danger" role="alert">Benarkan Terlebih Dahulu AutoIncrement , Primary Harus Di Pilih</div>');
          $('#response').fadeIn('slow');
  }else{
    if(typefield.eq(i).val() != "integer"){
  $('#imageloading').hide();
      $('#response').hide();
        $('#response').html('<div class="alert alert-danger" role="alert">Type DB PrimaryKey Harus Integer</div>');
          $('#response').fadeIn('slow');

}else{
$('#ai_newtable').val(i);
    prosesCRUD(); 
}

      }

  }


}

          }
}

function CreateCRUDTable(){

prosesCRUD();

}

function prosesCRUD(){

   var form = $( "#formcrudtable" ).serialize();


$.ajax({
      type:"POST",
      data:form,
      url:"CreateController_Table"
      ,beforeSend: function() {
    $('#imageloading').show();// Note the ,e that I added
    $("#errorpointer *").prop("disabled", true);
}
      ,success:function(sukses)
        {

     $('#imageloading').hide();
      $('#response').hide();
        $('#response').html('<div class="alert alert-success" role="alert">'+sukses+'</div>');
          $('#response').fadeIn('slow');
          $("#errorpointer *").prop("disabled", false);
      }
      ,error:function(a,b,c)
        {
       $('#imageloading').hide();
      $('#response').hide();
        $('#response').html(a.responseText);
          $('#response').fadeIn('slow');
          $("#errorpointer *").prop("disabled", false);
      }
    }
    );

}

//New Table

  $('#newfield #uuidfield_newtable').click(function(){
         $('#newfield #autoincrementsfield_newtable').each(function(i){
                if($(this).is(':checked')) { 
                  $(this).prop("checked",false);
                }else{
                  $(this).prop("checked",true);
                }
            });

                  $('#newfield #primaryfield_newtable').each(function(i){
                if($(this).is(':checked')) { 
                  $(this).prop("checked",false);
                }else{
                  $(this).prop("checked",true);
                }
            });

  });




    });
