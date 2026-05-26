<div class="divide-y divide-gray-100">
  @forelse($events as $event)
    <div class="grid grid-cols-[2fr_1fr_1fr_1fr_1fr_1fr_1fr] items-center py-6 text-center text-sm">
      <div class="text-left">
        <p class="font-bold text-gray-800">{{ $event->title }}</p>
        <p class="text-xs italic text-gray-400">By: {{ $event->organizer ?? 'Admin FILKOM' }}</p>
      </div>

      <div>
        <p class="font-semibold">{{ $event->formatted_start_date }}</p>
        <p class="text-[10px] text-gray-500">{{ $event->formatted_time }}</p>
      </div>

      <div>
        <span class="{{ $event->status_class }} rounded-full px-4 py-1 text-[10px] font-bold text-white">
          {{ $event->status_label }}
        </span>
      </div>

      <div class="font-semibold text-gray-600">{{ $event->quota_text }}</div>
      <div class="font-semibold text-gray-600">{{ $event->quota_text }}</div>

      <div>
        <span class="rounded-full bg-[#1F388B] px-4 py-1 text-[10px] font-bold text-white">
          {{ $event->category->category_name ?? '-' }}
        </span>
      </div>

      <div class="flex justify-center gap-3">
        <i data-lucide="SquarePen" class="text-orange-400 hover:text-orange-600 duration-200 cursor-pointer"></i>

        <button title="Hapus Event" type="button" class="delete-button" data-url="{{ route('admin.events.destroy', $event) }}" data-title="{{ $event->title }}">
          <i data-lucide="Trash2" class="text-red-800 hover:text-red-600 duration-200 cursor-pointer"></i>
        </button>
      </div>
    </div>
  @empty
    <div class="py-12 text-center">
      <p class="text-lg font-bold text-[#1F388B]">
        Belum ada event.
      </p>

      <p class="mt-2 text-sm text-gray-500">
        Klik tombol Add New Event untuk menambahkan event baru.
      </p>
    </div>
  @endforelse
</div>

<div class="mt-8">
  {{ $events->links() }}
</div>

