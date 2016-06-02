@if ($errors->has())
      <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
      <span class="glyphicon glyphicon-remove"></span> {{ $error }}<br>        
      @endforeach
      </div>
      @endif