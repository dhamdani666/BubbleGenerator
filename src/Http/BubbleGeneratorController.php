<?php 

namespace BubbleGenerator\Generator\Http;
use App\Http\Controllers\Controller;

class BubbleGeneratorController extends Controller
{


public function getIndex(){
	return "Generator Builder";
}
}