<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'game' => 'required',
        'buy_price' => 'required|numeric',
        'sell_price' => 'required|numeric',
        'stock' => 'required|integer',
        'status' => 'required',
    ]);

    Item::create([
        'name' => $request->name,
        'game' => $request->game,
        'buy_price' => $request->buy_price,
        'sell_price' => $request->sell_price,
        'stock' => $request->stock,
        'status' => $request->status,
    ]);

    return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
    $request->validate([
        'name' => 'required',
        'game' => 'required',
        'buy_price' => 'required|numeric',
        'sell_price' => 'required|numeric',
        'stock' => 'required|integer',
        'status' => 'required',
    ]);

    $item->update([
        'name' => $request->name,
        'game' => $request->game,
        'buy_price' => $request->buy_price,
        'sell_price' => $request->sell_price,
        'stock' => $request->stock,
        'status' => $request->status,
    ]);

    return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }
}