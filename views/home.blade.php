@extends('bubblelayouts.template')
@section('content')

<div class="container">

<div class="row">
	<div class="col-md-6"><a href="{{URL('bubbletable')}}" style="cursor: pointer; text-decoration: none;"><button type="button" class="form-control btn-primary">CRUD BY LIST TABLE</button></a></div>
	<div class="col-md-6"><a href="{{URL('bubblenewtable')}}" style="cursor: pointer; text-decoration: none;"><button type="button" class="form-control btn-primary">CRUD BY NEW TABLE</button></a></div>
</div>

</div>
@stop