@extends('admin.temp.main')

@section('admin')

<ul class="nav nav-list collapse in">
      
</ul>

<div class="header">         
    <h1 class="page-title">Posts</h1>
</div>
<div class="main-content">
  <div class="row">
      <button class="btn btn-primary col-md-2 text-white" style="margin: -15px 0px 10px 20px;"><a href="{{URL::to('/admin/addpost')}}">Add New Post</a></button>
    <div class="col-md-4">
      <input type="hidden" name="_token" id="search_token" value="{{ csrf_token() }}">
      <input type="text" id="search_cal" class="form-control" style="margin-top: -15px;" placeholder="Search by Parent">
    </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            All Posts
        </div>
        <table class="table table-bordered table-first-column-check table-hover">
          <thead>
              <tr>
                <th class="col-md-4">Date</th>
                <th>#</th>
                <th class="col-md-4">Post Title</th>
                <th class="col-md-4">Action</th>
              </tr>
          </thead>
          <tbody class="get_result">
                
          </tbody>
          <tbody class="after_search">
              <?php $i=1; ?>
              <?php foreach ($posts as $row) {?>
                  <?php $id=$row->post_id; ?>
                  <tr>
                    <td><?=$row->updated_at?></td>
                    <td><?=$i?></td>
                    <td><?=$row->post_title?></td>
                    <td>
                      <a href="{{URL::to('blog/'.$row->post_url.'/')}}" class="label label-success">View Post</a>
                      <a href="{{URL::to('admin/posts/'.$id)}}" class="label label-info">Edit Post</a>
                      <a href="" class="label label-danger" data-toggle="modal" data-target="#exampleModal">Delete</a>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this post?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                              <a href="{{URL::to('admin/posts/'.$id.'/delete')}}" class="btn btn-primary">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                   </tr>
                  <?php $i=$i+1; ?>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    "use strict";
    $('#search_cal').keyup(function(){
        var val = $('#search_cal').val();
        var token=$('#search_token').val();
        if (val!='') {
          $.ajax({
            type: "post",
            url: "{{URL::to('admin/posts')}}",
            data: {
              data : val,
              _token : token
            },
            success: function(data){
              $('.get_result').html(data);
              $('.after_search').css('display','none');
            },
          });
        }else{
          $.ajax({
            type: "post",
            url: "{{URL::to('admin/posts')}}",
            data: {
              data : 'mubeen',
              _token : token
            },
            success: function(data){
              $('.get_result').html(data);
              $('.after_search').css('display','none');
            },
          });
        }
    });
});
</script>
             

@endsection