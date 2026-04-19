<x-layouts.guest title="Reset Password" heading="Reset Password" subheading="Enter your new account password">
    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ old('token', $token) }}">

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $email) }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="password" class="mb-1 block text-sm font-medium">New Password</label>
            <input id="password" name="password" type="password" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <button type="submit" class="w-full rounded-xl bg-orange-500 px-4 py-2 font-semibold text-white transition hover:bg-orange-600">
            Reset Password
        </button>
    </form>
</x-layouts.guest>
