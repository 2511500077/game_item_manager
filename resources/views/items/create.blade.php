<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Item - Game Item Manager</title>

    <!-- Bootstrap -->
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

        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .form-control,
        .form-select,
        .input-group-text {
            border-radius: 10px;
        }

        .form-control,
        .form-select {
            padding: 12px 14px;
        }

        .input-group .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            background: #f3f4f6;
            font-weight: 600;
        }

        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            border-color: #2563eb;
        }

        .btn {
            border-radius: 10px;
            padding: 10px 18px;
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

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
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
                        INVENTORY
                    </div>

                    <h1 class="fw-bold mb-2">
                        Tambah Item
                    </h1>

                    <p class="mb-0 text-white-50">
                        Tambahkan item game baru ke dalam inventory kamu.
                    </p>
                </div>

                <div class="fs-1 d-none d-md-block">
                    📦
                </div>

            </div>

        </div>


        <!-- Form -->
        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card form-card">

                    <div class="card-body p-4 p-md-5">

                        <div class="section-title">
                            Informasi Item
                        </div>

                        <form
                            action="{{ url('/items') }}"
                            method="POST"
                        >

                            @csrf


                            <!-- Nama Item -->
                            <div class="mb-4">

                                <label
                                    for="name"
                                    class="form-label fw-semibold"
                                >
                                    Nama Item
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Contoh: Ominous Ouija"
                                    required
                                >

                            </div>


                            <!-- Game -->
                            <div class="mb-4">

                                <label
                                    for="game"
                                    class="form-label fw-semibold"
                                >
                                    Game
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="game"
                                    name="game"
                                    placeholder="Contoh: Roblox"
                                    required
                                >

                            </div>


                            <!-- Harga -->
                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label
                                        for="buy_price"
                                        class="form-label fw-semibold"
                                    >
                                        Harga Beli
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input
                                            type="number"
                                            class="form-control"
                                            id="buy_price"
                                            name="buy_price"
                                            placeholder="50000"
                                            min="0"
                                            required
                                        >

                                    </div>

                                </div>


                                <div class="col-md-6 mb-4">

                                    <label
                                        for="sell_price"
                                        class="form-label fw-semibold"
                                    >
                                        Harga Jual
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input
                                            type="number"
                                            class="form-control"
                                            id="sell_price"
                                            name="sell_price"
                                            placeholder="64979"
                                            min="0"
                                            required
                                        >

                                    </div>

                                </div>

                            </div>


                            <!-- Stock & Status -->
                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label
                                        for="stock"
                                        class="form-label fw-semibold"
                                    >
                                        Stock
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="stock"
                                        name="stock"
                                        placeholder="2"
                                        min="0"
                                        required
                                    >

                                </div>


                                <div class="col-md-6 mb-4">

                                    <label
                                        for="status"
                                        class="form-label fw-semibold"
                                    >
                                        Status
                                    </label>

                                    <select
                                        class="form-select"
                                        id="status"
                                        name="status"
                                        required
                                    >

                                        <option value="available">
                                            Available
                                        </option>

                                        <option value="sold_out">
                                            Sold Out
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <!-- Divider -->
                            <hr class="my-4">


                            <!-- Buttons -->
                            <div class="d-flex justify-content-between align-items-center">

                                <a
                                    href="{{ url('/items') }}"
                                    class="btn btn-light border"
                                >
                                    ← Kembali
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    💾 Simpan Item
                                </button>

                            </div>

                        </form>

                    </div>

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