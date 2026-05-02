@extends('admin.layout')
@section('title', 'Manage Users')

@section('content')

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-600 uppercase">
                All Users ({{ $users->total() }})
            </h3>
        </div>

        <table class="min-w-full text-sm divide-y divide-gray-100">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-left">Submissions</th>
                    <th class="px-6 py-3 text-left">Joined</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-400">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->is_admin)
                                <span class="bg-indigo-100 text-indigo-600 text-xs font-bold px-2 py-1 rounded-full">
                                    Admin
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full">
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->news_checks_count }}</td>
                        <td class="px-6 py-4 text-gray-400 text-xs">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if (!$user->is_admin)
                                <form method="POST"
                                      action="{{ route('admin.users.delete', $user->id) }}"
                                      onsubmit="return confirm('Delete this user and all their submissions?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-xs font-semibold transition">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-300 text-xs">Protected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>

@endsection
