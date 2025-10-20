@props(['galleryId'])

<div class="gallery-interactions" data-gallery-id="{{ $galleryId }}">
    <!-- Interaction Buttons -->
    <div class="flex items-center gap-4 py-3 border-t border-gray-200">
        <!-- Like Button -->
        <button 
            class="interaction-btn like-btn flex items-center gap-2 text-gray-600 hover:text-red-500 transition-colors"
            onclick="toggleLike({{ $galleryId }})"
            data-liked="false">
            <svg class="w-6 h-6 heart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span class="likes-count font-medium">0</span>
        </button>

        <!-- Share Button -->
        <button 
            class="interaction-btn share-btn flex items-center gap-2 text-gray-600 hover:text-green-500 transition-colors"
            onclick="openShareModal({{ $galleryId }})">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            <span class="shares-count font-medium">0</span>
        </button>

        <!-- Download Button -->
        <button 
            class="interaction-btn download-btn flex items-center gap-2 text-gray-600 hover:text-purple-500 transition-colors ml-auto"
            onclick="downloadGallery({{ $galleryId }})">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </button>
    </div>
</div>