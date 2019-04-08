@extends('admin.adminLayout')
@section('content')

      @if(Session::has('success'))
        <p class="alert alert-danger">{{Session::get('success')}}</p>
      @endif
      @if($errors->first('news_name') != null)
        <p class="alert alert-danger">{{ $errors->first('news_name') }}</p>
      @endif
      @if($errors->first('news_content') != null)
        <p class="alert alert-danger">{{ $errors->first('news_content') }}</p>
      @endif
      <h1>Edit Post</h1>
      <div class="panel-body">
        <table class="table" id="table_content">
          <thead class="thead-dark">
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">img</th>
            <th scope="col">author</th>
            <!-- <th scope="col">content</th> -->
            <th scope="col">category</th>
            <th scope="col">created</th>
            <th scope="col">action</th>
        </thead>
        @foreach($listNews as $item)
          <tr>
            <td>{{$item->news_id}}</td>
            <td><p style="width: ; height: 60px" id="news_name">{{$item->news_name}}</p></td>
            <td><img src="/blog2/public/img/{{$item->news_img}}" width="60px" height="60px"></td>
            <td><p style="width: ; height: 60px" id="news_author">{{$item->news_author}}</p></td>
            <!-- <td><textarea style="width: 400px; height: 60px" id="news_content">{{$item->news_content}}</textarea></td> -->
            <td><select id="cat_id">
              @foreach($categories as $item2)
                @if($item2->cat_id == $item->cat_id)
                  <option value="{{$item2->cat_id}}" selected="">{{$item2->cat_name}}</option>
                @else
                  <option value="{{$item2->cat_id}}">{{$item2->cat_name}}</option>
                @endif
              @endforeach
            </select></td>
            <td><p style="width: ; height: 30px" id="created_at">{{$item->created_at}}</p></td>
            <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$item->news_id}}">Edit</button>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-del{{$item->news_id}}">Delete</button>
            </td>
          </tr>
          <!-- modal -->
          <div class="modal fade" id="exampleModalCenter{{$item->news_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">news id = {{$item->news_id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- form edit -->
                <form method="post" enctype="multipart/form-data">{{ csrf_field() }}
                  <input type="" name="news_id" value="{{$item->news_id}}" hidden="true">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name Post</label>
                    <input type="text" class="form-control" name="news_name" placeholder="name post" value="{{$item->news_name}}">
                    <div style="color: red">{{ $errors->first('news_name') }}</div>
                </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select name="cat_id" id="cat_id">
                      @foreach($categories as $item2)
                        @if($item2->cat_id == $item->cat_id)
                          <option value="{{$item2->cat_id}}" selected="">{{$item2->cat_name}}</option>
                        @else
                          <option value="{{$item2->cat_id}}">{{$item2->cat_name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Author</label>
                    <input type="text" class="form-control" name="news_author" placeholder="author" value="{{$item->news_author}}">
                 </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Content</label>
                    <textarea class="form-control" name="news_content" rows="3">{{$item->news_content}}</textarea>
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
        <div class="modal fade" id="confirm-del{{$item->news_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confirm Delete Post </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="/blog2/public/news/del/{{$item->news_id}}" method="post">{{ csrf_field() }}
              <div class="modal-body">
                  {{$item->news_name}}
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

@stop


