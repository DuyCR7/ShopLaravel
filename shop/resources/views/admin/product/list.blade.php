@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 120px">Mã Sản Phẩm</th>
            <th>Tên Sản Phẩm</th>
            <th>Ảnh</th>
            <th>Giá Gốc</th>
            <th>Giá Sale</th>
            <th>Danh Mục</th>
            <th>Hoạt Động</th>
            <th>Cập Nhật</th>
            <th style="width: 100px;">
                <a href="/admin/products/add">
                    <i class="fas fa-plus">
                        Thêm
                    </i>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td><img src="{{ $product->thumb }}" width="100px"></td>
                <td>{{ number_format($product->price, 0, '.', '.') }}</td>
                <td>{{ number_format($product->price_sale, 0, '.', '.') }}</td>
                <td>{{ $product->menu->name }}</td>     {{-- menu chính là relationship, name là cột name của bảng menu --}}
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $products->links() !!}
@endsection
