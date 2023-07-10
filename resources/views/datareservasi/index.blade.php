<x-guest-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="mb-4">
                    <form action="{{ route('datareservasi.index') }}" method="GET" class="flex items-center">
                        <label for="search" class="text-sm font-medium text-gray-700 mr-2">Cari:</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" class="px-4 py-2 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan kata kunci" value="{{ request('search') }}">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            </div>
                        </div>
                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cari
                        </button>
                    </form>
                </div>
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full bg-blue-500 text-white">
                                <thead class="bg-blue-600">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left uppercase">
                                            Nama
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left uppercase">
                                            Tanggal Reservasi
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left uppercase">
                                            Meja
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left uppercase">
                                            Jumlah Tamu
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservasi as $reservation)
                                        <tr class="bg-white border-b white:bg-white-800 black:border-bla-700">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray">
                                                {{ $reservation->nama_depan }} {{ $reservation->nama_belakang }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray">
                                                {{ $reservation->tanggal_reservasi }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray">
                                                {{ $reservation->table->nama }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray">
                                                {{ $reservation->kapasitas }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($reservasi->isEmpty())
                                        <tr>
                                            <td colspan="4" class="py-4 px-6 text-center text-gray-500 dark:text-gray">Tidak ada data yang sesuai dengan pencarian.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
