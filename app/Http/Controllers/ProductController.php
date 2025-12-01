<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Handle upload gambar - SIMPAN LANGSUNG KE PUBLIC
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Buat folder jika belum ada
                $imagePath = public_path('images/products');
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0755, true);
                }
                
                // Pindahkan gambar ke public/images/products
                $image->move($imagePath, $imageName);
                $validated['image'] = $imageName;
                
                \Log::info('Image saved to public folder:', [
                    'path' => $imagePath . '/' . $imageName,
                    'size' => filesize($imagePath . '/' . $imageName)
                ]);
            }

            // Simpan data ke database
            Product::create($validated);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('products.index')
                            ->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika terjadi error, redirect kembali dengan pesan error
            \Log::error('Store product error: ' . $e->getMessage());
            return redirect()->back()
                            ->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi data
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Handle upload gambar
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($product->image) {
                    $oldImagePath = public_path('images/products/' . $product->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Pindahkan gambar baru ke public/images/products
                $imagePath = public_path('images/products');
                $image->move($imagePath, $imageName);
                $validated['image'] = $imageName;
            }

            // Update data
            $product->update($validated);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('products.index')
                            ->with('success', 'Produk berhasil diupdate!');

        } catch (\Exception $e) {
            // Jika terjadi error, redirect kembali dengan pesan error
            \Log::error('Update product error: ' . $e->getMessage());
            return redirect()->back()
                            ->with('error', 'Gagal mengupdate produk: ' . $e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Hapus gambar jika ada
            if ($product->image) {
                $imagePath = public_path('images/products/' . $product->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $product->delete();

            return redirect()->route('products.index')
                            ->with('success', 'Produk berhasil dihapus!');

        } catch (\Exception $e) {
            \Log::error('Delete product error: ' . $e->getMessage());
            return redirect()->route('products.index')
                            ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}
