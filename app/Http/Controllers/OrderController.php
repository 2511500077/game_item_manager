<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.item')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $items = \App\Models\Item::where('stock', '>', 0)
            ->where('status', 'available')
            ->get();

        return view('orders.create', compact('items'));
    }

    public function store(Request $request)
{
    $request->validate([
        'buyer_name' => 'required',
        'buyer_username' => 'required',
        'items' => 'required|array|min:1',
        'items.*.item_id' => 'required|exists:items,id',
        'items.*.quantity' => 'required|integer|min:1',
        'fee' => 'nullable|numeric|min:0',
        'status' => 'required',
        'note' => 'nullable',
    ]);

    DB::transaction(function () use ($request) {

        // Buat order
        $order = Order::create([
            'user_id' => 1,
            'order_number' => 'ORD-' . date('YmdHis') . rand(100, 999),
            'buyer_name' => $request->buyer_name,
            'buyer_username' => $request->buyer_username,
            'fee' => $request->fee ?? 0,
            'status' => $request->status,
            'note' => $request->note,
            'transaction_date' => now(),
            'deadline' => null,
        ]);

        // Proses setiap item
        foreach ($request->items as $orderItem) {

            $item = Item::findOrFail($orderItem['item_id']);

            $quantity = $orderItem['quantity'];

            // Cek stock
            if ($quantity > $item->stock) {
                throw new \Exception(
                    'Stock item "' . $item->name . '" tidak mencukupi.'
                );
            }

            // Simpan item ke order_items
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
                'price' => $item->sell_price,
            ]);

            // Kurangi stock
            $item->decrement('stock', $quantity);

            // Jika stock habis
            if ($item->fresh()->stock <= 0) {
                $item->update([
                    'status' => 'sold out',
                ]);
            }
        }
    });

    return redirect()
        ->route('orders.index')
        ->with('success', 'Order berhasil dibuat.');
}

public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    $oldStatus = $order->status;
    $newStatus = $request->status;

    // Tidak ada perubahan status
    if ($oldStatus === $newStatus) {
        return back()->with('success', 'Status order tidak berubah.');
    }

    DB::transaction(function () use ($order, $oldStatus, $newStatus) {

        // Jika order sebelumnya belum cancelled
        // lalu sekarang menjadi cancelled,
        // kembalikan stock.
        if ($oldStatus !== 'cancelled' && $newStatus === 'cancelled') {

            foreach ($order->orderItems as $orderItem) {

                $item = Item::find($orderItem->item_id);

                if ($item) {

                    $item->increment(
                        'stock',
                        $orderItem->quantity
                    );

                    $item->update([
                        'status' => 'available',
                    ]);
                }
            }
        }


        // Jika order sebelumnya cancelled
        // lalu diaktifkan kembali,
        // kurangi stock lagi.
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {

            foreach ($order->orderItems as $orderItem) {

                $item = Item::find($orderItem->item_id);

                if (!$item) {
                    continue;
                }

                if ($orderItem->quantity > $item->stock) {

                    throw new \Exception(
                        'Stock item "' . $item->name . '" tidak mencukupi untuk mengaktifkan kembali order.'
                    );
                }

                $item->decrement(
                    'stock',
                    $orderItem->quantity
                );

                if ($item->fresh()->stock <= 0) {

                    $item->update([
                        'status' => 'sold out',
                    ]);
                }
            }
        }


        // Simpan status baru
        $order->update([
            'status' => $newStatus,
        ]);
    });

    return back()->with(
        'success',
        'Status order berhasil diubah menjadi ' . ucfirst($newStatus) . '.'
    );
}

    public function show(Order $order)
    {
    $order->load('orderItems.item');

    return view('orders.show', compact('order'));
    }
}