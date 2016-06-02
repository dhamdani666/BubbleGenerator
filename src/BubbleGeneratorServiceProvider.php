<?php 


namespace BubbleGenerator\Generator;

use Illuminate\Support\ServiceProvider;

/**
* 
*/
class BubbleGeneratorServiceProvider extends ServiceProvider
{
	

	public function register()
	{

		$this->app->bind('generator',function($app){
			return new Generator;

		});


	}

	public function boot()
	{

		require __DIR__ .'/Http/routes.php';
		$this->loadViewsFrom(__DIR__ .'/../views','bubblegenerator');

$viewsfolder = base_path('public');

if(is_dir($viewsfolder)){
 	$this->publishes([
		__DIR__ . '/publish/assets' => base_path('public/bubbleassets'),
		]);
}else{
 			$this->publishes([
		__DIR__ . '/publish/assets' => base_path('bubbleassets'),
		]);
}
		$this->publishes([
		__DIR__ . '/publish/Helpers' => base_path('app/Helpers'),
		]);

		$this->publishes([
		__DIR__ . '/publish/layouts' => base_path('resources/views/bubblelayouts'),
		]);

		$this->publishes([
		__DIR__ . '/publish/informasi' => base_path('resources/views/bubbleinformasi'),
		]);


	}
}