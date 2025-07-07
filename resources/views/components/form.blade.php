@switch($event)
    {{-- Tampilkan semua produk yang ada --}}
    @case('indexProd')
        <div>
            <div class="flex flex-row justify-evenly items-center my-4 border-black border-solid border-2">
                <label for="nama" class="block text-sm font-medium w-full">Nama Barang</label>
                <label for="harga" class="block text-sm font-medium w-full">Harga Barang</label>
                <label for="stock" class="block text-sm font-medium w-full">Stok Barang</label>
            </div>
            @foreach ($message as $product)
                <div
                    class="border-collapse flex flex-row justify-center items-center mx-auto my-4 border border-solid border-gray-800">
                    <div class="w-full ">
                        {{ $product->nama }}
                    </div>

                    <div class="w-full">
                        {{ $product->harga }}
                    </div>

                    <div class="w-full">
                        {{ $product->stock }}
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Buat produk baru --}}
    @case('createProd')
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="space-y-4 flex flex-col justify-between items-center">
                <div class="grow w-full">
                    <label for="nama" class="block text-sm font-medium">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="border rounded w-full p-2" required>
                </div>

                <div class="grow w-full">
                    <label for="harga" class="block text-sm font-medium">Harga Barang</label>
                    <input type="number" name="harga" id="harga" class="border rounded w-full p-2" required>
                </div>

                <div class="grow w-full">
                    <label for="stock" class="block text-sm font-medium">Stok Barang</label>
                    <input type="number" name="stock" id="stock" class="border rounded w-full p-2" required>
                </div>

                <button type="submit"
                    class="dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    @break

    {{-- pilih salah satu dari semua produk --}}
    @case('editProd')
        <div>
            @foreach ($message as $product)
                <div class="space-y-4 flex flex-col justify-center items-center mx-auto my-4 border-black border-solid">
                    <div class="w-full">
                        <label for="nama" class="block text-sm font-medium">Nama Barang</label>
                        {{ $product->nama }}
                    </div>

                    <div class="w-full">
                        <label for="harga" class="block text-sm font-medium">Harga Barang</label>
                        {{ $product->harga }}
                    </div>

                    <div class="w-full">
                        <label for="stock" class="block text-sm font-medium">Stok Barang</label>
                        {{ $product->stock }}
                    </div>
                    <div>
                        <button class="Pilih" value="{{ $product->id }}">Pilih</button>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Update produk setelah memilih --}}
    @case('showProd')
        <form action="{{ route('products.update', $message->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 flex flex-col justify-between items-center">
                <div class="grow w-full">
                    <label for="nama" class="block text-sm font-medium">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="border rounded w-full p-2"
                        value="{{ $message->nama }}" required>
                </div>

                <div class="grow w-full">
                    <label for="harga" class="block text-sm font-medium">Harga Barang</label>
                    <input type="number" name="harga" id="harga" class="border rounded w-full p-2"
                        value="{{ $message->harga }}" required>
                </div>

                <div class="grow w-full">
                    <label for="stock" class="block text-sm font-medium">Stok Barang</label>
                    <input type="number" name="stock" id="stock" class="border rounded w-full p-2"
                        value="{{ $message->stock }}" required>
                </div>

                <button type="submit"
                    class="dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    @break

    {{-- transaction --}}
    {{-- tampilkan semua transaction --}}
    @case('indexTrans')
        <div>
            <div class="flex flex-row justify-evenly items-center my-4 border-black border-solid border-2">
                <label class="block text-sm font-medium w-full">penjual</label>
                <label class="block text-sm font-medium w-full">produk</label>
                <label class="block text-sm font-medium w-full">kategori</label>
                <label class="block text-sm font-medium w-full">jumlah pembelian</label>
                <label class="block text-sm font-medium w-full">total harga</label>
                <label class="block text-sm font-medium w-full">Waktu transaksi</label>
            </div>
            @foreach ($message as $trans)
                <div
                    class="border-collapse flex flex-row justify-center items-center mx-auto my-4 border border-solid border-gray-800">
                    <div class="w-full ">
                        {{ optional($trans->user)->name ?? 'NA' }}
                    </div>

                    <div class="w-full">
                        {{ optional($trans->product)->nama ?? 'NA' }}
                    </div>

                    <div class="w-full">
                        {{ optional($trans->category)->nama ?? 'NA' }}
                    </div>
                    <div class="w-full">
                        {{ $trans->jumlah_pembelian }}
                    </div>
                    <div class="w-full">
                        {{ (optional($trans->product)->harga ?? 0) * $trans->jumlah_pembelian }}
                    </div>
                    <div class="w-full">
                        {{ $trans->updated_at }}
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- buat transaction baru --}}
    @case('createTrans')
        <div id="create-trans-container">
            <form id="create-trans-form" action="{{ route('transactions.store') }}" method="POST"
                class="space-y-4 flex flex-col items-start">
                @csrf

                {{-- 1. Nama Produk (select dengan data-harga & data-stock) --}}
                <div class="w-full">
                    <label for="id_product" class="block text-sm font-medium">Nama Produk</label>
                    <select name="id_product" id="id_product" class="border p-2 w-full" onchange="onProductSelectChange()" required>
                        <option value="">-- Pilih produk --</option>
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}" data-stock="{{ $prod->stock }}">
                                {{ $prod->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 2. Harga (readonly) --}}
                <div class="w-full">
                    <label for="harga" class="block text-sm font-medium">Harga</label>
                    <input type="text" id="harga" class="border p-2 w-full bg-gray-100" readonly>
                </div>

                {{-- 3. Stok (readonly) --}}
                <div class="w-full">
                    <label for="stock" class="block text-sm font-medium">Stok</label>
                    <input type="text" id="stock" class="border p-2 w-full bg-gray-100" readonly>
                </div>

                {{-- 4. Kategori (dropdown) --}}
                <div class="w-full">
                    <label for="category" class="block text-sm font-medium">Kategori</label>
                    <select name="category" id="category" class="border p-2 w-full" required>
                        <option value="">-- Pilih kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 5. Jumlah Pembelian --}}
                <div class="w-full">
                    <label for="quantity" class="block text-sm font-medium">Jumlah Pembelian</label>
                    <input type="number" name="quantity" id="quantity" class="border p-2 w-full"
                        min="1" onchange="onQuantityChange()" required>
                </div>

                {{-- 6. Total Harga (readonly) --}}
                <div class="w-full">
                    <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
                    <input type="text" id="total_harga" class="border p-2 w-full bg-gray-100" readonly>
                </div>

                <button  type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                    Simpan Transaksi
                </button>
            </form>
        </div>
    @break

    {{-- pilih salahsatu dari semua transaction --}}
    @case('editTrans')
        <div>
            @foreach ($message as $trans)
                <div class="space-y-4 flex flex-col justify-center items-center mx-auto my-4 border-black border-solid">
                    <div class="w-full">
                        <label class="block text-sm font-medium">Nama Penjual</label>
                        {{ optional($trans->user)->name ?? 'NA' }}
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium">Nama Produk</label>
                        {{ optional($trans->product)->nama ?? 'NA' }}
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium">Kategori</label>
                        {{ optional($trans->category)->nama ?? 'NA' }}
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium">Jumlah Pembelian</label>
                        {{ $trans->jumlah_pembelian }}
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium">Total</label>
                        {{ (optional($trans->product)->harga ?? 0) * $trans->jumlah_pembelian }}
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium">Waktu</label>
                        {{ $trans->updated_at }}
                    </div>

                    <div>
                        <button class="Pilih" value="{{ $trans->id }}">Pilih</button>

                        <form action="{{ route('transactions.destroy', $trans->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- Update setelah memilih --}}
    @case('showTrans')
         <div id="create-trans-container">
            <form id="create-trans-form" action="{{ route('transactions.update', $message->id) }}" method="POST"
                class="space-y-4 flex flex-col items-start" >
                @csrf
                @method('PUT')

                {{-- 1. Nama Produk (readonly --}}
                <div class="w-full">
                    <label for="id_product" class="block text-sm font-medium">Nama Produk</label>
                    <select name="id_product" id="id_product" class="border p-2 w-full"  readonly >
                            <option selected value="{{ $message->product->id }}" data-harga="{{ $message->product->harga }}" data-stock="{{ $message->product->stock }}">
                                {{ $message->product->nama }}
                            </option>

                    </select>
                </div>

                {{-- 2. Harga (readonly) --}}
                <div class="w-full">
                    <label for="harga" class="block text-sm font-medium">Harga</label>
                    <input type="text" id="harga" class="border p-2 w-full bg-gray-100" readonly value="{{ $message->product->harga }}">
                </div>

                {{-- 4. Kategori (readonly) --}}
                <div class="w-full">
                    <label for="category" class="block text-sm font-medium">Kategori</label>
                    <select name="category" id="category" class="border p-2 w-full" readonly>
                        <option selected value="{{ $message->category->id }}">{{ $message->category->nama }}</option>
                    </select>
                </div>

                {{-- 5. Jumlah Pembelian --}}
                <div class="w-full">
                    <label for="quantity" class="block text-sm font-medium">Jumlah Pembelian</label>
                    <input type="number" name="quantity" id="quantity" class="border p-2 w-full"
                        min="1" onkeydown="onQuantityChange()" required>
                </div>

                {{-- 6. Total Harga (readonly) --}}
                <div class="w-full">
                    <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
                    <input type="text" id="total_harga" class="border p-2 w-full bg-gray-100" readonly>
                </div>

                <button  type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    @break

    {{-- category --}}
    {{-- tampilkan semua category --}}
    @case('indexCateg')
        <div>
            <div class="flex flex-row justify-evenly items-center my-4 border-black border-solid border-2">
                <label for="nama" class="block text-sm font-medium w-full">Nama Kategori</label>
            </div>
            @foreach ($message as $category)
                <div
                    class="border-collapse flex flex-row justify-center items-center mx-auto my-4 border border-solid border-gray-800">
                    <div class="w-full ">
                        {{ $category->nama }}
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- buat category baru --}}
    @case('createCateg')
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="space-y-4 flex flex-col justify-between items-center">
                <div class="grow w-full">
                    <label for="nama" class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="border rounded w-full p-2" required>
                </div>

                <button type="submit"
                    class="dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    @break

    {{-- pilih salah satu dari semua category --}}
    @case('editCateg')
        <div>
            @foreach ($message as $category)
                <div class="space-y-4 flex flex-col justify-center items-center mx-auto my-4 border-black border-solid">
                    <div class="w-full">
                        <label for="nama" class="block text-sm font-medium">Nama Kategori</label>
                        {{ $category->nama }}
                    </div>

                    <div class="w-full">
                        <label for="pembuatan" class="block text-sm font-medium">Tanggal Pembuatan</label>
                        {{ $category->created_at }}
                    </div>

                    <div>
                        <button class="Pilih" value="{{ $category->id }}">Pilih</button>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    {{-- update setelah memilih category --}}
    @case('showCateg')
        <form action="{{ route('categories.update', $message->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 flex flex-col justify-between items-center">
                <div class="grow w-full">
                    <label for="nama" class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="border rounded w-full p-2"
                        value="{{ $message->nama }}" required>
                </div>
                <button type="submit"
                    class="dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    @break

    @default
@endswitch
