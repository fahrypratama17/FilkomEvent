<x-layouts.guest title="Login" heading="Welcome Back" subheading="Sign in to continue to your dashboard">
    <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="password" class="mb-1 block text-sm font-medium">Password</label>
            <input id="password" name="password" type="password" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded">
            <span>Remember me</span>
        </label>

        <button type="submit" class="w-full rounded-xl bg-orange-500 px-4 py-2 font-semibold text-white transition hover:bg-orange-600">
            Login
        </button>
    </form>

    <div class="mt-5 flex items-center justify-between text-sm">
        <a href="{{ route('password.forgot') }}" class="underline">Forgot password?</a>
        <a href="{{ route('register') }}" class="underline">Create account</a>
    </div>
</x-layouts.guest>
