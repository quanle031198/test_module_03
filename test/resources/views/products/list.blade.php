@extends('layouts.home')
{{-- @section('title', __('language.title_head')) --}}
@section('title', 'Coffee Shop')

@section('content')
    <h2>@yield('title') </h2>
    @if (Session::has('success'))
                <p class="text-success">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    {{ Session::get('success') }}
                </p>
            @endif
            @if (Session::has('error'))
                <p class="text-danger">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ Session::get('error') }}
                </p>
            @endif
    <table class="table table-striped">
        <thead>
            <tr style="background-color: #d3c8a7;">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Loại sản phẩm</th>
                <th>Chức năng</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                  <td>{{ ++$key }}</td>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if ($product->img)
                            <img src="{{ asset('storage/' . $product->img) }}" alt="" style="width: 130px; height: 130px">
                        @else
                            {{ 'Not image !' }}
                        @endif
                    </td>
                    <td>{{ $product->type->name }}</td>

                    <td> <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm">Chỉnh sửa</a>|<a
                            href="{{ route('product.delete',$product->id) }}" class="btn btn-sm">Xóa</a></td>
            @endforeach
            </tr>
        </tbody>
    </table>
@endsection
