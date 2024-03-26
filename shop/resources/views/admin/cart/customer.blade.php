@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 150px">Mã Khách Hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Ngày Đặt Hàng</th>
            <th style="width: 100px;">

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{ $customer->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{ $customer->id }}, '/admin/customers/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $customers->links() !!}
@endsection
