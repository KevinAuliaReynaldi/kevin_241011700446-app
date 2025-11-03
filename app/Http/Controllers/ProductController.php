<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|integer|min:1',
            'Stock' => 'required|integer|min:0'
        ]);

        try {
            // Simpan ke database
            Product::create($validated);

            return redirect()->route('products.index')
                ->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validasi data
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|integer|min:1',
            'Stock' => 'required|integer|min:0'
        ]);

        try {
            // Update data produk
            $product->update($validated);

            return redirect()->route('products.index')
                ->with('success', 'Produk berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}