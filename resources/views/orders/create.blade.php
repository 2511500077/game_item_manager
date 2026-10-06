<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Order - Game Item Manager</title>

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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 11px 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
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

        .section-title {
            font-weight: 700;
            color: #111827;
        }

        .item-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark">
        <div class="container">

            <a
                class="navbar-brand fw-bold"
                href="{{ url('/items') }}"
            >
                🎮 Game Item Manager
            </a>

            <span class="text-white-50 small">
                Tambah Order
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
                        Tambah Order
                    </h1>

                    <p class="mb-0 text-white-50">
                        Masukkan data pesanan pelanggan.
                    </p>

                </div>

                <div class="fs-1 d-none d-md-block">
                    🛒
                </div>

            </div>

        </div>


        <!-- Form -->
        <div class="card form-card">

            <div class="card-body p-4 p-md-5">

                <form
                    action="{{ url('/orders') }}"
                    method="POST"
                >

                    @csrf


                    <!-- Data Pembeli -->
                    <h5 class="section-title mb-4">
                        Data Pembeli
                    </h5>

                    <div class="row g-4 mb-5">

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Pembeli
                            </label>

                            <input
                                type="text"
                                name="buyer_name"
                                class="form-control"
                                placeholder="Contoh: Afdal"
                                required
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Username Pembeli
                            </label>

                            <input
                                type="text"
                                name="buyer_username"
                                class="form-control"
                                placeholder="Contoh: afdal123"
                                required
                            >

                        </div>

                    </div>


                    <!-- Item Pesanan -->
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="section-title mb-0">
                            Item Pesanan
                        </h5>

                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm"
                            onclick="addItem()"
                        >
                            + Tambah Item
                        </button>

                    </div>


                    <div id="items-container">

                        <!-- Item pertama -->
                        <div class="item-box">

                            <div class="row g-3 align-items-end">

                                <div class="col-md-7">

                                    <label class="form-label fw-semibold">
                                        Pilih Item
                                    </label>

                                    <select
                                        name="items[0][item_id]"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            -- Pilih Item --
                                        </option>

                                        @foreach ($items as $item)

                                            <option value="{{ $item->id }}">

                                                {{ $item->name }}
                                                -
                                                {{ $item->game }}
                                                -
                                                Rp {{ number_format($item->sell_price, 0, ',', '.') }}
                                                (Stock: {{ $item->stock }})

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-md-3">

                                    <label class="form-label fw-semibold">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        name="items[0][quantity]"
                                        class="form-control"
                                        min="1"
                                        value="1"
                                        required
                                    >

                                </div>


                                <div class="col-md-2">

                                    <button
                                        type="button"
                                        class="btn btn-outline-danger w-100"
                                        onclick="removeItem(this)"
                                        disabled
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Fee & Status -->
                    <h5 class="section-title mb-4 mt-5">
                        Transaksi
                    </h5>


                    <div class="row g-4 mb-5">

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Fee
                            </label>

                            <input
                                type="number"
                                name="fee"
                                class="form-control"
                                min="0"
                                value="0"
                                placeholder="0"
                            >

                            <div class="form-text">
                                Masukkan biaya admin/platform jika ada.
                            </div>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="processing">
                                    Processing
                                </option>

                                <option value="completed">
                                    Completed
                                </option>

                                <option value="cancelled">
                                    Cancelled
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Catatan -->
                    <div class="mb-5">

                        <label class="form-label fw-semibold">
                            Catatan
                        </label>

                        <textarea
                            name="note"
                            class="form-control"
                            rows="4"
                            placeholder="Catatan tambahan untuk order..."
                        ></textarea>

                    </div>


                    <!-- Button -->
                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ url('/orders') }}"
                            class="btn btn-outline-secondary"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Simpan Order
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script>

        let itemIndex = 1;


        function addItem() {

            const container = document.getElementById('items-container');


            const itemBox = document.createElement('div');

            itemBox.className = 'item-box';


            itemBox.innerHTML = `

                <div class="row g-3 align-items-end">

                    <div class="col-md-7">

                        <label class="form-label fw-semibold">
                            Pilih Item
                        </label>

                        <select
                            name="items[${itemIndex}][item_id]"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Item --
                            </option>

                            @foreach ($items as $item)

                                <option value="{{ $item->id }}">

                                    {{ $item->name }}
                                    -
                                    {{ $item->game }}
                                    -
                                    Rp {{ number_format($item->sell_price, 0, ',', '.') }}
                                    (Stock: {{ $item->stock }})

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Quantity
                        </label>

                        <input
                            type="number"
                            name="items[${itemIndex}][quantity]"
                            class="form-control"
                            min="1"
                            value="1"
                            required
                        >

                    </div>


                    <div class="col-md-2">

                        <button
                            type="button"
                            class="btn btn-outline-danger w-100"
                            onclick="removeItem(this)"
                        >
                            Hapus
                        </button>

                    </div>

                </div>

            `;


            container.appendChild(itemBox);

            itemIndex++;

        }


        function removeItem(button) {

            const itemBox = button.closest('.item-box');

            itemBox.remove();

        }

    </script>

</body>

</html>