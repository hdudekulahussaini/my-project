
@extends('layouts.backend.app')

@section('content')
<div class="container-fluid py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">Orders Management</h4>
                <small class="text-muted">Manage customer orders and update delivery status</small>
            </div>

            <div>
                <span class="badge bg-primary">
                    Total Orders: {{ $orders->count() }}
                </span>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th width="250">Update Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr>

                                <td>
                                    #{{ $order->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $order->user->name ?? $order->name ?? 'Guest' }}
                                    </strong>
                                    <br>

                                    <small class="text-muted">
                                        {{ $order->user->email ?? $order->email ?? 'No Email' }}
                                    </small>
                                </td>

                                <td>
                                    ₹{{ number_format($order->total_amount ?? $order->total ?? 0, 2) }}
                                </td>

                                <td>
                                    @if(($order->payment_status ?? '') == 'Paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif(($order->payment_status ?? '') == 'Failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $status = $order->status ?? 'Pending';
                                    @endphp

                                    @if($status == 'Delivered')
                                        <span class="badge bg-success">{{ $status }}</span>
                                    @elseif($status == 'Cancelled')
                                        <span class="badge bg-danger">{{ $status }}</span>
                                    @elseif($status == 'Shipped')
                                        <span class="badge bg-info">{{ $status }}</span>
                                    @elseif($status == 'Processing')
                                        <span class="badge bg-primary">{{ $status }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="{{ route('orders.status', $order->id) }}" method="POST">
                                        @csrf

                                        <div class="d-flex gap-2">

                                            <select name="status" class="form-select form-select-sm">

                                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>

                                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>
                                                    Processing
                                                </option>

                                                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>
                                                    Shipped
                                                </option>

                                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                                                    Delivered
                                                </option>

                                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>

                                            </select>

                                            <button type="submit" class="btn btn-success btn-sm">
                                                Update
                                            </button>

                                        </div>

                                    </form>
                                </td>

                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="btn btn-primary btn-sm">
                                        View
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center">
                                    No Orders Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if(method_exists($orders, 'links'))
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>

    </div>

</div>
@endsection

