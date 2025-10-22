<!-- Gallery Detail Modal -->
<div id="galleryDetailModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-4" onclick="closeGalleryDetail(event)">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[85vh] overflow-hidden flex flex-col relative" onclick="event.stopPropagation()">
        <!-- Close Button Inside Container -->
        <button onclick="closeGalleryDetail()" class="absolute top-3 right-3 z-10 w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex flex-col md:flex-row overflow-auto">
            <!-- Left Side: Main Image + Interactions -->
            <div class="md:w-2/5 bg-gray-100 flex flex-col">
                <!-- Main Image -->
                <div class="flex-1 flex items-center justify-center p-4">
                    <img id="modalMainImage" src="" alt="" class="max-w-full max-h-[50vh] object-contain rounded-lg">
                </div>

                <!-- Interaction Buttons -->
                <div class="bg-white border-t border-gray-200 px-6 py-4 flex items-center gap-4">
                    <!-- Like Button -->
                    <button 
                        onclick="handleModalLike(event)"
                        id="modalLikeBtn"
                        class="interaction-btn flex items-center gap-2 text-gray-600 hover:text-red-500 transition-colors"
                        data-gallery-id=""
                        data-liked="false">
                        <svg class="w-6 h-6 heart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span id="modalLikesCount" class="font-medium">0</span>
                    </button>

                    <!-- Share Button -->
                    <button 
                        onclick="handleModalShare(event)"
                        class="interaction-btn flex items-center gap-2 text-gray-600 hover:text-green-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span id="modalSharesCount" class="font-medium">0</span>
                    </button>

                    <!-- Download Button -->
                    <button 
                        onclick="handleModalDownload(event)"
                        class="interaction-btn flex items-center gap-2 text-gray-600 hover:text-purple-500 transition-colors ml-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Side: Title, Description, Gallery Thumbnails -->
            <div class="md:w-3/5 flex flex-col">
                <!-- Title & Description -->
                <div class="p-6 border-b border-gray-200">
                    <h2 id="modalTitle" class="text-xl font-bold text-gray-900 mb-3"></h2>
                    <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed"></p>
                </div>

                <!-- Gallery Thumbnails -->
                <div class="flex-1 overflow-auto p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900">Gallery</h3>
                        <button onclick="openFullGallery()" class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                            See more
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    
                    <div id="modalGalleryGrid" class="grid grid-cols-3 gap-3">
                        <!-- Thumbnails will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Gallery Modal (See More) -->
<div id="fullGalleryModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[60] p-4" onclick="closeFullGallery(event)">
    <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-auto relative" onclick="event.stopPropagation()">
        <!-- Close Button Inside Container -->
        <button onclick="closeFullGallery()" class="absolute top-3 right-3 z-10 w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Full Gallery Grid -->
        <div id="fullGalleryGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-6 pt-14">
            <!-- Full gallery images will be loaded here -->
        </div>
    </div>
</div>

<!-- Full Size Image Viewer -->
<div id="fullSizeViewer" class="fixed inset-0 bg-black/95 hidden items-center justify-center z-[70]" onclick="closeFullSizeViewer()">
    <div class="relative w-full h-full flex items-center justify-center p-4" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button onclick="closeFullSizeViewer()" class="absolute top-4 right-4 z-10 w-12 h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Download Button -->
        <button onclick="downloadFullSizeImage()" class="absolute top-4 right-20 z-10 w-12 h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </button>

        <!-- Full Size Image -->
        <img id="fullSizeImage" src="" alt="" class="max-w-full max-h-full object-contain">
    </div>
</div>

<style>
.interaction-btn {
    padding: 8px;
    border-radius: 8px;
    transition: all 0.2s;
}

.interaction-btn:hover {
    background-color: rgba(0,0,0,0.05);
}

.interaction-btn[data-liked="true"] {
    color: #ef4444;
}

.interaction-btn[data-liked="true"] .heart-icon {
    fill: currentColor;
}

@keyframes heartBeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}
</style>