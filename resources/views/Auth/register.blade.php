<x-layouts.guest title="Register" heading="Create Account" subheading="Use your student email to register">
    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="student_id" class="mb-1 block text-sm font-medium">Student ID</label>
            <input id="student_id" name="student_id" type="text" value="{{ old('student_id') }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="name" class="mb-1 block text-sm font-medium">Full Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Student Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2" placeholder="name@student.ub.id">
        </div>

        <div>
            <label for="password" class="mb-1 block text-sm font-medium">Password</label>
            <input id="password" name="password" type="password" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <div>
            <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border border-white/40 bg-white px-4 py-2 text-slate-800 outline-none ring-orange-400 focus:ring-2">
        </div>

        <button type="submit" class="w-full rounded-xl bg-orange-500 px-4 py-2 font-semibold text-white transition hover:bg-orange-600">
            Register
        </button>
    </form>

    <p class="mt-5 text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="underline">Login here</a>
    </p>
</x-layouts.guest>
