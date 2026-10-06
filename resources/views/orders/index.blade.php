<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Game Item Manager</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar {
            background: #111827 !important;
        }

        .page-header {
            background: linear-gradient(135deg, #111827, #2563eb);
            border-radius: 20px;
            color: white;
            padding: 30px;
            margin-bottom: 25px;
        }

        .stat-card,
        .table-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px;
        }

        .table tbody td {
            padding: 17px 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .order-number {
            font-weight: 600;
            color: #111827;
        }

        .buyer-name {
            font-weight: 600;
            color: #111827;
        }

        .buyer-username {
            color: #6b7280;
            font-size: 13px;
        }

        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #b45309;
        }

        .status-completed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-processing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .price {
            font-weight: 600;
            color: #111827;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 45px;
        }

        .btn {
            border-radius: 9px;
            font-weight: 500;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/items') }}">
                🎮 Game Item Manager
            </a>

            <span class="text-white-50 small">
                Orders
            </span>
        </div>
    </nav>

    <div class="container py-5">

        <!-- Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="small text-white-50 mb-2">
                        ORDER MANAGEMENT
                    </div>

                    <h1 class="fw-bold mb-2">
                        Orders
                    </h1>

                    <p class="mb-0 text-white-50">
                        Kelola pesanan dan transaksi item game kamu.
                    </p>
                </div>

                <div class="fs-1 d-none d-md-block">
                    🛒
                </div>

            </div>
        </div>

        <!-- Statistik -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            TOTAL ORDER
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $orders->count() }}
                            </h2>

                            <span class="fs-3">
                                🛒
                            </span>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            ORDER SELESAI
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $orders->where('status', 'completed')->count() }}
                            </h2>

                            <span class="fs-3">
                                ✅
                            </span>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            ORDER PENDING
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $orders->where('status', 'pending')->count() }}
                            </h2>

                            <span class="fs-3">
                                ⏳
                            </span>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Table -->
        <div class="card table-card">

            <div class="card-body p-0">

                <div class="p-4 border-bottom">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Daftar Order
                            </h5>

                            <p class="text-muted small mb-0">
                                Semua pesanan yang tercatat dalam sistem.
                            </p>
                        </div>

                        <a
                            href="{{ url('/orders/create') }}"
                            class="btn btn-primary">
                                + Tambah Order
                        </a>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Pembeli</th>
                                <th>Status</th>
                                <th>Fee</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($orders as $order)

                                <tr>

                                    <td>
                                        <div class="order-number">
                                            {{ $order->order_number }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $order->id }}
                                        </small>
                                    </td>

                                    <td>

                                        <div class="buyer-name">
                                            {{ $order->buyer_name }}
                                        </div>

                                        <div class="buyer-username">
                                            {{ '@' . $order->buyer_username }}
                                        </div>

                                    </td>

                                    <td>

                                        @if ($order->status == 'pending')

                                            <span class="status status-pending">
                                                Pending
                                            </span>

                                        @elseif ($order->status == 'processing')

                                            <span class="status status-processing">
                                                Processing
                                            </span>

                                        @elseif ($order->status == 'completed')

                                            <span class="status status-completed">
                                                Completed
                                            </span>

                                        @elseif ($order->status == 'cancelled')

                                            <span class="status status-cancelled">
                                                Cancelled
                                            </span>

                                        @else

                                            <span class="status bg-secondary text-white">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <span class="price">
                                            Rp {{ number_format($order->fee, 0, ',', '.') }}
                                        </span>

                                    </td>

                                    <td>

                                        <div>
                                            {{ $order->transaction_date->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $order->transaction_date->format('H:i') }}
                                        </small>

                                    </td>

                                    <td>

                                        <a
    href="{{ route('orders.show', $order->id) }}"
    class="btn btn-sm btn-outline-primary"
>
    Detail
</a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center">

                                        <div class="empty-state">

                                            <div class="empty-icon mb-3">
                                                🛒
                                            </div>

                                            <h5 class="fw-bold">
                                                Belum ada order
                                            </h5>

                                            <p class="text-muted">
                                                Belum ada transaksi yang tercatat.
                                            </p>

                                            <a
                                                href="{{ url('/orders/create') }}"
                                                class="btn btn-primary">
                                                    + Tambah Order
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>