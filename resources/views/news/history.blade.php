<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submission History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                @if ($checks->isEmpty())
                    <div class="p-8 text-center text-gray-400 text-sm">
                        No submissions yet.
                        <a href="{{ route('news.create') }}" class="text-indigo-500 hover:underline">
                            Submit your first article.
                        </a>
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 text-left">#</th>
                                <th class="px-6 py-3 text-left">Content Preview</th>
                                <th class="px-6 py-3 text-left">Result</th>
                                <th class="px-6 py-3 text-left">Score</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($checks as $check)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-400">{{ $check->id }}</td>
                                    <td class="px-6 py-4 max-w-xs truncate text-gray-700">
                                        {{ Str::limit($check->content, 60) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($check->result === 'fake')
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-semibold">Fake</span>
                                        @elseif ($check->result === 'real')
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">Real</span>
                                        @elseif ($check->result === 'pending')
                                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs font-semibold">Uncertain</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $check->credibility_score !== null ? $check->credibility_score . '%' : '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $check->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('news.show', $check->id) }}"
                                           class="text-indigo-500 hover:underline">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $checks->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
