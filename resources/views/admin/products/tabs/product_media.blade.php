<div id="Product_Media" class="tab-pane fade">
  <hr>

  <h3>Product Main</h3>
  <div class="dropzone" id="mainphoto"></div>

  <hr>

  <h3>Product Photos</h3>
  <div class="dropzone" id="dropzonefileupload"></div>

  <hr>
</div>

@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<script type="text/javascript">
	$(document).ready(function(){
		Dropzone.autoDiscover = false;

		$('#dropzonefileupload').dropzone({
			url:"{{aurl('upload/image/'.$Product->id)}}",
			paramName:'file',
			uploadMultiple:false,
			maxFiles:15,
			maxFilessize:2,
			acceptedFiles:'image/*',
			dictDefaultMessage:'upload files',
			params:{
				_token:'{{csrf_token()}}'
			},
			addRemoveLinks:true,
			removedfile:function(file){
				$.ajax({
					dataType:'json',
					type:'post',
					url:'{{aurl("delete/image")}}',
					data:{_token:'{{csrf_token()}}',id:file.fid}
				});
				var fmock;
				return (fmock=file.previewElement)!=null?fmock.parentNode.removeChild(file.previewElement):void 0;
			},
			init:function(){
				@foreach($Product->files()->get() as $file)
					var mock={name :'{{$file->name}}',fid:'{{ $file->id }}',size:'{{ $file->size }}',type:'{{ $file->mime_type }}'};
					this.emit('addedfile',mock);
					this.options.thumbnail.call(this,mock,'{{Storage::url($file->full_file)}}');
					$('.dz-progress').remove();
				@endforeach

				this.on('sending',function(file,xhr,formData){
					formData.append('fid','');
					file.id='';
				});

				this.on('success',function(file,response){
					file.id=response.id;
				});
			}
		});



		$('#mainphoto').dropzone({
			url:"{{aurl('upload/product/image/'.$Product->id)}}",
			paramName:'file',
			uploadMultiple:false,
			maxFiles:15,
			maxFilessize:2,
			acceptedFiles:'image/*',
			dictDefaultMessage:'upload Main Photo',
			params:{
				_token:'{{csrf_token()}}'
			},
			addRemoveLinks:true,
			removedfile:function(file){
				$.ajax({
					dataType:'json',
					type:'post',
					url:'{{aurl("delete/product/image/".$Product->id)}}',
					data:{_token:'{{csrf_token()}}'}
				});
				var fmock;
				return (fmock=file.previewElement)!=null?fmock.parentNode.removeChild(file.previewElement):void 0;
			},
			init:function(){
				@if(!empty($Product->photo))
					var mock={name :'{{$Product->title}}',size:'',type:''};
					this.emit('addedfile',mock);
					this.options.thumbnail.call(this,mock,'{{Storage::url($Product->photo)}}');
					$('.dz-progress').remove();
				@endif

				this.on('sending',function(file,xhr,formData){
					formData.append('fid','');
					file.id='';
				});

				this.on('success',function(file,response){
					file.id=response.id;
				});
			}
		});
	});
</script>
<style type="text/css">
	.dz-image img{
		width: 100px;
		height: 100px;
	}
</style>
@endpush