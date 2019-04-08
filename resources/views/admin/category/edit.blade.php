@extends('admin.adminLayout')
@section('content')

        <div class="panel panel-default">
          <!-- Default panel contents -->
          @if($errors->first('name') != null)
            <p class="alert alert-danger">{{ $errors->first('name') }}</p>
          @endif
          @if(Session::has('success'))
            <p class="alert alert-danger">{{Session::get('success')}}</p>
          @endif
          <h1>Edit Category</h1>
          <div class="panel-body">
            <table class="table" id="table_content">
              <thead class="thead-dark">
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">parent</th>
                <th scope="col">created</th>
                <th scope="col">action</th>
            </thead>
            @foreach($categories as $item)
              <tr>
                <td>{{$item->cat_id}}</td>
                <td><p style="width: ; height: 60px" id="news_name">{{$item->cat_name}}</p></td>
                <td>
                  @foreach($categories as $item2)
                    @if($item2->cat_id == $item->cat_id)
                      <p>{{$item2->cat_name}}</p>
                    @endif
                  @endforeach
                </td>
                <td><p style="width: ; height: 30px" id="created_at">{{$item->created_at}}</p></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$item->cat_id}}">Edit</button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-del{{$item->cat_id}}">Delete</button>
                </td>
              </tr>
              <!-- modal -->
              <div class="modal fade" id="exampleModalCenter{{$item->cat_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">cat id = {{$item->cat_id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- form edit -->
                    <form method="post" enctype="multipart/form-data">{{ csrf_field() }}
                      <input type="" name="cat_id" value="{{$item->cat_id}}" hidden="true">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name Category</label>
                        <input type="text" class="form-control" name="news_name" placeholder="name post" value="{{$item->cat_name}}">
                    </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Parent</label>
                        <select name="cat_id" id="cat_id">
                        	<option value="0">None</option>
                          @foreach($categories as $item2)
                            @if($item2->cat_id == $item->cat_id)
                              <option value="{{$item2->cat_id}}" selected="">{{$item2->cat_name}}</option>
                            @else
                              <option value="{{$item2->cat_id}}">{{$item2->cat_name}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      
                      <!-- <input type="file" name="img"> -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>

                  </div>
                  
                </div>
              </div>
            </div><!--  end modal -->
            <!-- confirm delete -->
            <div class="modal fade" id="confirm-del{{$item->cat_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete Post </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/blog2/public/category/del/{{$item->cat_id}}" method="post">{{ csrf_field() }}
                  <div class="modal-body">
                      {{$item->cat_name}}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submmit" class="btn btn-danger" >Delete</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
            <!-- end confirm delete -->
            </div>
            @endforeach
          </table>
          </div>
        </div>
@stop
  <!-- Demo scripts for this page-->
