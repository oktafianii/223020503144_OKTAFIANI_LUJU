<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish</title>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
    <a href="{{ route('dashboard') }}" class="my-19 p-2 rounded bg-blue-500 text-white transition duration-300 hover:bg-blue-800">Kembali</a>
    </x-slot>
    <div class="p-9">
        <table class="w-full bg-blue-100 shadow-md rounded overflow-hidden my-6">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-6 text-center">No</th>
                    <th class="py-3 px-6 text-center">Barang</th>
                    <th class="py-3 px-6 text-center">Tanggal Publish</th>
                    <th class="py-3 px-6 text-center">Publish</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                <tr class="border-4 hover:bg-blue-200">
                    <td class="py-4 px-6 text-center">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6 text-center">{{ $item->barang }}</td>
                    <td id="tgl_publish_{{ $item->id }}" class="py-4 px-6 text-center">{{ $item->tgl_publish }}</td>
                    <td class="py-4 px-6 text-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" onchange="toggleAlert(this, '{{ $item->id }}')">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleAlert(checkbox, id) {
            var tgl_publish_element = document.getElementById('tgl_publish_' + id);
            
            if (checkbox.checked) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Telah Dipublish!',
                    showConfirmButton: false,
                    timer: 2000
                });

                var now = new Date();
                var day = String(now.getDate()).padStart(2, '0');
                var month = String(now.getMonth() + 1).padStart(2, '0'); 
                var year = now.getFullYear();
                var today = year + '-' + month + '-' + day;
                tgl_publish_element.textContent = today;
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Telah Di Unpublish!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
        
        // Periksa pesan dari sesi PHP
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";
        
        if (successMessage) {
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }
        if (errorMessage) {
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: errorMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
</x-app-layout>
</body>
</html>