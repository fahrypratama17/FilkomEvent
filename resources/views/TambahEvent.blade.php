<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Event</title>
    <!-- Menghubungkan Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <!-- Script Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#FBFBFB] font-sans antialiased">

<section class="mx-auto flex min-h-screen w-full overflow-hidden">
    <!-- SIDEBAR -->
    <div class="flex w-82.5 shrink-0 flex-col rounded-r-[26px] bg-[#1F388B] px-12 py-8 text-white shadow-sm">
        <div class="mb-14 flex items-center gap-3">
            <h1 class="text-xl font-bold">Filkom Event</h1>
        </div>

        <div>
            <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">Main Menu</h2>
            <nav class="space-y-8">
                <div class="flex items-center gap-8 text-[24px] text-white/70"><span>Dashboard</span></div>
                <div class="flex items-center gap-8 text-[24px] font-bold text-white underline underline-offset-8"><span>Events</span></div>
                <div class="flex items-center gap-8 text-[24px] text-white/70"><span>User Management</span></div>
            </nav>
        </div>

        <div class="mt-auto pt-16">
            <h2 class="mb-8 text-[26px] font-extrabold tracking-wide uppercase">Setting</h2>
            <div class="space-y-8">
                <div class="flex items-center gap-8 text-[24px] text-white/90"><span>Profile</span></div>
                <div class="flex items-center gap-8 text-[24px] text-white/90"><span>Logout</span></div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 overflow-y-auto px-12 py-8 bg-white">
        <!-- Top Bar  -->
        <div class="mb-8 flex justify-end">
            <button class="flex h-[58px] w-[58px] items-center justify-center rounded-full bg-[#233E98] shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#F9682A" class="w-8 h-8">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Header Page -->
        <div class="mb-8 flex items-center gap-5">
            <img src="{{ asset('assets/mascot.png') }}" class="w-16">
            <h1 class="text-[50px] font-extrabold leading-none tracking-tight text-black">
                Event <span class="text-[#F9682A]">Management!</span>
            </h1>
        </div>

        <!-- FORM CARD -->
        <div class="rounded-[40px] border border-gray-200 bg-white p-10 shadow-md">
            <!-- Upload Foto -->
            <div class="flex flex-col items-center gap-8 mb-8">
                <div class="w-full max-w-[400px] h-52 bg-[#F9682A] rounded-[30px] flex items-center justify-center shadow-lg mb-4 cursor-pointer hover:scale-105 transition-transform duration-300">
                    <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4.5 4.5 0 01-.88-8.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <button class="bg-[#03045E] text-white px-40 py-2.5 rounded-full text-lg font-bold shadow-md active:scale-95 transition-transform mb-10">
                    Unggah Foto Event
                </button>
            </div>

            <!-- Input Fields Grid -->
            <div class="grid grid-cols-2 gap-x-20 gap-y-6">
                <!-- Sisi Kiri -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">ID Event:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none focus:ring-2 focus:ring-[#F9682A]" placeholder="Isi ID Event">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Mulai Event:</label>
                        <input type="date" 
                                   class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none focus:ring-2 focus:ring-[#FF742E] cursor-pointer text-[#404040]" 
                                   value="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Lokasi:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Lokasi Event">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Status Event:</label>
                        <select class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none appearance-none cursor-pointer">
                            <option>Akan Datang</option>
                            <option>Selesai</option>
                            <option>Sedang Berlangsung</option>
                            <option>Dibatalkan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Status Pembayaran Event:</label>
                        <select class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none appearance-none cursor-pointer">
                            <option>Berbayar</option>
                            <option>Gratis</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Kategori:</label>
                        <select class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none appearance-none cursor-pointer">
                            <option>Semua Kategori</option>
                            <option>Webinar</option>
                            <option>Talkshow</option>
                            <option>Seminar</option>
                            <option>Lomba</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Penyelenggara:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Nama penyelenggara">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Narahubung:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Kontak penyelenggara">
                    </div>
                </div>

                <!-- Sisi Kanan -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Judul Event:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Judul Event">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Akhir Event:</label>
                        <input type="date" 
                                   class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none focus:ring-2 focus:ring-[#FF742E] cursor-pointer text-[#404040]" 
                                   value="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Kuota:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Berapa kuota peserta?">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Status Pendaftaran:</label>
                        <select class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none appearance-none cursor-pointer">
                            <option>Dibuka</option>
                            <option>Ditutup</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Biaya Pendaftaran:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Berapa biaya pendaftaran?">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Dibuat Oleh:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Pembuat event">
                    </div>
                    <div>
                        <label class="block text-[#03045E] text-xl font-bold mb-2">Email Penyelenggara:</label>
                        <input type="text" class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none" placeholder="Email penyelenggara">
                    </div>
                    <div>
                        <div>
                            <label class="block text-[#03045E] text-xl font-bold mb-2">Tanggal Penambahan Event:</label>
                            <input type="date" 
                                   class="w-full bg-[#D4D4D4] rounded-xl px-4 py-3 border-none focus:ring-2 focus:ring-[#FF742E] cursor-pointer text-[#404040]" 
                                   value="{{ date('Y-m-d') }}"> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Textarea Deskripsi -->
            <div class="mt-8 space-y-6">
                <div>
                    <label class="block text-[#03045E] text-xl font-bold mb-2">Deskripsi Singkat:</label>
                    <textarea rows="3" class="w-full bg-[#D4D4D4] rounded-[25px] px-6 py-4 border-none shadow-inner resize-none" placeholder="Isi dengan keterangan singkat"></textarea>
                </div>
                <div>
                    <label class="block text-[#03045E] text-xl font-bold mb-2">Deskripsi Lengkap:</label>
                    <textarea rows="5" class="w-full bg-[#D4D4D4] rounded-[25px] px-6 py-4 border-none shadow-inner resize-none" placeholder="Isi dengan deskripsi lengkap Event"></textarea>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-12 flex justify-center mt-10">
                <!-- <button class="w-full bg-[#03045E] text-white py-5 rounded-[20px] font-extrabold text-2xl shadow-lg hover:bg-blue-900 transition-all active:scale-[0.98]">
                    Tambah Event
                </button> -->
                <button class="bg-[#03045E] text-white px-100 py-5 rounded-full text-lg font-bold shadow-md active:scale-95 transition-transform mb-10">
                    Tambah Event
                </button>
            </div>
        </div>
    </div>
</section>

</body>
</html>