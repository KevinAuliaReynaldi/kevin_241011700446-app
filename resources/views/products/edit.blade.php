<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Alert Messages -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
                            <strong class="font-semibold">Terjadi kesalahan:</strong>
                            <ul class="list-disc list-inside mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Produk -->
                        <div class="mb-3">
                            <label for="Name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="Name" 
                                   id="Name" 
                                   value="{{ old('Name', $product->Name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Contoh: Pertamax, Pertalite, dll."
                                   required
                                   autofocus>
                            @error('Name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="Description" class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi
                            </label>
                            <textarea name="Description" 
                                      id="Description" 
                                      rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Deskripsi singkat tentang produk bahan bakar...">{{ old('Description', $product->Description) }}</textarea>
                            @error('Description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga dan Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                            <!-- Harga -->
                            <div>
                                <label for="Price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="Price" 
                                       id="Price" 
                                       value="{{ old('Price', $product->Price) }}"
                                       min="1"
                                       step="1"
                                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="10000"
                                       required>
                                @error('Price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="Stock" class="block text-sm font-medium text-gray-700 mb-1">
                                    Stok (Liter) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="Stock" 
                                       id="Stock" 
                                       value="{{ old('Stock', $product->Stock) }}"
                                       min="0"
                                       step="1"
                                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="1000"
                                       required>
                                @error('Stock')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Informasi Produk -->
                        <div class="bg-gray-50 p-2 rounded mb-3">
                            <h4 class="font-semibold text-gray-700 text-sm mb-1">Informasi Produk</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 text-xs text-gray-600">
                                <div>
                                    <span class="font-medium">ID Produk:</span> {{ $product->id }}
                                </div>
                                <div>
                                    <span class="font-medium">Dibuat pada:</span> {{ $product->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div>
                                    <span class="font-medium">Diupdate pada:</span> {{ $product->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                        <!-- Button Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-3 border-t border-gray-200">
                            <a href="{{ route('products.index') }}" 
                               class="text-white px-5 py-2.5 rounded flex items-center justify-center w-full sm:w-auto order-2 sm:order-1 text-sm"
                               style="background-color: #6B7280 !important; border: none; height: 42px;">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Kembali ke Daftar
                            </a>
                            
                            <div class="flex flex-col sm:flex-row gap-3 order-1 sm:order-2 w-full sm:w-auto items-center">
                                <!-- Button Reset -->
                                <button type="reset" 
                                        class="text-white px-5 py-2.5 rounded flex items-center justify-center w-full sm:w-auto text-sm"
                                        style="background-color: #EAB308 !important; border: none; height: 42px;"
                                        onmouseover="this.style.backgroundColor='#CA8A04'"
                                        onmouseout="this.style.backgroundColor='#EAB308'">
                                    <i class="fas fa-undo mr-1"></i>
                                    Reset
                                </button>
                                
                                <!-- Button Update -->
                                <button type="submit" 
                                        class="text-white px-5 py-2.5 rounded flex items-center justify-center w-full sm:w-auto font-semibold text-sm"
                                        style="background-color: #10B981 !important; border: none; height: 42px;"
                                        onmouseover="this.style.backgroundColor='#059669'"
                                        onmouseout="this.style.backgroundColor='#10B981'">
                                    <i class="fas fa-save mr-1"></i>
                                    Update Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* Force warna untuk semua button */
        button[type="reset"],
        button[type="submit"],
        a[href="{{ route('products.index') }}"] {
            border: none !important;
            color: white !important;
            cursor: pointer !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 120px !important;
        }
    </style>
</x-app-layout>