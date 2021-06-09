@extends('layouts.home')


@section('content')
<div class="col-12 col-md-12">
    <div class="row">
        <div class="col-12">
            <h1>Sửa sản phẩm</h1>
        </div>
        <div class="col-12">
            <form method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="{{ $product->name }}" required>
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" class="form-control" name="price" placeholder="Nhập giá" value="{{ $product->price }}" required>
                </div>
                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="img"  required>
                </div>
                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <br />
                    <div class="input-group">
                        <select name="type_id" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            @foreach ($types as $type)
                                
                            @endforeach
                            <option >Chọn loại hàng...</option>
                            <option @if ($product->type_id == $type->id) {{ 'selected' }} @endif
                                value="{{ $type->id }}">{{ $type->name }}</option>
                    
                        </select>
                    </div>
                </div>
                

                <button type="submit" class="btn btn-primary">Sửa</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
</div>
@endsection