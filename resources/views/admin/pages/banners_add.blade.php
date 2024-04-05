@extends('master')
@section('content')
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh Sách Banners</li>
        <li class="breadcrumb-item"><a href="#">Thêm Mới Banner</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Thêm Mới Banner</h3>
          <div class="tile-body">
            <form class="row" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group col-md-3">
                <label class="control-label">Tên Banner</label>
                <input class="form-control" type="text" name="name">
                @error('name')
                <div class="alert alert-danger cl-red">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-3 ">
                <label for="exampleSelect1" class="control-label">Trạng Thái</label>
                <select class="form-control" id="" name="status">
                  <option>-- Chọn trạng thái--</option>
                  <option value="0">Ẩn</option>
                  <option value="1">Hiện</option>
                </select>
              </div>
              <div class="form-group col-md-3 ">
                <label for="exampleSelect1" class="control-label">Danh Mục</label>
                <select name="category_id" class="form-control" id="">
                  <option>-- Chọn tình trạng --</option>
                  @foreach ($Category as $item)
                     <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                 
                </select>
              </div>
              <div class="form-group col-md-12 m-3">
                <label class="control-label pr-1">Ảnh:</label>
                <input type="file"  id="imageInput" name="image"/>
                <div id="imagePreview"  class="m-3"></div>
              </div>
            </div>
            <div class="table-td-center">
              <button type="submit" class="btn btn-success">Lưu</button>
              <button type="submit" class="btn btn-danger">Hủy</button>
            </div>
          </form>
        </div>
        </div>
        <script>
          document.getElementById('imageInput').addEventListener('change', function(event) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear previous preview
        
            var file = event.target.files[0];
            if (file) {
              var reader = new FileReader();
              reader.onload = function(e) {
                var img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                img.setAttribute('alt', 'Preview Image');
                img.setAttribute('class', 'img-fluid'); // Optional: adjust class for styling
                imagePreview.appendChild(img);
              }
              reader.readAsDataURL(file);
            }
          });
        </script>
        
@endsection
