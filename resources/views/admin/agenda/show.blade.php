@extends('admin.layout')

@section('title', 'Detail Agenda')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.agenda.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Agenda</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap agenda</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Agenda Info Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start space-x-4 mb-6">
                    <div class="w-4 h-4 rounded-full mt-1 flex-shrink-0" style="background-color: {{ $agenda->warna }}"></div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $agenda->judul }}</h2>
                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                            <span class="px-3 py-1 rounded-full {{ $agenda->getStatusBadgeColor() }}">
                                {{ $agenda->getStatusLabel() }}
                            </span>
                            @if($agenda->isKadaluwarsa())
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Kadaluwarsa
                                </span>
                            @elseif($agenda->isBerlangsung())
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    Sedang Berlangsung
                                </span>
                            @elseif($agenda->isAkanDatang())
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Akan Datang
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $agenda->deskripsi }}</p>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-history mr-2 text-blue-600"></i>
                    Timeline
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-green-600 text-sm"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Agenda Dibuat</p>
                            <p class="text-sm text-gray-600">{{ $agenda->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-xs text-gray-500">oleh {{ $agenda->user->name }}</p>
                        </div>
                    </div>

                    @if($agenda->updated_at != $agenda->created_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-edit text-blue-600 text-sm"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Terakhir Diupdate</p>
                                <p class="text-sm text-gray-600">{{ $agenda->updated_at->format('d M Y, H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $agenda->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Date & Time Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>
                    Jadwal
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tanggal</p>
                        <p class="text-base font-medium text-gray-900">{{ $agenda->getFormattedDateRange() }}</p>
                    </div>

                    @if($agenda->getFormattedTimeRange())
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Waktu</p>
                            <p class="text-base font-medium text-gray-900">
                                <i class="fas fa-clock text-gray-400 mr-2"></i>
                                {{ $agenda->getFormattedTimeRange() }}
                            </p>
                        </div>
                    @endif

                    @if($agenda->lokasi)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Lokasi</p>
                            <p class="text-base font-medium text-gray-900">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                {{ $agenda->lokasi }}
                            </p>
                        </div>
                    @endif

                    <!-- Countdown or Status -->
                    <div class="pt-4 border-t border-gray-200">
                        @if($agenda->isKadaluwarsa())
                            <div class="bg-red-50 rounded-lg p-3 text-center">
                                <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                                <p class="text-sm font-medium text-red-900">Agenda Telah Berakhir</p>
                                <p class="text-xs text-red-700 mt-1">
                                    {{ $agenda->tanggal_selesai->diffForHumans() }}
                                </p>
                            </div>
                        @elseif($agenda->isBerlangsung())
                            <div class="bg-blue-50 rounded-lg p-3 text-center">
                                <i class="fas fa-play-circle text-blue-600 text-2xl mb-2"></i>
                                <p class="text-sm font-medium text-blue-900">Sedang Berlangsung</p>
                                <p class="text-xs text-blue-700 mt-1">
                                    Berakhir {{ $agenda->tanggal_selesai->diffForHumans() }}
                                </p>
                            </div>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-3 text-center">
                                <i class="fas fa-hourglass-half text-yellow-600 text-2xl mb-2"></i>
                                <p class="text-sm font-medium text-yellow-900">Akan Datang</p>
                                <p class="text-xs text-yellow-700 mt-1">
                                    Dimulai {{ $agenda->tanggal_mulai->diffForHumans() }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    @if($agenda->status == 'aktif' && !$agenda->isKadaluwarsa())
                        <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="selesai">
                            <input type="hidden" name="judul" value="{{ $agenda->judul }}">
                            <input type="hidden" name="deskripsi" value="{{ $agenda->deskripsi }}">
                            <input type="hidden" name="tanggal_mulai" value="{{ $agenda->tanggal_mulai->format('Y-m-d') }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $agenda->tanggal_selesai->format('Y-m-d') }}">
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                Tandai Selesai
                            </button>
                        </form>
                    @endif

                    @if($agenda->status == 'aktif')
                        <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="dibatalkan">
                            <input type="hidden" name="judul" value="{{ $agenda->judul }}">
                            <input type="hidden" name="deskripsi" value="{{ $agenda->deskripsi }}">
                            <input type="hidden" name="tanggal_mulai" value="{{ $agenda->tanggal_mulai->format('Y-m-d') }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $agenda->tanggal_selesai->format('Y-m-d') }}">
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fas fa-ban text-red-600 mr-2"></i>
                                Batalkan Agenda
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.agenda.edit', $agenda) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-edit text-blue-600 mr-2"></i>
                        Edit Agenda
                    </a>
                </div>
            </div>

            <!-- Color Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Warna Label</h3>
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-lg shadow-sm" style="background-color: {{ $agenda->warna }}"></div>
                    <div>
                        <p class="text-sm text-gray-600">Kode Warna</p>
                        <p class="text-base font-mono font-medium text-gray-900">{{ $agenda->warna }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
