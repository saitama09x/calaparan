@extends('layouts.dashboardLayout')


@section('metas')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('styles')

<link rel="stylesheet" href="{{ asset('assets/blueimp/css/jquery.fileupload.css') }}">
<link rel="stylesheet" href="{{ asset('assets/blueimp/css/jquery.fileupload-ui.css') }}">

<style>
#dropzone.fade {
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
    opacity: 1;
}
#dropzone {
    background: #c5c5c5;
    width: 100%;
    height: 200px;
    text-align: center;
    font-weight: bold;
}
#fileupload {
    display: none;
}
</style>

@endpush

@push('scripts')

<script src="{{ asset('assets/blueimp/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets/blueimp/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('assets/js/custom_api.js') }}"></script>
<script src="{{ asset('assets/js/js-uploader.js') }}"></script>

<script>
$(document).ready(function(){

	var uploader = $('#fileupload').fileupload({
            dataType: 'json',
            sequentialUploads: true,
            previewThumbnail : true,
            url : "<?php echo route('upload-profile_pic'); ?>",
            maxChunkSize: 50000,
            autoUpload : true,
            beforeSend: function(xhr, data) {
		        var file = data.files[0];
		        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
		    },
            formData : {
              action : 'profile_pic'
            }
          });
	
	fileupload(uploader);

	$("#fileloader").click(function(){
		$('#fileupload').trigger("click")
	})

})
</script>

@endpush

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{"Please check the following fields " . implode(", ", $errors->all())}}
    </div>
@endif

@if(session('account_updated'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		{{session('account_updated')}}
	@endcomponent
@endif


@if(session('account_error'))
	@component('alerts.alert', ['alert_type' => 'alert-danger'])
		{{session('account_error')}}
	@endcomponent
@endif

<div class='row justify-content-center'>
<div class='col-md-9'>
	<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Update your Account</h3>
</div>
<div class="card-body">

<div class='row'>
	<div class='col-md-4'>
			<div class="card card-success">
				<div class="card-header">
					<strong>Profile Picture</strong>
				</div>
				<img class="card-img-top" src="{{($teacher->profile_pic == null) ? asset('assets/img/avatar.png') : env('APP_URL') . '/storage/app/images/' . $teacher->profile_pic}}" alt="Card image cap">
				<div class="card-body">
					<div class='pp-wrap text-center'>
						<button type='button' id="fileloader" class='btn btn-sm btn-primary'>Select Files</button>
		                <div class='pp-loading'></div>
		                <input id="fileupload" type="file" name="files"/>
					</div>	
				</div>
			</div>
	</div>
	<div class='col-md'>
		{!! Form::open(['route' => ['teacher-update-account'], 'method' => 'post']) !!}
		<div class='form-group'>
			<?php echo Form::label('username', 'Username'); ?>
			<?php echo Form::text('username', $auth->username, ['class' => 'form-control', 'placeholder' => 'username']); ?>
		</div>
		<div class='form-group'>
			<?php echo Form::label('email', 'Email'); ?>
			<?php echo Form::email('email', $auth->email, ['class' => 'form-control', 'placeholder' => 'username']); ?>
		</div>
		<div class='form-group'>
		<?php echo Form::label('password', 'Password'); ?>
		<?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password']); ?>
		</div>

		<div class='form-group'>
		<?php echo Form::label('confirm', 'Confirm Password'); ?>
		<?php echo Form::password('confirm', ['class' => 'form-control', 'placeholder' => 'Retype Password']); ?>
		</div>
		<div class='form-group'>
			<button class='btn btn-md btn-primary'>Submit</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>


</div>
</div>
</div>
</div>

@endsection