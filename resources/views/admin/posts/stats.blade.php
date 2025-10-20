@extends('admin.layout')

@section('title', 'Statistik Postingan - ' . $post->judul)

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Manajemen Konten
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Statistik Postingan</h1>
                <p class="mt-1 text-sm text-gray-600">{{ $post->judul }}</p>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Likes Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Likes</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $likes->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-heart text-red-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-4">
                <i class="fas fa-users mr-1"></i> {{ $likes->unique('user_id')->count() }} pengguna unik
            </p>
        </div>

        <!-- Shares Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Shares</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $shares->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-share-alt text-blue-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-4">
                <i class="fas fa-users mr-1"></i> {{ $shares->where('user_id', '!=', null)->unique('user_id')->count() }} pengguna terdaftar
            </p>
        </div>

        <!-- Downloads Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Downloads</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $downloads->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-download text-green-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-4">
                <i class="fas fa-users mr-1"></i> {{ $downloads->where('user_id', '!=', null)->unique('user_id')->count() }} pengguna terdaftar
            </p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button onclick="switchTab('likes')" id="tab-likes" class="tab-button active px-6 py-3 text-sm font-medium border-b-2 border-red-500 text-red-600">
                    <i class="fas fa-heart mr-2"></i> Likes ({{ $likes->count() }})
                </button>
                <button onclick="switchTab('shares')" id="tab-shares" class="tab-button px-6 py-3 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-share-alt mr-2"></i> Shares ({{ $shares->count() }})
                </button>
                <button onclick="switchTab('downloads')" id="tab-downloads" class="tab-button px-6 py-3 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-download mr-2"></i> Downloads ({{ $downloads->count() }})
                </button>
            </nav>
        </div>

        <!-- Likes Tab Content -->
        <div id="content-likes" class="tab-content p-6">
            @if($likes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($likes->sortByDesc('created_at') as $like)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($like->user && $like->user->avatar)
                                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                                        {{ $like->user->avatar }}
                                                    </div>
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-red-400 to-pink-500 flex items-center justify-center text-white font-semibold">
                                                        {{ strtoupper(substr($like->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $like->user->name ?? 'Unknown User' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $like->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $like->created_at->format('d M Y, H:i') }}</div>
                                        <div class="text-xs text-gray-400">{{ $like->created_at->diffForHumans() }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-heart text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada likes untuk postingan ini</p>
                </div>
            @endif
        </div>

        <!-- Shares Tab Content -->
        <div id="content-shares" class="tab-content hidden p-6">
            @if($shares->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($shares->sortByDesc('created_at') as $share)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($share->user)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($share->user->avatar)
                                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                                            {{ $share->user->avatar }}
                                                        </div>
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-semibold">
                                                            {{ strtoupper(substr($share->user->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $share->user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $share->user->email }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 italic">Guest User</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($share->platform == 'whatsapp') bg-green-100 text-green-800
                                            @elseif($share->platform == 'facebook') bg-blue-100 text-blue-800
                                            @elseif($share->platform == 'twitter') bg-sky-100 text-sky-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            <i class="fab fa-{{ $share->platform }} mr-1"></i> {{ ucfirst($share->platform) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $share->ip_address ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $share->created_at->format('d M Y, H:i') }}</div>
                                        <div class="text-xs text-gray-400">{{ $share->created_at->diffForHumans() }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-share-alt text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada shares untuk postingan ini</p>
                </div>
            @endif
        </div>

        <!-- Downloads Tab Content -->
        <div id="content-downloads" class="tab-content hidden p-6">
            @if($downloads->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($downloads->sortByDesc('created_at') as $download)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($download->user)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($download->user->avatar)
                                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                                            {{ $download->user->avatar }}
                                                        </div>
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-semibold">
                                                            {{ strtoupper(substr($download->user->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $download->user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $download->user->email }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 italic">Guest User</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $download->file_name ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $download->ip_address ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $download->created_at->format('d M Y, H:i') }}</div>
                                        <div class="text-xs text-gray-400">{{ $download->created_at->diffForHumans() }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-download text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada downloads untuk postingan ini</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-red-500', 'text-red-600', 'border-blue-500', 'text-blue-600', 'border-green-500', 'text-green-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Add active class to selected button
            const activeButton = document.getElementById('tab-' + tabName);
            activeButton.classList.remove('border-transparent', 'text-gray-500');
            
            if (tabName === 'likes') {
                activeButton.classList.add('border-red-500', 'text-red-600', 'active');
            } else if (tabName === 'shares') {
                activeButton.classList.add('border-blue-500', 'text-blue-600', 'active');
            } else if (tabName === 'downloads') {
                activeButton.classList.add('border-green-500', 'text-green-600', 'active');
            }
        }
    </script>
    @endpush
@endsection
