@forelse ($registrations as $reg)
  <article class="flex items-center justify-between rounded-[30px] bg-[#0077B6] p-8 shadow-md border border-white/10 hover:scale-[1.01] transition-all duration-300">
    <div class="flex items-start gap-6">
      <div class="flex flex-col justify-center">
        <div class="flex items-center gap-3 mb-1">
          <h3 class="text-2xl font-bold text-white">{{ $reg->event->title }}</h3>

          @php
            $eventStatus = $reg->event->status ?? 'Selesai';
            $statusClass = $eventStatus == 'Selesai' ? 'bg-[#03045E]' : 'bg-[#023E8A]';
          @endphp
          <span class="px-4 py-1 rounded-full text-[12px] font-medium text-white {{ $statusClass }}">
            {{ $eventStatus }}
          </span>
        </div>

        <p class="text-white/80 text-sm mb-3">
          {{ $reg->event->event_start ? \Carbon\Carbon::parse($reg->event->event_start)->format('d M, Y') : 'TBA' }}
        </p>

        <p class="text-white/90 text-sm line-clamp-2 max-w-2xl leading-relaxed">
          {{ $reg->event->short_description ?? Str::limit($reg->event->description, 150) }}
        </p>
      </div>
    </div>

    <div class="flex flex-col items-end min-w-50">
      @if($eventStatus == 'Selesai' && $reg->certificate)
        <a href="{{ route('certificates.download', $reg->certificate->certificate_id) }}" class="flex items-center gap-3 rounded-xl bg-[#03045E] px-6 py-3 text-white font-bold hover:bg-[#023E8A] shadow-lg w-full justify-center transition-all duration-300">
          <i data-lucide="Download" class="w-5 h-5"></i>
          Download Sertifikat
        </a>
        <a href="{{ route('certificates.view', $reg->certificate->certificate_id) }}" class="mt-3 flex items-center gap-3 rounded-xl bg-[#023E8A] px-6 py-3 text-white font-bold hover:bg-[#03045E] shadow-lg w-full justify-center transition-all duration-300">
          <i data-lucide="eye" class="w-5 h-5"></i>
          Lihat Sertifikat
        </a>
      @elseif($eventStatus == 'Sedang Berlangsung')
        <a href="{{ route('events.show', $reg->event->event_id) }}" class="flex items-center gap-3 rounded-xl bg-[#023E8A] px-6 py-3 text-white font-bold hover:bg-[#03045E] transition shadow-lg w-full justify-center">
          <i data-lucide="eye" class="w-5 h-5"></i>
          Lihat Detail Event
        </a>
      @else
        <button disabled class="rounded-xl bg-[#023E8A]/50 px-6 py-3 text-white/50 font-bold cursor-not-allowed w-full text-center">
          Tidak Tersedia
        </button>
        <a href="{{ route('events.show', $reg->event->event_id) }}" class="mt-3 flex items-center justify-center rounded-xl bg-[#03045E] px-6 py-3 text-white font-bold hover:bg-[#023E8A] transition shadow-lg w-full">
          <i data-lucide="eye" class="mr-2 h-5 w-5"></i>
          Lihat Detail Event
        </a>
      @endif
    </div>
  </article>
@empty
  <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[30px] shadow-sm border border-dashed border-gray-300">
    <div class="p-4 bg-gray-50 rounded-full mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
      </svg>
    </div>
    <h3 class="text-xl font-bold text-gray-400">Belum Ada Riwayat Partisipasi</h3>
    <p class="text-sm text-gray-400 mt-2 text-center">Sepertinya kamu belum mendaftar di event manapun.<br>Yuk, eksplorasi event seru di FILKOM!</p>

    <a href="/events" class="mt-8 px-8 py-3 bg-[#FF742E] text-white font-bold rounded-2xl hover:bg-orange-600 transition shadow-lg active:scale-95">
      Cari Event Sekarang
    </a>
  </div>
@endforelse

@if ($registrations instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="mt-8">
    {{ $registrations->links() }}
  </div>
@endif
