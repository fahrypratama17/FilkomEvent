<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Filkom Event' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex w-full max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-3">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-900">FilkomEvent</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm">
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-1 hover:bg-slate-100">Dashboard</a>
                <a href="{{ route('events.index') }}" class="rounded-lg px-3 py-1 hover:bg-slate-100">Events</a>
                <a href="{{ route('bookmarks.index') }}" class="rounded-lg px-3 py-1 hover:bg-slate-100">Bookmarks</a>
                <a href="{{ route('history') }}" class="rounded-lg px-3 py-1 hover:bg-slate-100">History</a>
                <a href="{{ route('profile') }}" class="rounded-lg px-3 py-1 hover:bg-slate-100">Profile</a>
                @if (auth()->user()?->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg bg-blue-900 px-3 py-1 text-white">Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-lg bg-orange-500 px-3 py-1 font-medium text-white hover:bg-orange-600">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-4 py-6">
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-100 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
