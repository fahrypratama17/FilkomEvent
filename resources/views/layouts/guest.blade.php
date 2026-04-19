<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Filkom Event' }}</title>
    @vite(['resources/css/auth.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-white">
    <main class="mx-auto flex min-h-screen w-full max-w-6xl items-center justify-center px-6 py-10">
        <div class="w-full max-w-xl rounded-3xl border border-white/20 bg-white/20 p-8 backdrop-blur-md">
            <h1 class="mb-2 text-3xl font-bold">{{ $heading ?? 'Filkom Event' }}</h1>
            @if (!empty($subheading))
                <p class="mb-6 text-sm text-white/90">{{ $subheading }}</p>
            @endif

            @if (session('status'))
                <div class="mb-4 rounded-lg bg-emerald-500/90 px-4 py-3 text-sm font-medium text-white">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-600/90 px-4 py-3 text-sm text-white">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>
</body>
</html>
