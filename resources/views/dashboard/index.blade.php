<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Game Item Manager</title>

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

        .stat-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            background: #eff6ff;
        }

        .content-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        }

        .table > :not(caption) > * > * {
            padding: 14px 12px;
        }

        .badge-status {
            padding: 7px 10px;
            border-radius: 8px;
            font-weight: 500;
        }

        .profit-card {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
        }

        .btn {
            border-radius: 9px;
            font-weight: 500;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark">

        <div class="container">

            <a
                class="navbar-brand fw-bold"
                href="{{ url('/dashboard') }}"
            >
                🎮 Game Item Manager
            </a>

            <div class="d-flex gap-2">

                <a
                    href="{{ url('/items') }}"
                    class="btn btn-outline-light btn-sm"
                >
                    Inventory
                </a>

                <a
                    href="{{ url('/orders') }}"
                    class="btn btn-outline-light btn-sm"
                >
                    Orders
                </a>

            </div>

        </div>

    </nav>


    <div class="container py-5">

        <!-- Header -->
        <div class="page-header">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="small text-white-50 mb-2">
                        OVERVIEW
                    </div>

                    <h1 class="fw-bold mb-2">
                        Dashboard
                    </h1>

                    <p class="mb-0 text-white-50">
                        Pantau inventory, order, penjualan, dan profit bisnis kamu.
                    </p>

                </div>

                <div class="fs-1 d-none d-md-block">
                    📊
                </div>

            </div>

        </div>


        <!-- Statistik -->
        <div class="row g-4 mb-4">

            <!-- Total Item -->
            <div class="col-md-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="text-muted small mb-2">
                                    Total Item
                                </div>

                                <h3 class="fw-bold mb-1">
                                    {{ $totalItems }}
                                </h3>

                                <small class="text-success">
                                    {{ $availableItems }} tersedia
                                </small>

                            </div>

                            <div class="stat-icon">
                                📦
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Order -->
            <div class="col-md-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="text-muted small mb-2">
                                    Total Order
                                </div>

                                <h3 class="fw-bold mb-1">
                                    {{ $totalOrders }}
                                </h3>

                                <small class="text-muted">
                                    {{ $completedOrders }} completed
                                </small>

                            </div>

                            <div class="stat-icon">
                                🛒
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Penjualan -->
            <div class="col-md-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="text-muted small mb-2">
                                    Total Penjualan
                                </div>

                                <h3 class="fw-bold mb-1">
                                    Rp {{ number_format($totalSales, 0, ',', '.') }}
                                </h3>

                                <small class="text-muted">
                                    Fee Rp {{ number_format($totalFee, 0, ',', '.') }}
                                </small>

                            </div>

                            <div class="stat-icon">
                                💰
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Profit -->
            <div class="col-md-6 col-xl-3">

                <div class="card stat-card profit-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <div class="small text-white-50 mb-2">
                                    Total Profit
                                </div>

                                <h3 class="fw-bold mb-1">
                                    Rp {{ number_format($totalProfit, 0, ',', '.') }}
                                </h3>

                                <small class="text-white-50">
                                    Dari order completed
                                </small>

                            </div>

                            <div class="fs-2">
                                📈
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Informasi -->
        <div class="row g-4 mb-4">

            <!-- Inventory -->
            <div class="col-lg-4">

                <div class="card content-card h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            📦 Inventory
                        </h5>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Item tersedia
                            </span>

                            <strong>
                                {{ $availableItems }}
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Sold out
                            </span>

                            <strong>
                                {{ $soldOutItems }}
                            </strong>

                        </div>

                        <hr>

                        <a
                            href="{{ url('/items') }}"
                            class="btn btn-outline-primary w-100"
                        >
                            Kelola Inventory
                        </a>

                    </div>

                </div>

            </div>


            <!-- Order Status -->
            <div class="col-lg-4">

                <div class="card content-card h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            🛒 Status Order
                        </h5>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Completed
                            </span>

                            <span class="badge bg-success badge-status">
                                {{ $completedOrders }}
                            </span>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Pending
                            </span>

                            <span class="badge bg-warning text-dark badge-status">
                                {{ $pendingOrders }}
                            </span>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Total Order
                            </span>

                            <strong>
                                {{ $totalOrders }}
                            </strong>

                        </div>

                        <hr>

                        <a
                            href="{{ url('/orders') }}"
                            class="btn btn-outline-primary w-100"
                        >
                            Lihat Semua Order
                        </a>

                    </div>

                </div>

            </div>


            <!-- Keuangan -->
            <div class="col-lg-4">

                <div class="card content-card h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            💵 Keuangan
                        </h5>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Penjualan
                            </span>

                            <strong>
                                Rp {{ number_format($totalSales, 0, ',', '.') }}
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Modal
                            </span>

                            <strong>
                                Rp {{ number_format($totalCapital, 0, ',', '.') }}
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Fee
                            </span>

                            <strong>
                                Rp {{ number_format($totalFee, 0, ',', '.') }}
                            </strong>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">

                            <span class="fw-semibold">
                                Profit
                            </span>

                            <strong class="text-primary">
                                Rp {{ number_format($totalProfit, 0, ',', '.') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Order Terbaru -->
        <div class="card content-card">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="fw-bold mb-0">
                        Order Terbaru
                    </h5>

                    <a
                        href="{{ url('/orders') }}"
                        class="btn btn-sm btn-outline-primary"
                    >
                        Lihat Semua
                    </a>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Order</th>

                                <th>Pembeli</th>

                                <th>Item</th>

                                <th>Status</th>

                                <th>Total</th>

                                <th></th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($latestOrders as $order)

                                @php
                                    $orderTotal = $order->orderItems->sum(function ($orderItem) {
                                        return $orderItem->price * $orderItem->quantity;
                                    });
                                @endphp

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $order->order_number }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $order->buyer_name }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $order->buyer_username }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $order->orderItems->count() }} item
                                    </td>

                                    <td>

                                        @if ($order->status === 'completed')

                                            <span class="badge bg-success badge-status">
                                                Completed
                                            </span>

                                        @elseif ($order->status === 'pending')

                                            <span class="badge bg-warning text-dark badge-status">
                                                Pending
                                            </span>

                                        @elseif ($order->status === 'processing')

                                            <span class="badge bg-info badge-status">
                                                Processing
                                            </span>

                                        @else

                                            <span class="badge bg-danger badge-status">
                                                Cancelled
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        Rp {{ number_format($orderTotal, 0, ',', '.') }}
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

                                    <td
                                        colspan="6"
                                        class="text-center text-muted py-5"
                                    >
                                        Belum ada order.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>

</html>