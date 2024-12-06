<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($errors->any() || session('message'))
        <div class="max-w-4xl mx-auto my-4 p-4 rounded-lg shadow-md 
        {{ $errors->any() ? 'bg-red-100 border border-red-400 text-red-700' : 'bg-green-100 border border-green-400 text-green-700' }}"
            role="alert">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="font-semibold">{{ $error }}</p>
                @endforeach
            @endif
            @if (session('message'))
                <p class="font-semibold">{{ session('message') }}</p>
            @endif
            <button type="button"
                class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 focus:outline-none"
                onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Saylov Nomzodlari</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-3 px-6 text-left">Ism</th>
                        <th class="py-3 px-6 text-left">Rasm</th>
                        <th class="py-3 px-6 text-left">Resume</th>
                        <th class="py-3 px-6 text-center">Ovoz Berish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-4 px-6 text-gray-800">{{ $candidate->name }}</td>
                            <td class="py-4 px-6">
                                <img src="{{ asset('storage/' . $candidate->picture) }}" alt="Nomzod Rasm"
                                    class="rounded-full w-16 h-16 object-cover mx-auto">
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('candidate.resume.download', $candidate->id) }}"
                                    class="text-blue-500 hover:underline">Yuklab olish</a>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if (!auth()->user()->candidate_id)
                                    <form action="{{ route('voter_update') }}" method="POST">
                                        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                        @csrf
                                        <button
                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:ring focus:ring-green-300">
                                            Ovoz Berish
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-app-layout>
