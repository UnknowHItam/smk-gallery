// Gallery Detail Modal JavaScript

let currentGalleryData = null;
let currentImageIndex = 0;

// Open Gallery Detail Modal
async function openGalleryDetail(postId) {
    try {
        const response = await fetch(`/gallery/${postId}/detail`);
        const data = await response.json();
        
        if (data.success) {
            currentGalleryData = data.gallery;
            currentImageIndex = 0;
            
            // Populate modal with data
            populateModal(data.gallery);
            
            // Show modal
            const modal = document.getElementById('galleryDetailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
    } catch (error) {
        console.error('Error loading gallery detail:', error);
        alert('Gagal memuat detail galeri');
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
    
    // Update like and share counts
    document.getElementById('modalLikesCount').textContent = gallery.stats.likes_count;
    document.getElementById('modalSharesCount').textContent = gallery.stats.shares_count;
    
    // Update like button appearance
    const likeBtn = document.getElementById('modalLikeBtn');
    if (gallery.stats.is_liked) {
        likeBtn.classList.add('text-red-500');
    } else {
        likeBtn.classList.remove('text-red-500');
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
    
    if (!photos || photos.length === 0) {
        grid.innerHTML = '<p class="text-gray-500 text-center col-span-2">Tidak ada gambar</p>';
        return;
    }
    
    grid.innerHTML = photos.map(photo => `
        <img src="/storage/posts/${photo.file}" 
             alt="${photo.title || 'Gallery Image'}" 
             class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity"
             onclick="changeMainImage('/storage/posts/${photo.file}')">
    `).join('');
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
            
            // Update like count
            document.getElementById('modalLikesCount').textContent = data.likes_count;
            
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
    if (imageUrl) {
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
        <img src="/storage/posts/${photo.file}" 
             alt="${photo.title || 'Gallery Image'}" 
             class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity"
             onclick="openFullSizeViewer('/storage/posts/${photo.file}')">
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
    const img = document.getElementById('fullSizeImage');
    const link = document.createElement('a');
    link.href = img.src;
    link.download = img.alt || 'gallery-image';
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
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