<h3>BubbleGenerator<h3>
<h4>Apa Itu BubbleGenerator ?</h4>
BubbleGenerator adalah sebuah system yang membantu kita pada saat membuat sebuah project , system ini yakni Generator CRUD Laravel yang pastinya akan memudahkan kita pada membuat sebuah crud
kita tak perlu membuat manual lagi dengan adanya bubblegenerator ini kita hanya perlu memilih table mana yang akan kita generate , tidak hanya itu
disini jga ada system yaitu new table , dimana kita bisa langsung membuat sebuah table <br><br>
BubbleGenerator ini sudah support menggunakan :
<li>Datatable</li>
<li>Multiple Delete Data</li>
<li>Bootstrap</li>
<li>Reload Realtime Data</li>
<h4>Cara Penggunaan</h4>
1.	Install bubblegenerator dengan cara <br>
        "bubblegenerator/generator": "dev-master"
2.	Setelah selesai install selanjutnya masukan class provider ini di app.php
BubbleGenerator\Generator\BubbleGeneratorServiceProvider::class,
Yajra\Datatables\DatatablesServiceProvider::class,
3.	Selanjutnya ketikan perintah di cmd anda
php artisan vendor:publish
4.	Lihat di project terdapat folder baru yakni css , js dan juga helper<br>
css dan js -> bubbleassets<br>
untuk helper -> app/Helpers<br>
terdapat jga folder di resource
-> bubblelayouts
5.	Selanjutnya Masukan code di bawah ini di composer.json tepatnya di bawah psr-4<br>
"files":[<br>
            "app/Helpers/CreateFile.php",<br>
            "app/Helpers/CreateFileNewTable.php"<br>
      ]
6.	Selanjutnya buka config/app.php lalu tambahkan kode dibawah ini :<br>
'CreateFile' => App\Helpers\CreateFile::class,<br>
 'CreateFileNewTable' => App\Helpers\CreateFileNewTable::class,<br>
tepatnya di aliases
7.	Selanjutnya , ketikan perintah composer dump-autoload
8.	Buka URL untuk menggenerate project anda  yakni
/Bubblegenerator
9.	Apabila eror buka cmd anda lalu ketikan perintah php artisan route:cache , php artisan config:cache , php artisan view:clear
10.	Selamat Mencoba semoga menjadi barokah untuk kita semua dan bermanfaat untuk saya dan terumata anda semua .


Mohon Maaf Apabila Masih Banyak Kekurangan Dari System nya dikarenkan system ini masih Beta dan banyak yang harus di perbaiki<br>
Terimakasih juga untuk :
<li>Bootstrap</li>
<li>SweetAlert</li>
<li>Datatable</li>
<li>YajraBox Datatable</li>
<li>Laravel</li>


i <3 Laravel
