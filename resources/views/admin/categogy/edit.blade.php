@extends('layouts.admin')
@section('content')
<style>
    .custom-select {
    display: inline-block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    line-height: 1.5;
    color: #495057;
    vertical-align: middle;
    background: #fff url(data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E) no-repeat right 0.75rem center;
    background-size: 8px 10px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
<div class="container">
    <h2>Cập nhập danh mục</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
        
    @endif


    <form method="POST" action="{{route('categogy.update',[$editdanhmuc->id])}}">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Tên danh mục</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="categogyName" value="{{$editdanhmuc->categogyName}}" placeholder="...">
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mô tả</label>
          <input type="text" class="form-control" id="exampleInputPassword1" value="{{$editdanhmuc->short_Desc}}" placeholder="..." name="short_Desc" >
        </div>
        <div class="form-group">
            <select class="custom-select" name="status">
            	@if($editdanhmuc->status==1)
                <option selected value="1" >kích hoạt</option>
                <option value="2" >Không kích hoạt</option>

                @else
                <option value="1" >Kích hoạt</option>

                <option value="2" >Không kích hoạt</option>
    			@endif
              </select>
              
          </div>

        <button style="float: left; min-width: 100px; margin:5px; " type="submit" name="addCategogy" class="btn btn-success">Thêm</button>
      </form>
      <a style="float: left;   min-width: 100px;    margin:5px;" class="btn btn-secondary" href="{{route('comebackCategogy')}}"> 
        Hủy
     </a>
</div>


</div>
<div style="min-height: 70"></div>
@endsection
