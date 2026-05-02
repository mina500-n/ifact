@extends('admin.layout')
@section('title', 'All Submissions')

@section('content')

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-600 uppercase">
                All Submissions ({{ $submissions->total() }})
            </h3>
        </div>

        <table class="min-w-full text-sm divide-y divide-gray-100">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Content Preview</th>
                    <th class="px-6 py-3 text-left">Result</th>
                    <th class="px-6 py-3 text-left">Score</th>
                    <th class="px-6 py-3 text-left">Sentiment</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($submissions as $sub)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-400">{{ $sub->id }}</td>
                        <td class="px-6 py-4 text-gray-700 font-medium">
                            {{ $sub->user->name ?? 'Deleted User' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                            {{ Str::limit($sub->content, 50) }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badge = match($sub->result) {
                                    'fake'      => 'bg-red-100 text-red-600',
                                    'real'      => 'bg-green-100 text-green-600',
                                    'uncertain' => 'bg-yellow-100 text-yellow-600',
                                    default     => 'bg-gray-100 text-gray-500',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $badge }}">
                                {{ ucfirst($sub->result) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $sub->credibility_score !== null ? $sub->credibility_score . '%' : '—' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 capitalize">
                            {{ $sub->sentiment ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-xs">
                            {{ $sub->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST"
                                  action="{{ route('admin.submissions.delete', $sub->id) }}"
                                  onsubmit="return confirm('Delete this submission?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 text-xs font-semibold transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $submissions->links() }}
        </div>
    </div>

@endsection
