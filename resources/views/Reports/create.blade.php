<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Buat Laporan Baru</h1>
                <p class="mt-3 text-lg text-gray-500">Isi formulir berikut untuk mengirimkan laporan Anda</p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Description Field -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Laporan <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="5" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150" placeholder="Jelaskan laporan Anda secara detail..." required></textarea>
                        </div>

                        <!-- Report Type Field -->
                        <div class="space-y-2">
                            <label for="type" class="block text-sm font-medium text-gray-700">Jenis Laporan <span class="text-red-500">*</span></label>
                            <select name="type" id="type" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
                                <option value="" disabled selected>Pilih Jenis Laporan</option>
                                <option value="KEJAHATAN">Kejahatan</option>
                                <option value="PEMBANGUNAN">Pembangunan</option>
                                <option value="SOSIAL">Sosial</option>
                                <option value="KECELAKAAN">Kecelakaan</option>
                                <option value="LINGKUNGAN">Lingkungan</option>
                                <option value="KESEHATAN">Kesehatan</option>
                                <option value="KEAMANAN">Keamanan</option>
                                <option value="KERUSAKAAN PROPERTI">Kerusakan Properti</option>
                                <option value="LAINNYA">Lainnya</option>
                            </select>
                        </div>

                        <!-- Location Fields -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Lokasi Kejadian</h3>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label for="province" class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                                    <input type="text" name="province" id="province" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150" placeholder="Contoh: Jawa Barat" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="regency" class="block text-sm font-medium text-gray-700">Kabupaten <span class="text-red-500">*</span></label>
                                    <input type="text" name="regency" id="regency" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150" placeholder="Contoh: Bandung" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="subdistrict" class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-red-500">*</span></label>
                                    <input type="text" name="subdistrict" id="subdistrict" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150" placeholder="Contoh: Sukajadi" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="village" class="block text-sm font-medium text-gray-700">Desa/Kelurahan <span class="text-red-500">*</span></label>
                                    <input type="text" name="village" id="village" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition duration-150" placeholder="Contoh: Sukagalih" required>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload Gambar (Opsional)</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                <span>Upload file</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-4 pt-4">
                            <a href="{{ route('report.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                Batalkan
                            </a>
                            <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm
                            <a href="{{ route('report.index') }}" class="inline-flex justify-center items-center px-6 py-3 border font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 mb-4 sm:mb-0">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
