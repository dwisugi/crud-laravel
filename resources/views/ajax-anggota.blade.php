<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>laravel 6 First Ajax CRUD Application</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
 <style>
   .container{
    padding: 0.5%;
   } 
</style>
</head>
<body>
 
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">laravel 6 First Ajax CRUD Application</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-anggota">Tambah Anggota</a> 
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody id="anggota-crud">
              @foreach($anggota as $u_info)
              <tr id="anggota_id_{{ $u_info->id }}">
                 <td>{{ $u_info->id  }}</td>
                 <td>{{ $u_info->nama }}</td>
                 <td><a href="javascript:void(0)" id="edit-anggota" data-id="{{ $u_info->id }}" class="btn btn-info">Edit</a></td>
                 <td>
                  <a href="javascript:void(0)" id="delete-anggota" data-id="{{ $u_info->id }}" class="btn btn-danger delete-anggota">Delete</a></td>
              </tr>
              @endforeach
           </tbody>
          </table>
          {{ $anggota->links() }}
       </div> 
    </div>
</div>
{{-- Model --}}
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="anggotaCrudModal"></h4>
          </div>
          <div class="modal-body">
              <form id="userForm" name="anggotaForm" class="form-horizontal">
                 <input type="hidden" name="anggota_id" id="anggota_id">
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                      </div>
                  </div>
                  <div class="col-cm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save</button>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              {{-- <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes
              </button> --}}
          </div>
      </div>
    </div>
  </div>
 
</body>

</html>
<script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      /*  When user click add user button */
      $('#create-new-anggota').click(function () {
          $('#btn-save').val("create-anggota");
          $('#anggotaForm').trigger("reset");
          $('#anggotaCrudModal').html("Tambah Anggota Baru");
          $('#ajax-crud-modal').modal('show');
      });
   
     /* When click edit user */
      $('body').on('click', '#edit-anggota', function () {
        var anggota_id = $(this).data('id');
        $.get('ajax-anggota/' + anggota_id +'/edit', function (data) {
           $('#anggotaCrudModal').html("Edit Anggota");
            $('#btn-save').val("edit-anggota");
            $('#ajax-crud-modal').modal('show');
            $('#anggota_id').val(data.id);
            $('#name').val(data.nama);
        })
     });
     //delete user login
      $('body').on('click', '.delete-anggota', function () {
          var anggota_id = $(this).data("id");
          var r = confirm("Are You sure want to delete !");
   
          if (r == true) { 
              $.ajax({
              type: "DELETE",
              url: "{{ url('ajax-anggota')}}"+'/'+anggota_id,
              success: function (data) {
                  $("#l" + anggota_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
      });
   
    });
   
   if ($("#anggotaForm").length > 0) {
        $("#anggotaForm").validate({
   
       submitHandler: function(form) {
   
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
        
        $.ajax({
            data: $('#anggotaForm').serialize(),
            url: "{{ route('ajax-anggota.store')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var user = '<tr id="anggota_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.nama + '</td>;
                user += '<td><a href="javascript:void(0)" id="edit-anggota" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                user += '<td><a href="javascript:void(0)" id="delete-anggota" data-id="' + data.id + '" class="btn btn-danger delete-anggota">Delete</a></td></tr>';
                 
                
                if (actionType == "create-anggota") {
                    $('#anggota-crud').prepend(user);
                } else {
                    $("#anggota_id_" + data.id).replaceWith(user);
                }
   
                $('#userForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');
                
            },
            error: function (data) {
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    })
  }
     
    
  </script>