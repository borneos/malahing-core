@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-users icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Edit Master User
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
        @if(session('error'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error, </strong> {{ session('error') }}
        </div>
        @endif
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="{{ route('admin.user.update',$user) }}" method="POST">
                @method('PUT')
                  @csrf
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Name" class="form-control">
                     @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" id="email" name="email" value="{{ $user->email }}" placeholder="Email" class="form-control">
                     @error('email')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="old_password">Old Password</label>
                     <div class="input-group" id="show_hide_old_password">
                        <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control" >
                        <div class="input-group-append">
                           <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                        </div>
                     </div>
                     @error('old_password')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-group" id="show_hide_new_password">
                            <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control" >
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                        </div>
                    </div>
                    @error('new_password')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                  </div>
                  <div class="text-right mt-2">
                    <a href="{{ route('admin.users.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                    <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('js')
<script>
  $(document).ready(function(){
    $("#show_hide_old_password button").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_old_password input').attr("type") == "text"){
            $('#show_hide_old_password input').attr('type', 'password');
            $('#show_hide_old_password i').addClass("fa-eye-slash");
            $('#show_hide_old_password i').removeClass("fa-eye");
        }else if($('#show_hide_old_password input').attr("type") == "password"){
            $('#show_hide_old_password input').attr('type', 'text');
            $('#show_hide_old_password i').removeClass("fa-eye-slash");
            $('#show_hide_old_password i').addClass("fa-eye");
        }
    });
    $("#show_hide_new_password button").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_new_password input').attr("type") == "text"){
            $('#show_hide_new_password input').attr('type', 'password');
            $('#show_hide_new_password i').addClass("fa-eye-slash");
            $('#show_hide_new_password i').removeClass("fa-eye");
        }else if($('#show_hide_new_password input').attr("type") == "password"){
            $('#show_hide_new_password input').attr('type', 'text');
            $('#show_hide_new_password i').removeClass("fa-eye-slash");
            $('#show_hide_new_password i').addClass("fa-eye");
        }
    });
  });
</script>
@endsection
