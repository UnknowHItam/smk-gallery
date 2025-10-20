// Gallery Interactions JavaScript

let currentGalleryId = null;

// Initialize interactions when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Load stats for all galleries
    document.querySelectorAll('[data-gallery-id]').forEach(element => {
        const galleryId = element.dataset.galleryId;
        loadGalleryStats(galleryId);
    });
});

// Load gallery statistics
async function loadGalleryStats(galleryId) {
    try {
        const response = await fetch(`/gallery/${galleryId}/stats`);
        const data = await response.json();
        
        if (data.success) {
            const container = document.querySelector(`[data-gallery-id="${galleryId}"]`);
            if (container) {
                // Update counts
                container.querySelector('.likes-count').textContent = data.stats.likes_count;
                container.querySelector('.shares-count').textContent = data.stats.shares_count;
                
                // Update like button state
                const likeBtn = container.querySelector('.like-btn');
                likeBtn.dataset.liked = data.stats.is_liked;
            }
        }
    } catch (error) {
        console.error('Error loading stats:', error);
    }
}

// Toggle Like
async function toggleLike(galleryId) {
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
            // Not logged in - redirect to login
            showLoginPrompt(data.message, data.redirect);
            return;
        }
        
        if (data.success) {
            const container = document.querySelector(`[data-gallery-id="${galleryId}"]`);
            const likeBtn = container.querySelector('.like-btn');
            const likesCount = container.querySelector('.likes-count');
            
            // Update button state
            likeBtn.dataset.liked = data.liked;
            likesCount.textContent = data.likes_count;
            
            // Animate heart
            if (data.liked) {
                likeBtn.querySelector('.heart-icon').style.animation = 'heartBeat 0.3s ease';
                setTimeout(() => {
                    likeBtn.querySelector('.heart-icon').style.animation = '';
                }, 300);
            }
        }
    } catch (error) {
        console.error('Error toggling like:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    }
}

// Open Share Modal
function openShareModal(galleryId) {
    currentGalleryId = galleryId;
    const modal = document.getElementById('shareModal');
    const shareLink = document.getElementById('shareLink');
    
    // Set share link
    shareLink.value = window.location.origin + '/gallery/' + galleryId;
    
    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Close Share Modal
function closeShareModal(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('shareModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    
    // Hide copy feedback
    document.getElementById('copyFeedback').classList.add('hidden');
}

// Share to WhatsApp
async function shareToWhatsApp() {
    const url = document.getElementById('shareLink').value;
    const text = 'Lihat galeri kegiatan SMKN 4 Bogor ini!';
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
    
    await trackShare('whatsapp');
    window.open(whatsappUrl, '_blank');
}

// Share to Facebook
async function shareToFacebook() {
    const url = document.getElementById('shareLink').value;
    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
    
    await trackShare('facebook');
    window.open(facebookUrl, '_blank', 'width=600,height=400');
}

// Share to Twitter
async function shareToTwitter() {
    const url = document.getElementById('shareLink').value;
    const text = 'Lihat galeri kegiatan SMKN 4 Bogor ini!';
    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
    
    await trackShare('twitter');
    window.open(twitterUrl, '_blank', 'width=600,height=400');
}

// Share to Telegram
async function shareToTelegram() {
    const url = document.getElementById('shareLink').value;
    const text = 'Lihat galeri kegiatan SMKN 4 Bogor ini!';
    const telegramUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
    
    await trackShare('telegram');
    window.open(telegramUrl, '_blank');
}

// Copy Link
async function copyLink() {
    const input = document.getElementById('shareLink');
    input.select();
    document.execCommand('copy');
    
    // Show feedback
    const feedback = document.getElementById('copyFeedback');
    feedback.classList.remove('hidden');
    
    setTimeout(() => {
        feedback.classList.add('hidden');
    }, 3000);
    
    await trackShare('copy_link');
}

// Track Share
async function trackShare(platform) {
    if (!currentGalleryId) return;
    
    try {
        await fetch(`/gallery/${currentGalleryId}/share`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ platform })
        });
        
        // Update share count
        const container = document.querySelector(`[data-gallery-id="${currentGalleryId}"]`);
        if (container) {
            const sharesCount = container.querySelector('.shares-count');
            sharesCount.textContent = parseInt(sharesCount.textContent) + 1;
        }
    } catch (error) {
        console.error('Error tracking share:', error);
    }
}

// Download Gallery
function downloadGallery(galleryId) {
    // Check if user is logged in
    if (!isPublicUserAuthenticated) {
        pendingDownloadAction = () => downloadGallery(galleryId);
        showAuthModal();
        return;
    }

    // Get the first photo from the gallery
    fetch(`/gallery/${galleryId}/detail`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.gallery.photos && data.gallery.photos.length > 0) {
                const firstPhoto = data.gallery.photos[0];
                const imageUrl = `/storage/posts/${firstPhoto.file}`;
                
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = firstPhoto.title || 'gallery_image.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showNotification('Download dimulai!', 'success');
            } else {
                showNotification('Tidak ada foto untuk didownload', 'error');
            }
        })
        .catch(error => {
            console.error('Error downloading gallery:', error);
            showNotification('Gagal mendownload foto', 'error');
        });
}

// Show Login Prompt
function showLoginPrompt(message, redirectUrl) {
    if (confirm(message + '\n\nKlik OK untuk login sekarang.')) {
        window.location.href = redirectUrl;
    }
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}
