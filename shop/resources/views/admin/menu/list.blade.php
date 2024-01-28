@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 120px">Mã Danh Mục</th>
                <th>Tên Danh Mục</th>
                <th>Hoạt Động</th>
                <th>Cập Nhật</th>
                <th style="width: 100px;">
                    <a href="/admin/menus/add">
                        <i class="fas fa-plus">
                            Thêm
                        </i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection
