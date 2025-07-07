@switch($event)
    {{-- Tampilkan semua produk yang ada --}}
    @case('indexProd')
        <div class="max-w-4xl mx-auto bg-[#1b2e0e] rounded-lg shadow-lg p-4">
            <div class="grid grid-cols-3 text-center font-semibold text-black bg-[#c1d9af] p-2 rounded-t">
                <div>Nama Barang</div>
                <div>Harga Barang</div>
                <div>Stok Barang</div>
            </div>
            @foreach ($message as $product)
                <div class="grid grid-cols-3 text-center text-white border-t border-gray-600 p-2">
                    <div>{{ $product->nama }}</div>
                    <div>{{ $product->harga }}</div>
                    <div>{{ $product->stock }}</div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Buat produk baru --}}
    @case('createProd')
        <form action="{{ route('products.store') }}" method="POST"
            class="max-w-lg mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-semibold mb-1">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="w-full p-2 rounded bg-white text-black" required>
                </div>

                <div>
                    <label for="harga" class="block text-sm font-semibold mb-1">Harga Barang</label>
                    <input type="number" name="harga" id="harga" class="w-full p-2 rounded bg-white text-black" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold mb-1">Stok Barang</label>
                    <input type="number" name="stock" id="stock" class="w-full p-2 rounded bg-white text-black" required>
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN</button>
                </div>
            </div>
        </form>
    @break

    {{-- pilih salah satu dari semua produk --}}
    @case('editProd')
        <div class="max-w-4xl mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @foreach ($message as $product)
                <div class="border border-gray-600 rounded-lg p-4 mb-4">
                    <div class="mb-2">
                        <label for="nama" class="block text-sm font-semibold mb-1">Nama Barang</label>
                        <div class="bg-white text-black rounded p-2">{{ $product->nama }}</div>
                    </div>

                    <div class="mb-2">
                        <label for="harga" class="block text-sm font-semibold mb-1">Harga Barang</label>
                        <div class="bg-white text-black rounded p-2">{{ $product->harga }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-semibold mb-1">Stok Barang</label>
                        <div class="bg-white text-black rounded p-2">{{ $product->stock }}</div>
                    </div>

                    <div class="flex gap-4">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded Pilih"
                            value="{{ $product->id }}">PILIH</button>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">HAPUS</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Update produk setelah memilih --}}
    @case('showProd')
        <form action="{{ route('products.update', $message->id) }}" method="POST"
            class="max-w-lg mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-semibold mb-1">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="w-full p-2 rounded bg-white text-black"
                        value="{{ $message->nama }}" required>
                </div>

                <div>
                    <label for="harga" class="block text-sm font-semibold mb-1">Harga Barang</label>
                    <input type="number" name="harga" id="harga" class="w-full p-2 rounded bg-white text-black"
                        value="{{ $message->harga }}" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold mb-1">Stok Barang</label>
                    <input type="number" name="stock" id="stock" class="w-full p-2 rounded bg-white text-black"
                        value="{{ $message->stock }}" required>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN</button>
                </div>
            </div>
        </form>
    @break

    {{-- transaction --}}
    {{-- tampilkan semua transaction --}}
    @case('indexTrans')
        <div class="max-w-6xl mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            {{-- Header --}}
            <div class="grid grid-cols-6 text-center font-semibold text-black bg-[#c1d9af] p-2 rounded-t">
                <div>Penjual</div>
                <div>Produk</div>
                <div>Kategori</div>
                <div>Jumlah</div>
                <div>Total</div>
                <div>Waktu</div>
            </div>

            {{-- Isi Transaksi --}}
            @foreach ($message as $trans)
                <div class="grid grid-cols-6 text-center border-t border-gray-600 p-2">
                    <div>{{ optional($trans->user)->name ?? 'NA' }}</div>
                    <div>{{ optional($trans->product)->nama ?? 'NA' }}</div>
                    <div>{{ optional($trans->category)->nama ?? 'NA' }}</div>
                    <div>{{ $trans->jumlah_pembelian }}</div>
                    <div>{{ (optional($trans->product)->harga ?? 0) * $trans->jumlah_pembelian }}</div>
                    <div>{{ $trans->updated_at }}</div>
                </div>
            @endforeach
        </div>
    @break

    {{-- buat transaction baru --}}
    @case('createTrans')
        <div id="create-trans-container" class="max-w-lg mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            <form id="create-trans-form" action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama Produk --}}
                <div>
                    <label for="id_product" class="block text-sm font-semibold mb-1">Nama Produk</label>
                    <select name="id_product" id="id_product" class="w-full p-2 rounded bg-white text-black"
                        onchange="onProductSelectChange()" required>
                        <option value="">-- Pilih produk --</option>
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}"
                                data-stock="{{ $prod->stock }}">
                                {{ $prod->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga (readonly) --}}
                <div>
                    <label for="harga" class="block text-sm font-semibold mb-1">Harga</label>
                    <input type="text" id="harga" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                </div>

                {{-- Stok (readonly) --}}
                <div>
                    <label for="stock" class="block text-sm font-semibold mb-1">Stok</label>
                    <input type="text" id="stock" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category" class="block text-sm font-semibold mb-1">Kategori</label>
                    <select name="category" id="category" class="w-full p-2 rounded bg-white text-black" required>
                        <option value="">-- Pilih kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah Pembelian --}}
                <div>
                    <label for="quantity" class="block text-sm font-semibold mb-1">Jumlah Pembelian</label>
                    <input type="number" name="quantity" id="quantity" class="w-full p-2 rounded bg-white text-black"
                        min="1" onchange="onQuantityChange()" required>
                </div>

                {{-- Total Harga --}}
                <div>
                    <label for="total_harga" class="block text-sm font-semibold mb-1">Total Harga</label>
                    <input type="text" id="total_harga" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN
                        TRANSAKSI</button>
                </div>
            </form>
        </div>
    @break

    {{-- pilih salahsatu dari semua transaction --}}
    @case('editTrans')
        <div class="max-w-5xl mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @foreach ($message as $trans)
                <div class="border border-gray-600 rounded-lg p-4 mb-4 space-y-2">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Penjual</label>
                        <div class="bg-white text-black p-2 rounded">{{ optional($trans->user)->name ?? 'NA' }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Produk</label>
                        <div class="bg-white text-black p-2 rounded">{{ optional($trans->product)->nama ?? 'NA' }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Kategori</label>
                        <div class="bg-white text-black p-2 rounded">{{ optional($trans->category)->nama ?? 'NA' }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Jumlah Pembelian</label>
                        <div class="bg-white text-black p-2 rounded">{{ $trans->jumlah_pembelian }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Total</label>
                        <div class="bg-white text-black p-2 rounded">
                            {{ (optional($trans->product)->harga ?? 0) * $trans->jumlah_pembelian }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Waktu</label>
                        <div class="bg-white text-black p-2 rounded">{{ $trans->updated_at }}</div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded Pilih"
                            value="{{ $trans->id }}">PILIH</button>

                        <form action="{{ route('transactions.destroy', $trans->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">HAPUS</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Update setelah memilih --}}
    @case('showTrans')
        <div id="create-trans-container" class="max-w-lg mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            <form id="create-trans-form" action="{{ route('transactions.update', $message->id) }}" method="POST"
                class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Nama Produk (readonly) --}}
                <div>
                    <label for="id_product" class="block text-sm font-semibold mb-1">Nama Produk</label>
                    <select name="id_product" id="id_product" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                        <option selected value="{{ $message->product->id }}" data-harga="{{ $message->product->harga }}"
                            data-stock="{{ $message->product->stock }}">
                            {{ $message->product->nama }}
                        </option>
                    </select>
                </div>

                {{-- Harga (readonly) --}}
                <div>
                    <label for="harga" class="block text-sm font-semibold mb-1">Harga</label>
                    <input type="text" id="harga" class="w-full p-2 rounded bg-gray-100 text-black"
                        value="{{ $message->product->harga }}" readonly>
                </div>

                {{-- Kategori (readonly) --}}
                <div>
                    <label for="category" class="block text-sm font-semibold mb-1">Kategori</label>
                    <select name="category" id="category" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                        <option selected value="{{ $message->category->id }}">{{ $message->category->nama }}</option>
                    </select>
                </div>

                {{-- Jumlah Pembelian --}}
                <div>
                    <label for="quantity" class="block text-sm font-semibold mb-1">Jumlah Pembelian</label>
                    <input type="number" name="quantity" id="quantity" class="w-full p-2 rounded bg-white text-black"
                        min="1" onkeydown="onQuantityChange()" required>
                </div>

                {{-- Total Harga (readonly) --}}
                <div>
                    <label for="total_harga" class="block text-sm font-semibold mb-1">Total Harga</label>
                    <input type="text" id="total_harga" class="w-full p-2 rounded bg-gray-100 text-black" readonly>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN
                        PERUBAHAN</button>
                </div>
            </form>
        </div>
    @break

    {{-- category --}}
    {{-- tampilkan semua category --}}
    @case('indexCateg')
        <div class="max-w-3xl mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            {{-- Header --}}
            <div class="text-center font-semibold text-black bg-[#c1d9af] p-2 rounded-t">Nama Kategori</div>

            {{-- Isi --}}
            @foreach ($message as $category)
                <div class="text-center border-t border-gray-600 p-2">
                    {{ $category->nama }}
                </div>
            @endforeach
        </div>
    @break

    {{-- buat category baru --}}
    @case('createCateg')
        <form action="{{ route('categories.store') }}" method="POST"
            class="max-w-md mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-semibold mb-1">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="w-full p-2 rounded bg-white text-black"
                        required>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN</button>
                </div>
            </div>
        </form>
    @break

    {{-- pilih salah satu dari semua category --}}
    @case('editCateg')
        <div class="max-w-3xl mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @foreach ($message as $category)
                <div class="border border-gray-600 rounded-lg p-4 mb-4 space-y-2">
                    <div>
                        <label for="nama" class="block text-sm font-semibold mb-1">Nama Kategori</label>
                        <div class="bg-white text-black p-2 rounded">{{ $category->nama }}</div>
                    </div>

                    <div>
                        <label for="pembuatan" class="block text-sm font-semibold mb-1">Tanggal Pembuatan</label>
                        <div class="bg-white text-black p-2 rounded">{{ $category->created_at }}</div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded Pilih"
                            value="{{ $category->id }}">PILIH</button>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">HAPUS</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- update setelah memilih category --}}
    @case('showCateg')
        <form action="{{ route('categories.update', $message->id) }}" method="POST"
            class="max-w-md mx-auto bg-[#1b2e0e] text-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-semibold mb-1">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="w-full p-2 rounded bg-white text-black"
                        value="{{ $message->nama }}" required>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">SIMPAN</button>
                </div>
            </div>
        </form>
    @break

    @default
@endswitch
