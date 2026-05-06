<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload Event Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FAFAFA] font-sans text-[#06005D]">
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="fixed left-0 top-0 h-screen w-[326px] bg-[#263F92] px-[46px] py-[46px] text-white">
            <div class="mb-[44px]">
                <div class="flex items-center gap-3">
                    <div class="flex h-[48px] w-[48px] items-center justify-center rounded-xl bg-[#FF5F2A]">
                        <i data-lucide="calendar-days" class="h-7 w-7 text-white"></i>
                    </div>

                    <div class="leading-none">
                        <h1 class="text-[28px] font-extrabold tracking-tight">FILKOM</h1>
                        <p class="text-[23px] font-extrabold tracking-tight">EVENT</p>
                    </div>
                </div>
            </div>

            <nav>
                <h2 class="mb-[28px] text-[22px] font-extrabold tracking-wide">MAIN MENU</h2>

                <div class="space-y-[30px]">
                    <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
                        <i data-lucide="home" class="h-[24px] w-[24px]"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center gap-[28px] text-[18px] font-bold text-white">
                        <i data-lucide="calendar-days" class="h-[24px] w-[24px]"></i>
                        <span>Events</span>
                    </a>

                    <a href="{{ route('admin.events.create') }}" class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
                        <i data-lucide="pen-line" class="h-[24px] w-[24px]"></i>
                        <span>Tambah Event</span>
                    </a>
                </div>

                <h2 class="mb-[28px] mt-[220px] text-[22px] font-extrabold tracking-wide">SETTING</h2>

                <div class="space-y-[30px]">
                    <a href="#" class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
                        <i data-lucide="user" class="h-[24px] w-[24px]"></i>
                        <span>Profile</span>
                    </a>

                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-[28px] text-[18px] font-medium text-white/80">
                            <i data-lucide="log-out" class="h-[24px] w-[24px]"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="ml-[326px] min-h-screen w-full px-[47px] py-[50px]">

            {{-- TOP USER ICON --}}
            <div class="absolute right-[76px] top-[34px]">
                <div class="flex h-[56px] w-[56px] items-center justify-center rounded-full bg-[#263F92]">
                    <i data-lucide="user-round" class="h-[27px] w-[27px] text-[#FF5F2A]"></i>
                </div>
            </div>

            {{-- HEADER --}}
            <div class="mb-[30px] flex items-center gap-[23px]">
                <div class="h-[70px] w-[70px] overflow-hidden">
                    {{-- Ganti asset ini kalau nama maskot kamu berbeda --}}
                    <img
                        src="{{ asset('icon/mascot.png') }}"
                        alt="Mascot"
                        class="h-full w-full object-contain"
                        onerror="this.style.display='none'"
                    >
                </div>

                <h1 class="text-[40px] font-extrabold leading-none text-black">
                    Event <span class="text-[#FF5F2A]">Management!</span>
                </h1>
            </div>

            {{-- FORM CARD --}}
            <section class="w-full max-w-[1028px] rounded-[28px] border border-[#DCDCDC] bg-white px-[75px] pb-[47px] pt-[67px] shadow-sm">

                @if(session('success'))
                    <div class="mb-8 rounded-xl bg-green-100 px-5 py-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 rounded-xl bg-red-100 px-5 py-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-8 rounded-xl bg-red-100 px-5 py-4 text-red-700">
                        <p class="mb-2 font-bold">Event belum bisa disimpan:</p>

                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @php
                        $labelClass = 'mb-[13px] block text-[18px] font-extrabold text-[#06005D]';
                        $inputClass = 'h-[48px] w-full rounded-[8px] bg-[#E7E7E7] px-[30px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30';
                        $selectClass = 'h-[48px] w-full appearance-none rounded-[8px] bg-[#E7E7E7] px-[30px] text-[17px] font-medium text-[#555] outline-none focus:ring-2 focus:ring-[#263F92]/30';
                        $textareaClass = 'w-full resize-none rounded-[8px] bg-[#E7E7E7] px-[30px] py-[23px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30';
                    @endphp

                    {{-- UPLOAD FOTO --}}
                    <div class="mb-[49px] flex flex-col items-center">
                        <label for="image_url" class="group flex h-[202px] w-[400px] cursor-pointer items-center justify-center rounded-[24px] bg-[#FF5F2A] shadow-[0_5px_4px_rgba(0,0,0,0.35)] transition hover:scale-[1.01]">
                            <i data-lucide="upload-cloud" class="h-[105px] w-[105px] stroke-[4] text-white"></i>
                        </label>

                        <input id="image_url" name="image_url" type="file" accept="image/*" class="hidden">

                        <button type="button" onclick="document.getElementById('image_url').click()" class="mt-[39px] h-[48px] w-[573px] rounded-full bg-[#050064] text-[17px] font-extrabold text-white">
                            Unggah Foto Event
                        </button>

                        <p id="fileNamePreview" class="mt-3 text-sm font-semibold text-[#06005D]/70"></p>
                    </div>

                    {{-- GRID FORM --}}
                    <div class="grid grid-cols-2 gap-x-[60px] gap-y-[26px]">

                        <div>
                            <label class="{{ $labelClass }}">ID Event:</label>
                            <input type="text" name="event_id" placeholder="ID Event" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Judul Event:</label>
                            <input type="text" name="title" placeholder="Nama Event" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Mulai Event:</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="event_start"
                                    placeholder="Kapan Event dimulai?"
                                    onfocus="this.type='datetime-local'"
                                    class="{{ $inputClass }} pr-[55px]"
                                >
                                <i data-lucide="calendar-days" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#FF5F2A]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Akhir Event:</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="event_end"
                                    placeholder="Kapan Event berakhir?"
                                    onfocus="this.type='datetime-local'"
                                    class="{{ $inputClass }} pr-[55px]"
                                >
                                <i data-lucide="calendar-days" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#FF5F2A]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Lokasi:</label>
                            <input type="text" name="location" placeholder="Lokasi Event" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Kuota:</label>
                            <input type="number" name="quota" placeholder="Jumlah peserta" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Status Event:</label>
                            <div class="relative">
                                <select name="event_status" class="{{ $selectClass }}">
                                    <option value="berlangsung">Sedang Berlangsung</option>
                                    <option value="akan_datang">Akan Datang</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                                <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Status Pendaftaran:</label>
                            <div class="relative">
                                <select name="registration_status" class="{{ $selectClass }}">
                                    <option value="dibuka">Dibuka</option>
                                    <option value="ditutup">Ditutup</option>
                                </select>
                                <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Status Pembayaran Event:</label>
                            <div class="relative">
                                <select name="is_paid" class="{{ $selectClass }}">
                                    <option value="1">Berbayar</option>
                                    <option value="0">Gratis</option>
                                </select>
                                <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Biaya Pendaftaran:</label>
                            <input type="number" name="price" placeholder="Berapa biaya pendaftaran?" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Kategori:</label>
                            <div class="relative">
                                <select name="category_id" class="{{ $selectClass }}">
                                    @forelse($categories ?? [] as $category)
                                        <option value="{{ $category->category_id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @empty
                                        <option value="1">Lomba</option>
                                        <option value="2">Workshop</option>
                                        <option value="3">Webinar</option>
                                        <option value="4">Seminar</option>
                                    @endforelse
                                </select>
                                <i data-lucide="chevron-down" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#555]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Dibuat Oleh:</label>
                            <input
                                type="text"
                                name="created_by_name"
                                value="{{ auth()->user()->name ?? 'Administrator' }}"
                                class="{{ $inputClass }}"
                                readonly
                            >
                            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        </div>

                        {{-- PEMBICARA FULL WIDTH --}}
                        <div class="col-span-2">
                            <label class="{{ $labelClass }}">Pembicara:</label>

                            <div id="speakerWrapper" class="space-y-3">
                                <div class="relative">
                                    <input type="text" name="speakers[]" placeholder="Nama pembicara" class="{{ $inputClass }} pr-[60px]">
                                    <button type="button" id="addSpeaker" class="absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Penyelenggara:</label>
                            <input type="text" name="organizer" placeholder="Nama penyelenggara" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Email Penyelenggara:</label>
                            <input type="email" name="contact_email" placeholder="Email penyelenggara" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Narahubung:</label>
                            <input type="text" name="contact_phone" placeholder="Kontak penyelenggara" class="{{ $inputClass }}">
                        </div>

                        <div>
                            <label class="{{ $labelClass }}">Tanggal Penambahan Event:</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="created_at"
                                    onfocus="this.type='date'"
                                    class="{{ $inputClass }} pr-[55px]"
                                >
                                <i data-lucide="calendar-days" class="pointer-events-none absolute right-[23px] top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-[#FF5F2A]"></i>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label class="{{ $labelClass }}">Deskripsi Singkat:</label>
                            <textarea name="short_description" placeholder="Deskripsi singkat Event" class="{{ $textareaClass }} h-[116px]"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label class="{{ $labelClass }}">Deskripsi Lengkap:</label>
                            <textarea name="description" placeholder="Definisi Event" class="{{ $textareaClass }} h-[139px]"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label class="{{ $labelClass }}">Tujuan Event:</label>
                            <textarea name="event_purpose" placeholder="Tujuan dari Event" class="{{ $textareaClass }} h-[139px]"></textarea>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="mt-[81px] flex justify-center">
                        <button type="submit" class="h-[48px] w-[573px] rounded-full bg-[#050064] text-[17px] font-extrabold text-white transition hover:bg-[#09008a]">
                            Simpan Event
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
        const imageInput = document.getElementById('image_url');
        const fileNamePreview = document.getElementById('fileNamePreview');

        imageInput?.addEventListener('change', function () {
            fileNamePreview.textContent = this.files?.[0]?.name ?? '';
        });

        const addSpeakerButton = document.getElementById('addSpeaker');
        const speakerWrapper = document.getElementById('speakerWrapper');

        addSpeakerButton?.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'relative';

            row.innerHTML = `
                <input
                    type="text"
                    name="speakers[]"
                    placeholder="Nama pembicara"
                    class="h-[48px] w-full rounded-[8px] bg-[#E7E7E7] px-[30px] pr-[60px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30"
                >

                <button
                    type="button"
                    class="remove-speaker absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]"
                >
                    -
                </button>
            `;

            speakerWrapper.appendChild(row);
        });

        speakerWrapper?.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-speaker')) {
                event.target.closest('.relative').remove();
            }
        });
    </script>
</body>
</html>
