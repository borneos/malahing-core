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
               Add Master User
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="{{ route('admin.user.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" placeholder="Name" class="form-control">
                     @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                     @error('email')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <div class="input-group" id="show_hide_password">
                        <input type="password" id="password" name="password" class="form-control" >
                        <div class="input-group-append">
                           <button type="button" class="btn btn-light" ><i class="fa fa-eye-slash"></i></button>
                        </div>
                     </div>
                     @error('password')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                  </div>
                  <div class="text-right mt-2">
                     <a href="{{ route('admin.users.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                     <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
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
      $("#show_hide_password button").on('click', function(event) {
         event.preventDefault();
         if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("fa-eye-slash");
            $('#show_hide_password i').removeClass("fa-eye");
         }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("fa-eye-slash");
            $('#show_hide_password i').addClass("fa-eye");
         }
      });
  });
</script>
@endsection
