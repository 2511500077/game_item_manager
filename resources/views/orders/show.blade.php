<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Order - Game Item Manager</title>

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

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        }

        .info-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            color: #111827;
        }

        .table thead th {
            font-size: 13px;
            text-transform: uppercase;
            color: #6b7280;
            background: #f9fafb;
            padding: 15px;
        }

        .table tbody td {
            padding: 17px 15px;
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

        .status-processing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-completed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .summary-box {
            background: #f8fafc;
            border-radius: 15px;
            padding: 20px;
        }

        .profit-box {
            background: #ecfdf5;
            border-radius: 15px;
            padding: 20px;
        }

        .price {
            font-weight: 600;
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
                href="{{ url('/items') }}"
            >
                🎮 Game Item Manager
            </a>

            <span class="text-white-50 small">
                Detail Order
            </span>

        </div>

    </nav>


    <div class="container py-5">

        <!-- Header -->

        <div class="page-header">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="small text-white-50 mb-2">
                        ORDER DETAIL
                    </div>

                    <h1 class="fw-bold mb-2">
                        {{ $order->order_number }}
                    </h1>

                    <p class="mb-0 text-white-50">
                        Detail transaksi dan perhitungan keuntungan.
                    </p>

                </div>

                <div class="fs-1 d-none d-md-block">
                    🧾
                </div>

            </div>

        </div>


        <!-- Informasi Order -->

        <div class="card card-custom mb-4">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Informasi Order
                </h5>

                <div class="row g-4">

                    <!-- Pembeli -->

                    <div class="col-md-3">

                        <div class="info-label">
                            Pembeli
                        </div>

                        <div class="info-value">
                            {{ $order->buyer_name }}
                        </div>

                    </div>


                    <!-- Username -->

                    <div class="col-md-3">

                        <div class="info-label">
                            Username
                        </div>

                        <div class="info-value">
                            {{ '@' . $order->buyer_username }}
                        </div>

                    </div>


                    <!-- Tanggal -->

                    <div class="col-md-3">

                        <div class="info-label">
                            Tanggal
                        </div>

                        <div class="info-value">
                            {{ $order->transaction_date->format('d M Y H:i') }}
                        </div>

                    </div>


                    <!-- Status -->

                    <div class="col-md-3">

                        <div class="info-label">
                            Status
                        </div>

                        <div class="mt-1">

                            @if ($order->status === 'pending')

                                <span class="status status-pending">
                                    Pending
                                </span>

                            @elseif ($order->status === 'processing')

                                <span class="status status-processing">
                                    Processing
                                </span>

                            @elseif ($order->status === 'completed')

                                <span class="status status-completed">
                                    Completed
                                </span>

                            @elseif ($order->status === 'cancelled')

                                <span class="status status-cancelled">
                                    Cancelled
                                </span>

                            @else

                                <span class="status bg-secondary text-white">
                                    {{ ucfirst($order->status) }}
                                </span>

                            @endif

                        </div>


                        <!-- Ubah Status -->

                        <div class="mt-3">

                            <form
                                action="{{ route('orders.update', $order->id) }}"
                                method="POST"
                            >

                                @csrf

                                @method('PUT')

                                <select
                                    name="status"
                                    class="form-select mb-2"
                                >

                                    <option
                                        value="pending"
                                        {{ $order->status === 'pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="processing"
                                        {{ $order->status === 'processing' ? 'selected' : '' }}
                                    >
                                        Processing
                                    </option>

                                    <option
                                        value="completed"
                                        {{ $order->status === 'completed' ? 'selected' : '' }}
                                    >
                                        Completed
                                    </option>

                                    <option
                                        value="cancelled"
                                        {{ $order->status === 'cancelled' ? 'selected' : '' }}
                                    >
                                        Cancelled
                                    </option>

                                </select>

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    Ubah Status
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Item Order -->

        <div class="card card-custom mb-4">

            <div class="card-body p-0">

                <div class="p-4 border-bottom">

                    <h5 class="fw-bold mb-1">
                        Item Pesanan
                    </h5>

                    <p class="text-muted small mb-0">
                        Daftar item yang dibeli dalam order ini.
                    </p>

                </div>


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>
                                    Item
                                </th>

                                <th>
                                    Game
                                </th>

                                <th>
                                    Harga Jual
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Total
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($order->orderItems as $orderItem)

                                <tr>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $orderItem->item->name }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $orderItem->item->id }}
                                        </small>

                                    </td>


                                    <td>
                                        {{ $orderItem->item->game }}
                                    </td>


                                    <td class="price">
                                        Rp {{ number_format($orderItem->price, 0, ',', '.') }}
                                    </td>


                                    <td>
                                        {{ $orderItem->quantity }}
                                    </td>


                                    <td class="price">
                                        Rp {{ number_format($orderItem->price * $orderItem->quantity, 0, ',', '.') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- Ringkasan -->

        <div class="row g-4">

            <!-- Ringkasan Penjualan -->

            <div class="col-md-6">

                <div class="card card-custom h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Ringkasan Penjualan
                        </h5>


                        @php

                            $salesTotal = $order->orderItems->sum(function ($orderItem) {

                                return $orderItem->price * $orderItem->quantity;

                            });

                            $fee = $order->fee;

                            $netRevenue = $salesTotal - $fee;

                        @endphp


                        <div class="summary-box mb-3">

                            <div class="d-flex justify-content-between mb-3">

                                <span class="text-muted">
                                    Total Penjualan
                                </span>

                                <span class="price">
                                    Rp {{ number_format($salesTotal, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="d-flex justify-content-between mb-3">

                                <span class="text-muted">
                                    Fee
                                </span>

                                <span class="price text-danger">
                                    - Rp {{ number_format($fee, 0, ',', '.') }}
                                </span>

                            </div>


                            <hr>


                            <div class="d-flex justify-content-between">

                                <span class="fw-bold">
                                    Pendapatan Bersih
                                </span>

                                <span class="fw-bold">
                                    Rp {{ number_format($netRevenue, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Keuntungan -->

            <div class="col-md-6">

                <div class="card card-custom h-100">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Keuntungan
                        </h5>


                        @php

                            $capital = $order->orderItems->sum(function ($orderItem) {

                                return $orderItem->item->buy_price * $orderItem->quantity;

                            });

                            $profit = $netRevenue - $capital;

                        @endphp


                        <div class="profit-box">

                            <div class="d-flex justify-content-between mb-3">

                                <span class="text-muted">
                                    Modal
                                </span>

                                <span class="price">
                                    Rp {{ number_format($capital, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="d-flex justify-content-between">

                                <span class="fw-bold">
                                    Profit
                                </span>

                                <span
                                    class="fw-bold fs-4 {{ $profit >= 0 ? 'text-success' : 'text-danger' }}"
                                >
                                    Rp {{ number_format($profit, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Catatan -->

        @if ($order->note)

            <div class="card card-custom mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Catatan
                    </h5>

                    <p class="mb-0 text-muted">
                        {{ $order->note }}
                    </p>

                </div>

            </div>

        @endif


        <!-- Back -->

        <div class="mt-4">

            <a
                href="{{ route('orders.index') }}"
                class="btn btn-outline-secondary"
            >
                ← Kembali ke Orders
            </a>

        </div>

    </div>


</body>

</html>