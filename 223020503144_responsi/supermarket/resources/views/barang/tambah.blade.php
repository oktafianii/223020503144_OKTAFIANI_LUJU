<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Data</title>
</head>
<body class="bg-gradient-to-r from-blue-400 to-cyan-500">
    <div class="p-9">
        <form class="w-full max-w-lg mx-auto bg-white rounded-lg shadow-md px-8 pt-6 pb-8 mb-4" action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-6">
                <label class="block text-black-700 text-sm font-bold mb-2" for="grid-first-name">
                    Barang
                </label>
                <input name="barang" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Barang">
            </div>
            <div class="mb-6">
                <label class="block text-black-700 text-sm font-bold mb-2" for="grid-first">
                    Kategori
                </label>
                <input name="kategori" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first" type="text" placeholder="Kategori">
            </div>
            <div class="mb-6">
                <label class="block text-black-700 text-sm font-bold mb-2" for="grid-last-name">
                    Harga
                </label>
                <input name="harga" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-last-name" type="number" placeholder="Harga">
            </div>
            <div class="mb-6">
                <label class="block text-black-700 text-sm font-bold mb-2" for="grid-password">
                    Stok
                </label>
                <input name="stok" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-password" type="number" placeholder="Stok">
            </div>
            <div class="mb-6">
                <label class="block text-black-700 text-sm font-bold mb-2" for="grid-confirm-password">
                    Upload Gambar
                </label>
                <input name="gambar" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-confirm-password" type="file" multiple>
                <input name="tgl_publish" class="appearance-none block w-full bg-gray-200 text-black-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-confirm-password" type="hidden" value="<?php echo date('y-m-d'); ?>">
            </div>
            <div class="flex items-center">
                <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</body>
</html>
