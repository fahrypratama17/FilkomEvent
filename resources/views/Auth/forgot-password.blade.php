<x-layouts.guest title="Forgot Password" heading="Forgot Password" subheading="Generate a reset link for your account">
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <button type="submit" class="w-full rounded-xl bg-orange-500 px-4 py-2 font-semibold text-white transition hover:bg-orange-600">
            Send Reset Link
        </button>
    </form>

    @if (session('reset_link'))
        <div class="mt-4 rounded-lg bg-slate-900/60 p-3 text-sm">
            <div class="mb-1 font-semibold">Development reset link:</div>
            <a href="{{ session('reset_link') }}" class="break-all underline">{{ session('reset_link') }}</a>
        </div>
    @endif

    <p class="mt-5 text-sm">
        <a href="{{ route('login') }}" class="underline">Back to login</a>
    </p>
</x-layouts.guest>
