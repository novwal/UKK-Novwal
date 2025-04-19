<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-10">
        <!-- Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-5">
                <h1 class="text-3xl font-semibold mb-1">Detail Pengaduan</h1>
                <p class="text-sm">ID Pengaduan: <span class="font-semibold">{{ $report->id }}</span></p>
            </div>

            <!-- Content Grid -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gambar & Info -->
                <div>
                    @if($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="w-full rounded-lg shadow-md mb-4">
                    @endif
                    <div class="space-y-2 text-sm text-gray-700">
                        <p><strong>Total Suara:</strong> <i class="fas fa-thumbs-up text-blue-500"></i> {{ $report->voting }}</p>
                        <p><strong>Jumlah Dilihat:</strong> {{ $report->viewers }}</p>
                    </div>
                </div>

                <!-- Detail Informasi -->
                <div class="space-y-3 text-sm text-gray-700">
                    <p><span class="font-medium">Deskripsi:</span> {{ $report->description }}</p>
                    <p><span class="font-medium">Tipe:</span> {{ $report->type }}</p>
                    <p><span class="font-medium">Provinsi:</span> {{ $report->province }}</p>
                    <p><span class="font-medium">Kabupaten:</span> {{ $report->regency }}</p>
                    <p><span class="font-medium">Kecamatan:</span> {{ $report->subdistrict }}</p>
                    <p><span class="font-medium">Desa:</span> {{ $report->village }}</p>
                    <p>
                        <span class="font-medium">Status:</span>
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full text-white
                            @if($report->statement == 'pending') bg-yellow-500
                            @elseif($report->statement == 'on_process') bg-blue-500
                            @elseif($report->statement == 'done') bg-green-500
                            @elseif($report->statement == 'rejected') bg-red-500
                            @endif">
                            {{ ucfirst($report->statement) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Voting -->
            <div class="bg-gray-100 px-6 py-4 text-center">
                @php $votedBy = $report->voted_by ? json_decode($report->voted_by, true) : []; @endphp

                @if(in_array(auth()->id(), $votedBy))
                    <button class="bg-gray-400 text-white px-5 py-2 rounded-lg cursor-not-allowed inline-flex items-center justify-center gap-2">
                        <i class="fas fa-thumbs-up"></i> Anda Sudah Memberi Suara
                    </button>
                @else
                    <form action="{{ route('report.vote', $report->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition inline-flex items-center justify-center gap-2">
                            <i class="fas fa-thumbs-up"></i> Beri Suara
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Komentar -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">Komentar</h2>

            <!-- Form Komentar -->
            <form action="{{ route('report.comment', $report->id) }}" method="POST" class="mb-6 bg-white shadow rounded-lg p-4">
                @csrf
                <textarea name="comment" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" rows="4" placeholder="Tulis komentar Anda..." required></textarea>
                <div class="text-right mt-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Kirim Komentar
                    </button>
                </div>
            </form>

            <!-- Daftar Komentar -->
            <div class="space-y-4">
                @forelse($report->comments as $comment)
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama untuk berkomentar!</p>
                @endforelse
            </div>
        </div>

        <!-- Modal Notifikasi -->
        <div x-data="{ open: {{ session('badword_detected') ? 'true' : 'false' }} }" x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h2 class="text-xl font-bold text-red-600 mb-2">Komentar Ditolak</h2>
                <p class="text-gray-700">Komentar Anda mengandung kata tidak pantas.</p>
                <div class="mt-4 text-right">
                    <button @click="open = false" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
