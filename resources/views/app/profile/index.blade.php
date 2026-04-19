@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    <section class="mb-6">
        <h1 class="text-3xl font-bold">Profile</h1>
        <p class="text-slate-600">Manage your account and credentials.</p>
    </section>

    <section class="mb-6 rounded-xl bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-xl font-bold">Account Information</h2>
        <div class="grid gap-3 md:grid-cols-2">
            <div class="rounded-lg bg-slate-50 p-3">
                <div class="text-xs text-slate-500">Name</div>
                <div class="text-lg font-semibold">{{ $user->name }}</div>
            </div>
            <div class="rounded-lg bg-slate-50 p-3">
                <div class="text-xs text-slate-500">Student ID</div>
                <div class="text-lg font-semibold">{{ $user->student_id ?? '-' }}</div>
            </div>
            <div class="rounded-lg bg-slate-50 p-3">
                <div class="text-xs text-slate-500">Email</div>
                <div class="text-lg font-semibold">{{ $user->email }}</div>
            </div>
            <div class="rounded-lg bg-slate-50 p-3">
                <div class="text-xs text-slate-500">Role</div>
                <div class="text-lg font-semibold">{{ ucfirst($user->role) }}</div>
            </div>
        </div>
    </section>

    <section class="mb-6 grid gap-4 md:grid-cols-3">
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Joined Events</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['joined_events'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Paid Events</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['paid_events'] }}</div>
        </article>
        <article class="rounded-xl bg-white p-5 shadow-sm">
            <div class="text-sm text-slate-500">Bookmarks</div>
            <div class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['bookmarks'] }}</div>
        </article>
    </section>

    <section class="rounded-xl bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-xl font-bold">Change Password</h2>
        <form method="POST" action="{{ route('profile.password.update') }}" class="grid gap-3 md:grid-cols-3">
            @csrf
            <input name="current_password" type="password" placeholder="Current password" required class="rounded-lg border border-slate-300 px-3 py-2">
            <input name="password" type="password" placeholder="New password" required class="rounded-lg border border-slate-300 px-3 py-2">
            <input name="password_confirmation" type="password" placeholder="Confirm new password" required class="rounded-lg border border-slate-300 px-3 py-2">
            <div class="md:col-span-3">
                <button type="submit" class="rounded-lg bg-blue-900 px-4 py-2 text-white">Update Password</button>
            </div>
        </form>
    </section>
@endsection
