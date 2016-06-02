<?php 


Route::get('bubblegenerator','BubbleGenerator\Generator\Http\BubbleGeneratorController@getIndex');
Route::get('bubbletable','BubbleGenerator\Generator\Http\BubbleGeneratorController@getTable');
Route::get('bubblenewtable','BubbleGenerator\Generator\Http\BubbleGeneratorController@getNewTable');
Route::post('bubbleCreateController_Table', 'BubbleGenerator\Generator\Http\BubbleGeneratorController@PostCreateController_Table');
Route::post('bubbleShowTable', 'BubbleGenerator\Generator\Http\BubbleGeneratorController@PostShowTable');