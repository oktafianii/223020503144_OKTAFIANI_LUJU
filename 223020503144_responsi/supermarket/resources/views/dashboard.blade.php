<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket</title>
</head>
<body id="hasil">
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex">
                <a href="{{ route('barang.tambah') }}" class="my-19 p-2 rounded bg-blue-500 text-white transition duration-300 hover:bg-blue-800">Tambah</a>&nbsp;&nbsp;&nbsp;
                <a href="/publish" class="my-19 p-2 rounded bg-blue-500 text-white transition duration-300 hover:bg-blue-800">Publish</a>
            </div>
            <div class="flex">
                <form id="searchForm" class="flex">
                    <input type="text" id="cari" name="search" placeholder="barang" class="border-gray-300 rounded-l-lg px-4 py-2 w-72">
                    <button type="submit" class="bg-blue-500 text-white hover:bg-blue-800 transition duration-300 rounded-r-lg px-4 py-2">Cari</button>
                </form>
            </div>
        </div>
    </x-slot>
    <div class="p-9">
        <table class="w-full bg-blue-100 shadow-md rounded overflow-hidden my-6">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-6 text-center">No.</th>
                    <th class="py-3 px-6 text-center">Gambar</th>
                    <th class="py-3 px-6 text-center">Barang</th>
                    <th class="py-3 px-6 text-center">Kategori</th>
                    <th class="py-3 px-6 text-center">Harga</th>
                    <th class="py-3 px-6 text-center">Stok</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr class="border-4 hover:bg-blue-200">
                    <td class="py-4 px-6 text-center">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6 flex justify-center">
                        <img src="{{ asset('/storage/barang/'.$item->gambar) }}" alt="" class="rounded" style="width: 130px">
                    </td>
                    <td class="py-4 px-6 text-center">{{ $item->barang }}</td>
                    <td class="py-4 px-6 text-center">{{ $item->kategori }}</td>
                    <td class="py-4 px-6 text-center">{{ "Rp " . number_format($item->harga, 2, ',', '.') }}</td>
                    <td class="py-4 px-6 text-center">{{ $item->stok }}</td>
                    <td class="py-4 px-6 text-center">
                        <form action="{{ route('barang.hapus', $item->id) }}" method="POST">
                            <a href="{{ route('barang.edit', $item->id) }}" class="text-blue-400 border border-blue-400 p-2 rounded transition duration-300 hover:border-blue-600 hover:bg-blue-600 hover:text-white mr-2">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-white border border-red-400 transition duration-300 hover:bg-red-600 hover:border-red-600 px-2 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $barang->links() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#searchForm').submit(function (event){
                event.preventDefault();

                var str = $('#cari').val();
                if (str != "") {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('search') }}",
                        data: "search="+str,
                        success: function (data) {
                            $('#hasil').html(data);
                        }
                    });
                } else {
                    console.log("Inputkan sesuatu");
                }
            });
        });
    </script>
</x-app-layout>
</body>
</html>