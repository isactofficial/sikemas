/**
 * Add to Cart Functionality
 * Include this script in your product page (produk.blade.php)
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    if (!csrfToken) {
        console.error('CSRF token not found. Please add <meta name="csrf-token" content="{{ csrf_token() }}"> to your page head.');
        return;
    }

    // Add event listener to all "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get product data from button attributes or closest product card
            const productCard = this.closest('.product-card') || this.closest('[data-product]');
            
            if (!productCard) {
                console.error('Product card not found');
                return;
            }
            
            // Extract product data
            const productData = {
                product_name: productCard.dataset.productName || productCard.querySelector('.product-name')?.textContent.trim(),
                material: productCard.dataset.material || productCard.querySelector('[data-material]')?.value || null,
                size: productCard.dataset.size || productCard.querySelector('[data-size]')?.value || null,
                design: productCard.dataset.design || productCard.querySelector('[data-design]')?.value || null,
                quantity: parseInt(productCard.dataset.quantity || productCard.querySelector('[data-quantity]')?.value || 1),
                unit_price: parseFloat(productCard.dataset.price || productCard.querySelector('[data-price]')?.textContent.replace(/[^0-9]/g, '') || 0),
                product_image: productCard.dataset.image || productCard.querySelector('.product-image')?.src || null
            };
            
            // Validate product data
            if (!productData.product_name || !productData.unit_price) {
                alert('Data produk tidak lengkap. Silakan coba lagi.');
                return;
            }
            
            // Disable button during request
            const originalText = this.textContent;
            this.disabled = true;
            this.textContent = 'Menambahkan...';
            
            // Send request to add to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(productData)
            })
            .then(response => {
                if (!response.ok) {
                    // Check if user is not authenticated
                    if (response.status === 401 || response.status === 419) {
                        throw new Error('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.');
                    }
                    throw new Error('Terjadi kesalahan. Silakan coba lagi.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    showNotification('success', data.message);
                    
                    // Update cart count badge if exists
                    updateCartBadge(data.cart_count);
                    
                    // Reset button
                    this.disabled = false;
                    this.textContent = originalText;
                    
                    // Optional: Show animation or feedback
                    this.classList.add('added-to-cart');
                    setTimeout(() => {
                        this.classList.remove('added-to-cart');
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Check if error is authentication related
                if (error.message.includes('login')) {
                    // Redirect to login page
                    if (confirm(error.message + '\n\nApakah Anda ingin login sekarang?')) {
                        window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
                    }
                } else {
                    showNotification('error', error.message);
                }
                
                // Reset button
                this.disabled = false;
                this.textContent = originalText;
            });
        });
    });
    
    /**
     * Update cart count badge
     */
    function updateCartBadge(count) {
        const cartBadge = document.querySelector('.cart-badge');
        const cartCountElements = document.querySelectorAll('[data-cart-count]');
        
        if (cartBadge) {
            cartBadge.textContent = count;
            cartBadge.style.display = count > 0 ? 'inline-block' : 'none';
        }
        
        cartCountElements.forEach(element => {
            element.textContent = count;
        });
    }
    
    /**
     * Show notification message
     */
    function showNotification(type, message) {
        // Remove existing notification if any
        const existingNotification = document.querySelector('.cart-notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `cart-notification cart-notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close">&times;</button>
        `;
        
        // Add styles if not already present
        if (!document.querySelector('#cart-notification-styles')) {
            const styles = document.createElement('style');
            styles.id = 'cart-notification-styles';
            styles.textContent = `
                .cart-notification {
                    position: fixed;
                    top: 80px;
                    right: 20px;
                    min-width: 300px;
                    max-width: 400px;
                    padding: 15px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 9999;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    animation: slideIn 0.3s ease-out;
                }
                
                @keyframes slideIn {
                    from {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                .cart-notification-success {
                    background: #d4edda;
                    border: 1px solid #c3e6cb;
                    color: #155724;
                }
                
                .cart-notification-error {
                    background: #f8d7da;
                    border: 1px solid #f5c6cb;
                    color: #721c24;
                }
                
                .notification-content {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    flex: 1;
                }
                
                .notification-content i {
                    font-size: 1.2rem;
                }
                
                .notification-close {
                    background: none;
                    border: none;
                    font-size: 1.5rem;
                    cursor: pointer;
                    opacity: 0.7;
                    transition: opacity 0.2s;
                    padding: 0;
                    margin-left: 15px;
                    color: inherit;
                }
                
                .notification-close:hover {
                    opacity: 1;
                }
                
                .add-to-cart-btn.added-to-cart {
                    animation: pulse 0.5s;
                }
                
                @keyframes pulse {
                    0%, 100% {
                        transform: scale(1);
                    }
                    50% {
                        transform: scale(1.05);
                    }
                }
            `;
            document.head.appendChild(styles);
        }
        
        // Add to page
        document.body.appendChild(notification);
        
        // Close button handler
        notification.querySelector('.notification-close').addEventListener('click', function() {
            notification.remove();
        });
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
    
    /**
     * Load initial cart count on page load
     */
    fetch('/cart/count', {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        updateCartBadge(data.count);
    })
    .catch(error => {
        console.error('Error loading cart count:', error);
    });
});

/**
 * Example HTML structure for product card:
 * 
 * <div class="product-card" 
 *      data-product-name="Kotak Kemasan Khusus"
 *      data-material="Karton"
 *      data-size="20x15x30 cm"
 *      data-design="Kustom"
 *      data-price="5000"
 *      data-quantity="1"
 *      data-image="/path/to/image.jpg">
 *     
 *     <img src="/path/to/image.jpg" alt="Product" class="product-image">
 *     <h3 class="product-name">Kotak Kemasan Khusus</h3>
 *     <p class="product-price" data-price>Rp 5.000</p>
 *     
 *     <button class="add-to-cart-btn">Tambah ke Keranjang</button>
 * </div>
 * 
 * Or with form inputs:
 * 
 * <div class="product-card" data-product>
 *     <input type="hidden" name="product_name" value="Kotak Kemasan" class="product-name">
 *     <select name="material" data-material>
 *         <option value="Karton">Karton</option>
 *     </select>
 *     <input type="text" name="size" data-size value="20x15x30 cm">
 *     <input type="number" name="quantity" data-quantity value="1" min="1">
 *     <span data-price>5000</span>
 *     
 *     <button class="add-to-cart-btn">Tambah ke Keranjang</button>
 * </div>
 */