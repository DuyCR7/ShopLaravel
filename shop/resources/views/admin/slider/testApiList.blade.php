@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 120px">Mã Slider</th>
            <th>Tiêu Đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Hoạt Động</th>
            <th>Cập Nhật</th>
            <th style="width: 100px;">
                <a href="{{ route('sliders.create') }}">
                    <i class="fas fa-plus">
                        Thêm
                    </i>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $key => $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td>
                    <a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </td>
                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('sliders.show', [$slider->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
