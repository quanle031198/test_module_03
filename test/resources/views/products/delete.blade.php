@extends('layouts.home')
@section('content')
<div class="col-12 col-md-12">
    <div class="row">
        <div class="col-12">
            <h1>Xóa sản phẩm</h1>
        </div>
        <div class="col-12">
            <form method="POST" action="{{ route('product.destroy',$product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="{{ $product->name }}" disabled>
                </div>


                <button type="submit" class="btn btn-primary">Sửa</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
</div>
@endsection