@extends('admin.adminLayout')
@section('content')
	@if(Session::has('success'))
		<p class="alert alert-danger">{{Session::get('success')}}</p>
	@endif
	<h1>ADD CATEGORY</h1>
	<form method="post" enctype="multipart/form-data">{{ csrf_field() }}
		<div class="form-group">
		    <label for="exampleFormControlInput1">Name Category</label>
		    <input type="text" class="form-control" name="name" placeholder="name post">
		</div>
		@if($errors->first('name') != '')
			<p class="alert alert-danger">{{ $errors->first('name') }}</p>
	  	@endif 
	  	<div class="form-group">
	    	<label for="exampleFormControlSelect1">Parent: </label>
	    	<select class="form-control" name="parentId">
	    		<option value="0">None</option>
		      	@foreach($categorys as $category)
				<option value="{{$category->cat_parentId}}">
				{{$category->cat_name}}
				@if($category->cat_parentId > 0)
					parentId: {{$category->cat_parentId}}
				@endif
				</option>
				@endforeach
	    	</select>
	  	</div>
	  	
	  	<button type="submit" class="btn btn-primary" name="add news">Add Category</button>
	</form>
@stop
	