<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="px-6 py-10 sm:p-12">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6">
                    Buat Laporan Baru
                </h1>
                <p class="text-gray-600 mb-10 text-base sm:text-lg leading-relaxed">
                    Silakan isi form di bawah ini untuk membuat laporan. Pastikan data yang Anda berikan sudah lengkap dan benar.
                </p>

                <form action="{{ route('user.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Laporan</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full border border-gray-300 rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Tuliskan detail laporan Anda..." required></textarea>
                    </div>

                    <!-- Jenis Laporan -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                        <select name="type" id="type"
                            class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            required>
                            <option value="" disabled selected>Pilih jenis laporan</option>
                            @foreach(['KEJAHATAN','PEMBANGUNAN','SOSIAL','KECELAKAAN','LINGKUNGAN','KESEHATAN','KEAMANAN','KERUSAKAAN PROPERTI','LAINNYA'] as $type)
                                <option value="{{ $type }}">{{ ucfirst(strtolower($type)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lokasi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <input type="text" name="province" id="province"
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Contoh: Jawa Barat" required>
                        </div>
                        <div>
                            <label for="regency" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                            <input type="text" name="regency" id="regency"
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Contoh: Bandung" required>
                        </div>
                        <div>
                            <label for="subdistrict" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                            <input type="text" name="subdistrict" id="subdistrict"
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Contoh: Coblong" required>
                        </div>
                        <div>
                            <label for="village" class="block text-sm font-medium text-gray-700 mb-2">Desa/Kelurahan</label>
                            <input type="text" name="village" id="village"
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Contoh: Dago" required>
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar (opsional)</label>
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-xl file:border-0 file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col sm:flex-row justify-between items-center pt-4 border-t border-gray-200 mt-6">
                        <a href="{{ route('report.index') }}"
                            class="w-full sm:w-auto mb-4 sm:mb-0 inline-flex justify-center items-center px-5 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
