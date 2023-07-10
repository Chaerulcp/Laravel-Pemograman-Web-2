<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790__340.jpg" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step 1</div>
                            </div>

                            <form method="POST" action="{{ route('reservasi.store.step.one') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="nama_depan" class="block text-sm font-medium text-gray-700"> Nama Depan
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="nama_depan" name="nama_depan"
                                            value="{{ $reservasi->nama_depan ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('nama_depan')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="nama_belakang" class="block text-sm font-medium text-gray-700"> Nama Belakang
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="nama_belakang" name="nama_belakang"
                                            value="{{ $reservasi->nama_belakang ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('nama_belakang')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                    <div class="mt-1">
                                        <input type="email" id="email" name="email"
                                            value="{{ $reservasi->email ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('email')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700"> Nomor Handphone
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="no_hp" name="no_hp"
                                            value="{{ $reservasi->no_hp ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('no_hp')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="tanggal_reservasi" class="block text-sm font-medium text-gray-700"> Tanggal Reservasi
                                    </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="tanggal_reservasi" name="tanggal_reservasi"
                                            min="{{ $min_date->format('Y-m-d\TH:i:s') }}"
                                            max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                                            value="{{ $reservasi ? $reservasi->tanggal_reservasi->format('Y-m-d\TH:i:s') : '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    <span class="text-xs">Please choose the time between 09:00-23:00.</span>
                                    @error('tanggal_reservasi')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="kapasitas" class="block text-sm font-medium text-gray-700"> Jumlah Orang
                                    </label>
                                    <div class="mt-1">
                                        <input type="number" id="kapasitas" name="kapasitas"
                                            value="{{ $reservasi->kapasitas ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('kapasitas')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>