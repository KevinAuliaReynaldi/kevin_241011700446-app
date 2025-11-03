<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    <!-- Alert Messages -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <strong class="font-semibold">Terjadi kesalahan:</strong>
                            <ul class="list-disc list-inside mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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

                    <form action="{{ route('products.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <!-- Nama Produk -->
                        <div class="space-y-2">
                            <label for="Name" class="block text-sm font-medium text-gray-700">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="Name" 
                                   id="Name" 
                                   value="{{ old('Name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Contoh: Pertamax, Pertalite, dll."
                                   required
                                   autofocus>
                            @error('Name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2">
                            <label for="Description" class="block text-sm font-medium text-gray-700">
                                Deskripsi
                            </label>
                            <textarea name="Description" 
                                      id="Description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                      placeholder="Deskripsi singkat tentang produk bahan bakar...">{{ old('Description') }}</textarea>
                            @error('Description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga dan Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Harga -->
                            <div class="space-y-2">
                                <label for="Price" class="block text-sm font-medium text-gray-700">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="Price" 
                                       id="Price" 
                                       value="{{ old('Price') }}"
                                       min="1"
                                       step="1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="10000"
                                       required>
                                @error('Price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div class="space-y-2">
                                <label for="Stock" class="block text-sm font-medium text-gray-700">
                                    Stok (Liter) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="Stock" 
                                       id="Stock" 
                                       value="{{ old('Stock') }}"
                                       min="0"
                                       step="1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="1000"
                                       required>
                                @error('Stock')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Button Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 border-t border-gray-200">
                            <a href="{{ route('products.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center w-full sm:w-auto order-2 sm:order-1">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Daftar
                            </a>
                            
                            <button type="submit" 
                                    class="save-product-btn bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg transition duration-200 flex items-center justify-center shadow-lg hover:shadow-xl w-full sm:w-auto font-semibold order-1 sm:order-2">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* Custom CSS untuk button Simpan Produk */
        .save-product-btn {
            background-color: #10B981 !important; /* green-500 */
            color: white !important;
            border: none;
            cursor: pointer;
        }
        
        .save-product-btn:hover {
            background-color: #059669 !important; /* green-600 */
            transform: translateY(-1px);
        }
        
        .save-product-btn:active {
            transform: translateY(0);
        }
    </style>
</x-app-layout>