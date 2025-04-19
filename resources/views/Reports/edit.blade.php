<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 md:p-8">
            <!-- Bagian Header -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Laporan</h1>
                <p class="text-gray-600 mt-2">Perbarui detail laporan Anda di bawah ini</p>
            </div>

            <form action="{{ route('report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-6">
                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>{{ $report->description }}</textarea>
                        </div>

                        <!-- Jenis Laporan -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Laporan</label>
                            <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                                <option value="KEJAHATAN" {{ $report->type == 'KEJAHATAN' ? 'selected' : '' }}>Laporan Kejahatan</option>
                                <option value="PEMBANGUNAN" {{ $report->type == 'PEMBANGUNAN' ? 'selected' : '' }}>Laporan Pembangunan</option>
                                <option value="SOSIAL" {{ $report->type == 'SOSIAL' ? 'selected' : '' }}>Laporan Sosial</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-6">
                        <!-- Detail Lokasi -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-700">Detail Lokasi</h3>

                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <input type="text" name="province" id="province" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $report->province }}" required>
                            </div>

                            <div>
                                <label for="regency" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                                <input type="text" name="regency" id="regency" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $report->regency }}" required>
                            </div>

                            <div>
                                <label for="subdistrict" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <input type="text" name="subdistrict" id="subdistrict" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $report->subdistrict }}" required>
                            </div>

                            <div>
                                <label for="village" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan</label>
                                <input type="text" name="village" id="village" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $report->village }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unggah Gambar -->
                <div class="mt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Laporan</label>
                    <div class="mt-1 flex flex-col sm:flex-row items-start gap-6">
                        <div class="flex-1">
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span> atau seret dan lepas</p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>

                        @if($report->image)
                        <div class="flex-1">
                            <div class="relative group">
                                <img src="{{ asset('images/' . $report->image) }}" alt="Gambar Laporan" class="h-32 w-auto rounded-lg object-cover border border-gray-200">
                                <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-10 flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('report.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition text-center">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                        Perbarui Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
