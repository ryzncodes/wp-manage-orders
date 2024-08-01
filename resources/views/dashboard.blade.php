<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">API Keys</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <form action="{{ route('api_keys.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Generate API Key</button>
                        </form>
                    </div>

                    <table class="min-w-full bg-white border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-semibold border border-gray-300 text-center">API Key</th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-semibold border border-gray-300 text-center">Secret</th>
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-semibold border border-gray-300 text-center">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apiKeys as $apiKey)
                                <tr class="border-b">
                                    <td class="py-2 px-4 border border-gray-300 text-center">{{ $apiKey->api_key }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-center">{{ $apiKey->secret }}</td>
                                    <td class="py-2 px-4 border border-gray-300 text-center">{{ $apiKey->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
