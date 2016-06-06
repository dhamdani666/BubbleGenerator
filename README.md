<h3><center>BubbleGenerator<center><h3>
<h4>Apa Itu BubbleGenerator ?</h4>
<p>BubbleGenerator adalah sebuah system yang membantu kita pada saat membuat sebuah project , system ini yakni Generator CRUD Laravel yang pastinya akan memudahkan kita pada membuat sebuah crud
kita tak perlu membuat manual lagi dengan adanya bubblegenerator ini kita hanya perlu memilih table mana yang akan kita generate , tidak hanya itu
disini jga ada system yaitu new table , dimana kita bisa langsung membuat sebuah table . <br>
tampilan dari pada bubblegenerator itu sendiri seperti ini :

</p>
![BubbleGenerator](https://github.com/dhamdani666/image/blob/master/bubblegenerator.png)
<p>Tampilan setelah berhasil membuat CRUD </p>
![Generate BubbleGenerator](https://github.com/dhamdani666/image/blob/master/hasil%20generate.png)
<p>
BubbleGenerator ini sudah support menggunakan :
<ul>
<li>Datatable</li>
<li>Multiple Delete Data</li>
<li>Bootstrap</li>
<li>Reload Realtime Data</li>
<li>Laravel 5.2</li>
</ul>
</p>
<h4>Cara Penggunaan BubbleGenerator</h4>
<p>
1. Instal BubbleGenerator
    <pre>"bubblegenerator/generator": "dev-master"</pre>
</p>
![Install BubbleGenerator](https://github.com/dhamdani666/image/blob/master/install.png)
<p>
2. Tambahkan Class Provider di App.php
<pre>
BubbleGenerator\Generator\BubbleGeneratorServiceProvider::class,
Yajra\Datatables\DatatablesServiceProvider::class,
Collective\Html\HtmlServiceProvider::class,
</pre>
</p>
![Providers BubbleGenerator](https://github.com/dhamdani666/image/blob/master/providers.png)
<p>
3. Buka CMD , lalu ketik perintah
    <pre>php artisan vendor:publish</pre>
</p>
<p>
4. Tambahkan code di bawah ini di composer.json tepatnya di psr-4
    <pre>
"files":[
      "app/Helpers/CreateFile.php",
      "app/Helpers/CreateFileNewTable.php"
]
</pre>
</p>
![Helpers BubbleGenerator](https://github.com/dhamdani666/image/blob/master/helpers.png)
<p>
5. Tambahkan code di bawah ini di app.php tepatnya di class aliases
    <pre>
'CreateFile' => App\Helpers\CreateFile::class,
'CreateFileNewTable' => App\Helpers\CreateFileNewTable::class,
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
</pre>
</p>
![Aliases BubbleGenerator](https://github.com/dhamdani666/image/blob/master/aliases.png)
<p>
6. Selanjutnya buka cmd kembali ketik perintah
    <pre>
composer dump-autoload
</pre>
</p>
<p>
7. Buka URL untuk membuat CRUD yaitu /bubblegenerator
</p>
![BubbleGenerator](https://github.com/dhamdani666/image/blob/master/bubblegenerator.png)
<p>
8. Apabila pada saat membuat CRUD error / not found buka CMD lalu ketikan perintah
    <pre>
php artisan route:cache
php artisan config:cache
php artisan view:clear
</pre>
</p>
<p>
9. Selamat Mencoba semoga menjadi barokah untuk kita semua dan bermanfaat untuk saya dan terumata anda semua 
</p>

<h4>Syarat Dan Ketentuan</h4>
<p>
Untuk syarat dan ketentuan project anda harus sudah terinstal 3 package di bawah ini ,
apabila anda mengikuti tutorial di atas anda tidak perlu menginstal lagi package di bawah ini , karena sudah saya instal dengan package bubblegenerator
</p>
<p>
1. yajra datatable
<pre>
Yajra datatable ini berfungsi untuk membuat datatable server side , untuk itu anda bisa mengunjungi langsung situs nya
<a href="http://datatables.yajrabox.com/" target="_blank">Yajra Datatable</a>
</pre>
</p>
<p>
2. laravel collective
<pre>
Laravel collective ini berfungsi mengaktifkan html blade di laravel , untuk itu anda bisa mengunjungi langsung situs nya
<a href="https://laravelcollective.com/docs/5.2/html" target="_blank">Laravel Collective</a>
</pre>
</p>
<p>
3. Laravel 5.0 ke atas
<pre>
Untuk penggunaan bubblegenerator ini minimal laravel yang harus di gunakan adalah 5.0 ke atas , untuk laravel 4 saya rasa belum bisa tapi saya belum mencobanya 
<a href="https://laravel.com/docs/5.2" target="_blank">Laravel</a>
</pre>
</p>
<h4>Note : </h4>
<p>
Untuk anda yang menggunakan OS Ubuntu apabila pada saat menggunakan package ini ada bermasalah coba anda ubah permission project menjadi 777 , karena bubblegenerator ini membutuhkan akses untuk membuat sebuah folder / sebuah file .
</p>
<p>
BubbleGenerator ini masih versi beta , masih banyak yang harus di perbaiki atau di tambahkan fiturnya seperti relasi , lalu primarykey dsb , itu akan segera saya tambahkan tetapi tidak untuk saat ini , tetapi insha allah akan saya update terus menerus untuk generator ini karena generator ini saya yakin akan membantu kita pada saat membuat sebuah project
<p>

<h4>
Terimakasih juga untuk :
</h4>
<ul>
<li>Allah SWT</li>
<li>Laravel</li>
<li>SweetAlert</li>
<li>Yajra Datatable</li>
<li>Laravel Collective</li>
</ul>

<h4>Hubungi saya di social media </h4>
<pre>
<a href="https://www.facebook.com/Dhamdani666" target="_blank">Facebook</a>
<a href="https://twitter.com/Dhamdani666" target="_blank">Twitter</a>
<a href="https://www.instagram.com/dhamdani666/" target="_blank">Instagram</a>
<a href="https://medium.com/@dhamdani666" target="_blank">Medium</a>
</pre>
