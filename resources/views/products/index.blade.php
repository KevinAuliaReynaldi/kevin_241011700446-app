<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Notifikasi -->
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

                    <!-- Header dengan Button Create -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Data Produk</h3>
                        <a href="{{ route('products.create') }}" class="bg-white hover:bg-gray-800 text-black px-5 py-2.5 rounded-lg transition duration-200 flex items-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Data
                        </a>
                    </div>

                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 text-left border">No</th>
                                <th class="p-2 text-left border">Nama</th>
                                <th class="p-2 text-left border">Deskripsi</th>
                                <th class="p-2 text-left border">Harga</th>
                                <th class="p-2 text-left border">Stok</th>
                                <th class="p-2 text-left border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                            <tr>
                                <td class="p-2 border">{{ $loop->iteration }}</td>
                                <td class="p-2 border">{{ $p->Name }}</td>
                                <td class="p-2 border">{{ $p->Description ?: '-' }}</td>
                                <td class="p-2 border">Rp {{ number_format($p->Price, 0, ',', '.') }}</td>
                                <td class="p-2 border">{{ number_format($p->Stock, 0, ',', '.') }}</td>
                                <td class="p-2 border">
                                    <div class="flex space-x-4 justify-center items-center">
                                        <!-- Button Lihat -->
                                        <a href="{{ route('products.show', $p->id) }}" 
                                           class="text-white px-4 py-2 rounded text-sm transition duration-200" 
                                           style="background-color: #6B7280; border: none; margin: 0 5px;"
                                           onmouseover="this.style.backgroundColor='#4B5563'"
                                           onmouseout="this.style.backgroundColor='#6B7280'"
                                           title="Lihat">
                                            Lihat
                                        </a>
                                        <!-- Button Edit -->
                                        <a href="{{ route('products.edit', $p->id) }}" 
                                           class="text-white px-4 py-2 rounded text-sm transition duration-200" 
                                           style="background-color: #3B82F6; border: none; margin: 0 5px;"
                                           onmouseover="this.style.backgroundColor='#2563EB'"
                                           onmouseout="this.style.backgroundColor='#3B82F6'"
                                           title="Edit">
                                            Edit
                                        </a>
                                        <!-- Button Delete -->
                                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline" style="margin: 0 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-white px-4 py-2 rounded text-sm transition duration-200" 
                                                    style="background-color: #EF4444; border: none;"
                                                    onmouseover="this.style.backgroundColor='#DC2626'"
                                                    onmouseout="this.style.backgroundColor='#EF4444'"
                                                    title="Hapus" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk {{ $p->Name }}?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Info jika tidak ada data -->
                    @if($products->count() == 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>Belum ada data produk. <a href="{{ route('products.create') }}" class="text-blue-500 hover:text-blue-700">Klik di sini</a> untuk menambahkan produk pertama.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Font Awesome untuk ikon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</x-app-layout>