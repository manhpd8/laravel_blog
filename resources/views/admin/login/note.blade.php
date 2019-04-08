
	@if (count($errors) > 0)
	   <div class = "alert alert-danger">
	      <ul>
	         @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	         @endforeach
	      </ul>
	   </div>
	   {{$errors->toArray()}}
	@endif
@if(Session::has('error'))

<p class="alert alert-danger">{{Session::get('error')}}</p>

@endif



@if(Session::has('success'))

<p class="alert alert-success">{{Session::get('success')}}</p>

@endif