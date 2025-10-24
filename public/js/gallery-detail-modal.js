// Gallery Detail Modal JavaScript

let currentGalleryData = null;
let currentImageIndex = 0;

// Open Gallery Detail Modal
async function openGalleryDetail(postId) {
    try {
        // Show loading state
        showLoadingModal();
        
        const response = await fetch(`/gallery/${postId}/detail`);
        const data = await response.json();
        
        if (data.success) {
            currentGalleryData = data.gallery;
            currentImageIndex = 0;
            
            // Populate modal with data
            populateModal(data.gallery);
            
            // Hide loading, show modal
            hideLoadingModal();
            const modal = document.getElementById('galleryDetailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
    } catch (error) {
        console.error('Error loading gallery detail:', error);
        hideLoadingModal();
        showNotification('Gagal memuat detail galeri', 'error');
    }
}

// Show loading modal
function showLoadingModal() {
    const loadingHTML = `
        <div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                <p class="mt-4 text-gray-700">Memuat...</p>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', loadingHTML);
}

// Hide loading modal
function hideLoadingModal() {
    const loadingModal = document.getElementById('loadingModal');
    if (loadingModal) {
        loadingModal.remove();
    }
}

// Populate Modal with Gallery Data
function populateModal(gallery) {
    // Set title and description
    document.getElementById('modalTitle').textContent = gallery.title;
    document.getElementById('modalDescription').textContent = gallery.description || 'Tidak ada deskripsi yang tersedia.';
    
    // Set gallery ID for interactions
    document.getElementById('modalLikeBtn').dataset.galleryId = gallery.id || '';
    document.getElementById('modalLikeBtn').dataset.liked = gallery.stats.is_liked;
    
    // Update stats counts
    document.getElementById('modalViewsCount').textContent = gallery.stats.views_count || 0;
    document.getElementById('modalLikesCount').textContent = gallery.stats.likes_count;
    
    // Update like button appearance
    const likeBtn = document.getElementById('modalLikeBtn');
    const modalHeartIcon = likeBtn.querySelector('.heart-icon');
    if (gallery.stats.is_liked) {
        likeBtn.classList.add('text-red-500');
        if (modalHeartIcon) {
            modalHeartIcon.style.fill = 'currentColor';
        }
    } else {
        likeBtn.classList.remove('text-red-500');
        if (modalHeartIcon) {
            modalHeartIcon.style.fill = 'none';
        }
    }
    
    // Track view when modal opens
    if (gallery.id) {
        trackGalleryView(gallery.id);
    }
    
    // Update main image
    if (gallery.photos && gallery.photos.length > 0) {
        const firstPhoto = gallery.photos[0];
        document.getElementById('modalMainImage').src = `/storage/posts/${firstPhoto.file}`;
        currentFullSizeImageUrl = `/storage/posts/${firstPhoto.file}`;
    } else {
        document.getElementById('modalMainImage').src = '';
        currentFullSizeImageUrl = '';
    }
    
    // Load gallery thumbnails
    loadGalleryThumbnails(gallery.photos);
}

// Load Gallery Thumbnails
function loadGalleryThumbnails(photos) {
    const grid = document.getElementById('modalGalleryGrid');
    const seeMoreBtn = document.querySelector('button[onclick="openFullGallery()"]');
    
    if (!photos || photos.length === 0) {
        grid.innerHTML = '<p class="text-gray-500 text-center col-span-2">Tidak ada gambar</p>';
        if (seeMoreBtn) seeMoreBtn.style.display = 'none';
        return;
    }
    
    // Show only first 4 photos
    const photosToShow = photos.slice(0, 4);
    const remainingCount = photos.length - 4;
    
    grid.innerHTML = photosToShow.map(photo => `
        <img src="/storage/posts/${photo.file}" 
             alt="${photo.title || 'Gallery Image'}" 
             class="w-full aspect-square object-cover rounded cursor-pointer hover:opacity-80 transition-opacity"
             onclick="changeMainImage('/storage/posts/${photo.file}')">
    `).join('');
    
    // Update "See more" button text and visibility
    if (seeMoreBtn) {
        if (remainingCount > 0) {
            seeMoreBtn.style.display = 'flex';
            seeMoreBtn.innerHTML = `
                See more (${remainingCount})
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            `;
        } else {
            seeMoreBtn.style.display = 'none';
        }
    }
}

// Change Main Image
function changeMainImage(imageUrl) {
    const mainImage = document.getElementById('modalMainImage');
    mainImage.src = imageUrl;
    currentFullSizeImageUrl = imageUrl;
}

// Close Gallery Detail Modal
function closeGalleryDetail(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('galleryDetailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    
    // Restore body scroll
    document.body.style.overflow = '';
    
    // Clear data
    currentGalleryData = null;
    currentImageIndex = 0;
}

// Handle Modal Like
async function handleModalLike(event) {
    event.stopPropagation();
    
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        showAuthModal();
        return;
    }
    
    const galleryId = document.getElementById('modalLikeBtn').dataset.galleryId;
    const btn = document.getElementById('modalLikeBtn');
    
    try {
        const response = await fetch(`/gallery/${galleryId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        const data = await response.json();
        
        if (response.status === 401) {
            if (typeof showAuthModal === 'function') {
                showAuthModal();
            } else {
                alert('Silakan login untuk menyukai postingan');
            }
            return;
        }
        
        if (data.success) {
            btn.dataset.liked = data.liked;
            
            // Update like count in modal
            document.getElementById('modalLikesCount').textContent = data.likes_count;
            
            // Update like count in grid card
            const gridLikeButton = document.querySelector(`.quick-like-btn[data-gallery-id="${galleryId}"]`);
            if (gridLikeButton) {
                const gridLikeCount = gridLikeButton.querySelector('.like-count-number');
                if (gridLikeCount) {
                    const formattedCount = data.likes_count >= 1000 
                        ? (data.likes_count / 1000).toFixed(1) + 'k' 
                        : data.likes_count;
                    gridLikeCount.textContent = formattedCount;
                }
                
                // Update button state in grid
                gridLikeButton.dataset.liked = data.liked;
                const gridHeartIcon = gridLikeButton.querySelector('.heart-icon');
                if (data.liked) {
                    gridLikeButton.classList.add('text-red-500');
                    if (gridHeartIcon) {
                        gridHeartIcon.style.fill = 'currentColor';
                    }
                } else {
                    gridLikeButton.classList.remove('text-red-500');
                    if (gridHeartIcon) {
                        gridHeartIcon.style.fill = 'none';
                    }
                }
            }
            
            // Update modal button appearance
            if (data.liked) {
                btn.classList.add('text-red-500');
                btn.querySelector('.heart-icon').style.animation = 'heartBeat 0.3s ease';
                setTimeout(() => {
                    btn.querySelector('.heart-icon').style.animation = '';
                }, 300);
            } else {
                btn.classList.remove('text-red-500');
            }
        }
    } catch (error) {
        console.error('Error toggling like:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    }
}

// Handle Modal Share
async function handleModalShare(event) {
    event.stopPropagation();
    
    const galleryId = document.getElementById('modalLikeBtn').dataset.galleryId;
    const url = window.location.origin + '/gallery/' + galleryId;
    const text = document.getElementById('modalTitle').textContent;
    
    if (navigator.share) {
        try {
            await navigator.share({
                title: text,
                text: 'Lihat galeri kegiatan SMKN 4 Bogor ini!',
                url: url
            });
            
            // Track share
            await fetch(`/gallery/${galleryId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ platform: 'native_share' })
            });
            
            // Update share count
            const currentCount = parseInt(document.getElementById('modalSharesCount').textContent);
            document.getElementById('modalSharesCount').textContent = currentCount + 1;
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Error sharing:', error);
            }
        }
    } else {
        try {
            await navigator.clipboard.writeText(url);
            alert('Link berhasil disalin ke clipboard!');
            
            // Track share
            await fetch(`/gallery/${galleryId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ platform: 'copy_link' })
            });
            
            // Update share count
            const currentCount = parseInt(document.getElementById('modalSharesCount').textContent);
            document.getElementById('modalSharesCount').textContent = currentCount + 1;
        } catch (error) {
            console.error('Error copying to clipboard:', error);
            alert('Gagal menyalin link');
        }
    }
}

// Handle Modal Download
function handleModalDownload(event) {
    event.stopPropagation();
    
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        pendingDownloadAction = () => handleModalDownload(event);
        showAuthModal();
        return;
    }
    
    const imageUrl = document.getElementById('modalMainImage').src;
    const galleryId = document.getElementById('modalLikeBtn').dataset.galleryId;
    
    if (imageUrl) {
        // Track download to backend
        if (galleryId) {
            fetch(`/gallery/${galleryId}/download`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ file_name: imageUrl.split('/').pop() })
            }).catch(err => console.warn('Download tracking failed:', err));
        }
        
        const link = document.createElement('a');
        link.href = imageUrl;
        link.download = 'gallery_image.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showNotification('Download dimulai!', 'success');
    } else {
        showNotification('Tidak ada foto untuk didownload', 'error');
    }
}

// Open Full Gallery Modal
function openFullGallery() {
    if (!currentGalleryData || !currentGalleryData.photos) return;
    
    const modal = document.getElementById('fullGalleryModal');
    const grid = document.getElementById('fullGalleryGrid');
    
    grid.innerHTML = currentGalleryData.photos.map(photo => `
        <div class="group relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
            <div class="aspect-square overflow-hidden">
                <img src="/storage/posts/${photo.file}" 
                     alt="${photo.title || 'Gallery Image'}" 
                     class="w-full h-full object-cover cursor-pointer group-hover:scale-105 transition-transform duration-300"
                     onclick="openFullSizeViewer('/storage/posts/${photo.file}')">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center p-2">
                <button onclick="event.stopPropagation(); downloadPhotoFromGallery('/storage/posts/${photo.file}', '${photo.file}')" 
                        class="flex items-center justify-center w-full px-2 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-md text-xs font-medium transition-colors duration-200">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download
                </button>
            </div>
        </div>
    `).join('');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Close Full Gallery Modal
function closeFullGallery(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('fullGalleryModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Open Full Size Image Viewer
function openFullSizeViewer(imageUrl) {
    const modal = document.getElementById('fullSizeViewer');
    const img = document.getElementById('fullSizeImage');
    
    img.src = imageUrl;
    currentFullSizeImageUrl = imageUrl;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Close Full Size Image Viewer
function closeFullSizeViewer(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('fullSizeViewer');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Download Full Size Image
function downloadFullSizeImage() {
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        pendingDownloadAction = () => downloadFullSizeImage();
        showAuthModal();
        return;
    }
    
    const img = document.getElementById('fullSizeImage');
    const galleryId = currentGalleryData ? currentGalleryData.id : null;
    
    // Track download to backend
    if (galleryId && img && img.src) {
        fetch(`/gallery/${galleryId}/download`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ file_name: img.src.split('/').pop() })
        }).catch(err => console.warn('Download tracking failed:', err));
    }
    
    const link = document.createElement('a');
    link.href = img.src;
    link.download = img.alt || 'gallery-image';
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showNotification('Download dimulai!', 'success');
}

// Download Photo from Gallery Modal
function downloadPhotoFromGallery(imageUrl, filename) {
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        pendingDownloadAction = () => downloadPhotoFromGallery(imageUrl, filename);
        showAuthModal();
        return;
    }
    
    const galleryId = currentGalleryData ? currentGalleryData.id : null;
    
    // Track download to backend
    if (galleryId && imageUrl) {
        fetch(`/gallery/${galleryId}/download`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ file_name: filename || imageUrl.split('/').pop() })
        }).catch(err => console.warn('Download tracking failed:', err));
    }
    
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = filename || imageUrl.split('/').pop();
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showNotification('Download dimulai!', 'success');
}

// Track Gallery View (no login required)
async function trackGalleryView(galleryId) {
    try {
        const response = await fetch(`/gallery/${galleryId}/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        // If CSRF error or other, quietly ignore to avoid UX issues
        if (!response.ok) return;
        const data = await response.json();
        if (!data.success) return;

        // Update UI with actual server count (no optimistic update)
        const modalViewsCount = document.getElementById('modalViewsCount');
        if (modalViewsCount && data.views_count !== undefined) {
            modalViewsCount.textContent = data.views_count;
        }
        
        const gridViewCountEl = document.querySelector(`[data-view-count="${galleryId}"] .view-count-number`);
        if (gridViewCountEl && data.views_count !== undefined) {
            const count = data.views_count;
            gridViewCountEl.textContent = count >= 1000 ? (count / 1000).toFixed(1) + 'k' : count;
        }
    } catch (error) {
        // Silently fail; avoid blocking user flow
        console.warn('View tracking failed:', error);
    }
}

// Quick Like from Grid (requires login)
async function quickLike(galleryId, button) {
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        showAuthModal();
        return;
    }
    
    try {
        const response = await fetch(`/gallery/${galleryId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        const data = await response.json();
        
        if (response.status === 401) {
            showAuthModal();
            return;
        }
        
        if (data.success) {
            // Update button state in grid
            button.dataset.liked = data.liked;
            const heartIcon = button.querySelector('.heart-icon');
            
            if (data.liked) {
                button.classList.add('text-red-500');
                heartIcon.style.fill = 'currentColor';
                heartIcon.style.animation = 'heartBeat 0.3s ease';
                setTimeout(() => {
                    heartIcon.style.animation = '';
                }, 300);
            } else {
                button.classList.remove('text-red-500');
                heartIcon.style.fill = 'none';
            }
            
            // Update like count in grid (now inside the button)
            const gridLikeCount = button.querySelector('.like-count-number');
            if (gridLikeCount) {
                const formattedCount = data.likes_count >= 1000 
                    ? (data.likes_count / 1000).toFixed(1) + 'k' 
                    : data.likes_count;
                gridLikeCount.textContent = formattedCount;
            }
            
            // Update like count in modal if open
            const modalLikeBtn = document.getElementById('modalLikeBtn');
            if (modalLikeBtn && modalLikeBtn.dataset.galleryId == galleryId) {
                // Update modal like count
                const modalLikesCount = document.getElementById('modalLikesCount');
                if (modalLikesCount) {
                    modalLikesCount.textContent = data.likes_count;
                }
                
                // Update modal button state
                modalLikeBtn.dataset.liked = data.liked;
                const modalHeartIcon = modalLikeBtn.querySelector('.heart-icon');
                if (data.liked) {
                    modalLikeBtn.classList.add('text-red-500');
                    if (modalHeartIcon) {
                        modalHeartIcon.style.fill = 'currentColor';
                    }
                } else {
                    modalLikeBtn.classList.remove('text-red-500');
                    if (modalHeartIcon) {
                        modalHeartIcon.style.fill = 'none';
                    }
                }
            }
        }
    } catch (error) {
        console.error('Error toggling like:', error);
        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('galleryDetailModal').classList.contains('flex')) {
        if (e.key === 'Escape') {
            closeGalleryDetail();
        }
    }
    
    if (document.getElementById('fullSizeViewer').classList.contains('flex')) {
        if (e.key === 'Escape') {
            closeFullSizeViewer();
        }
    }
});