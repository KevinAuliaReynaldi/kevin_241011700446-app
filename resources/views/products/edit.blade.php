<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Nama Produk -->
                            <div>
                                <label for="Name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input type="text" name="Name" id="Name" 
                                       value="{{ old('Name', $product->Name) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                @error('Name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga -->
                            <div>
                                <label for="Price" class="block text-sm font-medium text-gray-700">Harga</label>
                                <input type="number" name="Price" id="Price" 
                                       value="{{ old('Price', $product->Price) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       min="0" step="1" required>
                                @error('Price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div>
                                <label for="Stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="Stock" id="Stock" 
                                       value="{{ old('Stock', $product->Stock) }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       min="0" required>
                                @error('Stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gambar Produk -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                                
                                <!-- Preview gambar saat ini -->
                                @if($product->image)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                        <img src="{{ $product->getImageUrlAttribute() }}" 
                                             alt="{{ $product->Name }}" 
                                             class="h-32 w-32 object-cover rounded-lg border"
                                             onerror="this.src='{{ asset('images/default-product.png') }}'">
                                    </div>
                                @endif
                                
                                <input type="file" name="image" id="image" 
                                       accept="image/*"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar</p>
                                
                                <!-- Preview Gambar Baru -->
                                <div id="imagePreview" class="mt-2 hidden">
                                    <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                                    <img id="preview" class="h-32 w-32 object-cover rounded-lg border">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="Description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="Description" id="Description" rows="4"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('Description', $product->Description) }}</textarea>
                                @error('Description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('products.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                                    Batal
                                </a>
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                                    Update Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview image baru sebelum upload
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
</x-app-layout>