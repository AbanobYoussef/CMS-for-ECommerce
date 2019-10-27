@if($errors->all())
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
  </div>
 @endif


 @if(session()->has('success'))
  <div class="alert alert-success">
   <h2>{{session('success')}}</h2>
  </div>
 @endif



 <!-- @if(session()->has('errors'))
  <div class="alert alert-danger">
   <h2>{{session('errors')}}</h2>
  </div>
 @endif -->