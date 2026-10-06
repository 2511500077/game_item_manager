<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory - Game Item Manager</title>

    <!-- Bootstrap 5.3 -->
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
        }

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

        .item-name {
            font-weight: 600;
            color: #111827;
        }

        .game-name {
            color: #6b7280;
        }

        .price {
            font-weight: 600;
            color: #111827;
        }

        .stock-badge {
            background: #eef2ff;
            color: #4f46e5;
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: 600;
        }

        .status-available {
            background: #dcfce7;
            color: #15803d;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-soldout {
            background: #fee2e2;
            color: #dc2626;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
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

        .empty-state {
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 45px;
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
                Inventory
            </span>

        </div>
    </nav>


    <!-- Main Content -->
    <div class="container py-5">

        <!-- Header -->
        <div class="page-header">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="small text-white-50 mb-2">
                        INVENTORY MANAGEMENT
                    </div>

                    <h1 class="fw-bold mb-2">
                        Inventory
                    </h1>

                    <p class="mb-0 text-white-50">
                        Kelola stok dan harga item game kamu.
                    </p>

                </div>

                <div class="fs-1 d-none d-md-block">
                    📦
                </div>

            </div>

        </div>


        <!-- Statistics -->
        <div class="row g-4 mb-4">

            <!-- Total Item -->
            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            TOTAL ITEM
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $items->count() }}
                            </h2>

                            <span class="fs-3">
                                📦
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Total Stock -->
            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            TOTAL STOCK
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $items->sum('stock') }}
                            </h2>

                            <span class="fs-3">
                                📊
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Available -->
            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <div class="text-muted small mb-2">
                            ITEM AVAILABLE
                        </div>

                        <div class="d-flex justify-content-between align-items-end">

                            <h2 class="fw-bold mb-0">
                                {{ $items->where('status', 'available')->count() }}
                            </h2>

                            <span class="fs-3">
                                ✅
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Table Card -->
        <div class="card table-card">

            <div class="card-body p-0">

                <!-- Table Header -->
                <div class="p-4 border-bottom">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Daftar Item
                            </h5>

                            <p class="text-muted small mb-0">
                                Semua item yang tersedia di inventory.
                            </p>

                        </div>

                        <a
                            href="{{ url('/items/create') }}"
                            class="btn btn-primary"
                        >
                            + Tambah Item
                        </a>

                    </div>

                </div>


                <!-- Table -->
                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>
                                <th>Item</th>
                                <th>Game</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($items as $item)

                                <tr>

                                    <!-- Item -->
                                    <td>

                                        <div class="item-name">
                                            {{ $item->name }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $item->id }}
                                        </small>

                                    </td>


                                    <!-- Game -->
                                    <td>

                                        <span class="game-name">
                                            {{ $item->game }}
                                        </span>

                                    </td>


                                    <!-- Buy Price -->
                                    <td>

                                        <span class="price">
                                            Rp {{ number_format($item->buy_price, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    <!-- Sell Price -->
                                    <td>

                                        <span class="price">
                                            Rp {{ number_format($item->sell_price, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    <!-- Stock -->
                                    <td>

                                        <span class="stock-badge">
                                            {{ $item->stock }}
                                        </span>

                                    </td>


                                    <!-- Status -->
                                    <td>

                                        @if ($item->status == 'available')

                                            <span class="status-available">
                                                Available
                                            </span>

                                        @else

                                            <span class="status-soldout">
                                                Sold Out
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Actions -->
                                    <td>

                                        <div class="d-flex gap-2">

                                            <!-- Edit -->
                                            <a
                                                href="{{ url('/items/' . $item->id . '/edit') }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                Edit
                                            </a>


                                            <!-- Delete -->
                                            <form
                                                action="{{ url('/items/' . $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus item ini?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center"
                                    >

                                        <div class="empty-state">

                                            <div class="empty-icon mb-3">
                                                📦
                                            </div>

                                            <h5 class="fw-bold">
                                                Belum ada item
                                            </h5>

                                            <p class="text-muted">
                                                Tambahkan item pertama kamu ke inventory.
                                            </p>

                                            <a
                                                href="{{ url('/items/create') }}"
                                                class="btn btn-primary"
                                            >
                                                + Tambah Item
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


    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>