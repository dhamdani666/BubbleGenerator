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

		$this->publishes([
		__DIR__ . '/../publish/assets' => base_path('bubbleassets'),
		], 'bubbleassets');
		$this->publishes([
		__DIR__ . '/../publish/Helpers' => base_path('app/Helpers'),
		], 'bubblehelper');

	}
}