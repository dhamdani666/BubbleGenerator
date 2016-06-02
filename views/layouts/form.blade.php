<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{URL('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL('assets/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL('assets/css/sweetalert.css')}}">
 
    </head>
    <body>
    <center><div class="alert alert-success" role="alert"><h3>FORM LARAVEL</h3></div></center>
    <div class="container">
    

        @yield('content')

            </div>
        <script src="{{URL('assets/js/jquery.min.js')}}" type="text/javascript"></script>
         <script src="{{URL('assets/js/jquery.dataTables.min.js')}}" type="text/javascript" ></script>
     <script src="{{URL('assets/js/bootstrap.min.js')}}" type="text/javascript" ></script>
       <script src="{{URL('assets/js/dataTables.bootstrap.min.js')}}" type="text/javascript" ></script>
              <script src="{{URL('assets/js/sweetalert.min.js')}}" type="text/javascript" ></script>
       @stack('scripts')

       <script>
          

    var token = '{{csrf_token()}}';

  $('#Datatable #prosesDelete').on("click", function(event){ // triggering delete one by one
        if( $('#Datatable #deleteRow:checked').length > 0 ){  // at-least one checkbox checked
            var ids = [];
             var data = { 'id[]' : [] ,'_token' :token};
            $('#Datatable #deleteRow').each(function(i){
                if($(this).is(':checked')) { 
                    ids.push($(this).val());
                      data['id[]'].push($(this).val());
                }
            });
            var counter = ids;

      swal({
        title: "Anda Yakin?",
        text: "Apakah Anda Yakin Akan Menghapus "+counter.length+" Data Sekaligus ? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya , Saya Yakin!',
        closeOnConfirm: false
    },
    function(){
                               $.ajax({
      type:"POST",
      data:data,
      url:"{{URL(isset($urldelete) ? $urldelete : 'Default')}}"
      ,success:function(sukses)
        {
          swal("Data Terhapus!", "Data Telah Berhasil Di Hapus!", "success");
Datatable.draw();
$('#deleteSemua').prop("checked",false);

      }
      ,error:function(a,b,c)
        {

      }
    });


    });
        }else{
                   swal("Ooops Ada Kesalahan!", "Anda Harus Memilih Data Yang Akan Di Hapus Terlebih Dahulu!", "error");
        }
    });

$("#Datatable").on("click","#deleteSemua",function(){
  var status = this.checked;
        $("#Datatable #deleteRow").each( function() {
            $(this).prop("checked",status);
        });
});

$("#Datatable").on("click","#deleteData",function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
        title: "Anda Yakin?",
        text: "Apakah Anda Yakin Akan Menghapus Data Ini ? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya , Saya Yakin!',
        closeOnConfirm: false
    },
    function(){

                       $.ajax({
      type:"POST",
      data:{id: id, _token: token},
      url:"{{URL(isset($urldelete) ? $urldelete : 'Default')}}"
      ,success:function(sukses)
        {        swal("Data Terhapus!", "Data Telah Berhasil Di Hapus!", "success");
        Datatable.draw();
      }
      ,error:function(a,b,c)
        {

      }
    });

    });
});



$('#reloadTable').on('click',function(){
Datatable.draw();
});
$('#Kembali').click(function() {
     window.history.go(-1);
   });

   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
       </script>
    </body>
</html>
