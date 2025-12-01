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

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
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

                        <!-- Gambar Produk -->
                        <div class="space-y-2">
                            <label for="image" class="block text-sm font-medium text-gray-700">
                                Gambar Produk
                            </label>
                            <input type="file" 
                                   name="image" 
                                   id="image"
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Maksimal 2MB)</p>
                            
                            <!-- Preview Gambar -->
                            <div id="imagePreview" class="mt-2 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                <img id="preview" class="h-32 w-32 object-cover rounded-lg border">
                            </div>
                        </div>

                        <!-- Button Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 border-t border-gray-200">
                            <a href="{{ route('products.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center w-full sm:w-auto order-2 sm:order-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Daftar
                            </a>
                            
                            <button type="submit" 
                                    class="save-product-btn bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg transition duration-200 flex items-center justify-center shadow-lg hover:shadow-xl w-full sm:w-auto font-semibold order-1 sm:order-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview image sebelum upload
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>

    <style>
        .save-product-btn {
            background-color: #10B981 !important;
            color: white !important;
            border: none;
            cursor: pointer;
        }
        
        .save-product-btn:hover {
            background-color: #059669 !important;
            transform: translateY(-1px);
        }
        
        .save-product-btn:active {
            transform: translateY(0);
        }
    </style>
</x-app-layout>