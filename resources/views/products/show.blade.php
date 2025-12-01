<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Card Detail Produk -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        <!-- Header Card -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Detail Produk</h3>
                        </div>

                        <!-- Body Card -->
                        <div class="p-6 space-y-6">
                            <!-- Gambar Produk -->
                            <div class="flex justify-center">
                                <div class="text-center">
                                    <img src="{{ $product->getImageUrlAttribute() }}" 
                                         alt="{{ $product->Name }}" 
                                         class="h-48 w-48 object-cover rounded-lg mx-auto border"
                                         onerror="this.src='{{ asset('images/default-product.png') }}'">
                                    <p class="text-sm text-gray-500 mt-2">Gambar Produk</p>
                                </div>
                            </div>

                            <!-- Informasi Utama -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Produk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                                        <p class="text-gray-900 font-semibold">{{ $product->Name }}</p>
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                                        <p class="text-green-600 font-bold text-lg">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stok -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                                    <p class="text-blue-600 font-semibold">{{ number_format($product->Stock, 0, ',', '.') }} Liter</p>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 min-h-[80px]">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $product->Description ?: 'Tidak ada deskripsi' }}</p>
                                </div>
                            </div>

                            <!-- Informasi Sistem -->
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-700 mb-3">Informasi Sistem</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <span class="font-medium">ID Produk:</span>
                                        <span class="font-mono">{{ $product->id }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Dibuat pada:</span>
                                        {{ $product->created_at ? $product->created_at->format('d/m/Y H:i') : '-' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Diupdate pada:</span>
                                        {{ $product->updated_at ? $product->updated_at->format('d/m/Y H:i') : '-' }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Status:</span>
                                        @if($product->Stock > 100)
                                            <span class="text-green-600 font-semibold">Tersedia</span>
                                        @elseif($product->Stock > 0)
                                            <span class="text-yellow-600 font-semibold">Menipis</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Card -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                                <a href="{{ route('products.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center justify-center w-full sm:w-auto"
                                   style="background-color: #6B7280 !important; border: none;">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali ke Daftar
                                </a>
                                
                                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto items-center">
                                    @if(auth()->check() && auth()->user()->role == 'admin')
                                    <a href="{{ route('products.edit', $product->id) }}"
                                    class="text-white px-5 py-2.5 rounded-lg transition duration-200 flex items-center justify-center w-full sm:w-auto"
                                    style="background-color: #3B82F6 !important; border: none; height: 42px;"
                                    onmouseover="this.style.backgroundColor='#2563EB'"
                                    onmouseout="this.style.backgroundColor='#3B82F6'">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit Produk
                                    </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-full sm:w-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-white px-5 py-2.5 rounded-lg transition duration-200 flex items-center justify-center w-full"
                                                    style="background-color: #EF4444 !important; border: none; height: 42px;"
                                                    onmouseover="this.style.backgroundColor='#DC2626'"
                                                    onmouseout="this.style.backgroundColor='#EF4444'"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->Name }}?')">
                                                <i class="fas fa-trash mr-2"></i>
                                                Hapus Produk
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* Force warna untuk semua button */
        a[href*="edit"], 
        button[type="submit"] {
            border: none !important;
            color: white !important;
            cursor: pointer !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        /* ukuran button sama */
        .action-button {
            padding: 10px 20px !important;
            height: 42px !important;
            min-width: 120px !important;
        }
    </style>
</x-app-layout>