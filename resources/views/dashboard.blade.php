<x-app-layout>
    <section class="min-h-[90vh] bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-center items-center h-full py-24">
            <!-- Hero Content -->
            <div class="text-center max-w-4xl space-y-6">
                <!-- Animated/Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-4 animate-fade-in">
                    <span class="text-sm font-medium">Platform Resmi Pengaduan Masyarakat</span>
                </div>
                
                <!-- Main Heading with Gradient Text -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">
                    <span class="block">Layanan Pengaduan</span>
                    <span class="block">Nasional</span>
                </h1>
                
                <!-- Subheading -->
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    Sampaikan laporan Anda dengan mudah, pantau perkembangan, dan dapatkan solusi transparan melalui platform terintegrasi kami.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    @auth
                        @if(auth()->user()->role === 'USER')
                            <a href="{{ route('user.reports') }}"
                               class="px-8 py-4 bg-white text-blue-600 hover:bg-gray-50 font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                                Lihat Pengaduan Saya
                            </a>
                        @elseif(auth()->user()->role === 'STAFF' || auth()->user()->role === 'HEAD_STAFF')
                            <a href="{{ route('report.index') }}"
                               class="px-8 py-4 bg-white text-blue-600 hover:bg-gray-50 font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                                Kelola Pengaduan
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 bg-white text-blue-600 hover:bg-gray-50 font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                            Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-8 py-4 border-2 border-white text-white hover:bg-white/10 font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                            Daftar Baru
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Stats/Features Preview (Desktop only) -->
            <div class="hidden md:grid grid-cols-3 gap-8 mt-16 w-full max-w-5xl">
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/10">
                    <div class="text-3xl font-bold mb-2">100%</div>
                    <div class="text-white/80">Transparansi Proses</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/10">
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="text-white/80">Layanan Tersedia</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/10">
                    <div class="text-3xl font-bold mb-2">1000+</div>
                    <div class="text-white/80">Pengaduan Terselesaikan</div>
                </div>
            </div>
        </div>
        
        <!-- Wave Decoration (Bottom) -->
        <div class="w-full overflow-hidden">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-white">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section (Example additional content) -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Mengapa Menggunakan Layanan Kami?</h2>
                <p class="text-lg text-gray-600">Platform pengaduan terintegrasi dengan proses yang jelas dan transparan untuk kepuasan masyarakat.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Keamanan Data</h3>
                    <p class="text-gray-600">Informasi dan identitas Anda terlindungi dengan sistem keamanan berlapis.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Proses Cepat</h3>
                    <p class="text-gray-600">Pengaduan diproses secara real-time dengan waktu tanggap yang cepat.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Transparansi</h3>
                    <p class="text-gray-600">Pantau perkembangan pengaduan Anda secara real-time setiap saat.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>