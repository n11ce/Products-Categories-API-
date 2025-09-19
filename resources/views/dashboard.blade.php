<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            color: #1a1a1a;
            font-size: 24px;
            font-weight: 600;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .user-name {
            color: #666;
            font-weight: 500;
        }
        .btn-logout {
            padding: 8px 16px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .btn-logout:hover {
            background: #dc2626;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }
        .section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 24px;
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 16px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
        }
        .btn-primary {
            padding: 10px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .btn-primary:hover {
            background: #2563eb;
        }
        .btn-secondary {
            padding: 8px 16px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
            margin-right: 8px;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .btn-danger {
            padding: 6px 12px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
            margin-left: 8px;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-warning {
            padding: 6px 12px;
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
            margin-left: 8px;
        }
        .btn-warning:hover {
            background: #d97706;
        }
        .list {
            list-style: none;
            margin-top: 16px;
        }
        .list-item {
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-bottom: 8px;
            background: #f9fafb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .list-item-content {
            flex: 1;
        }
        .list-item-actions {
            display: flex;
            gap: 8px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 24px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
        }
        .close {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #666;
        }
        .close:hover {
            color: #000;
        }
        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Yönetim Paneli</h1>
        <div class="user-info">
            <span class="user-name" id="userName">Kullanıcı</span>
            <button class="btn-logout" onclick="logout()">Çıkış Yap</button>
        </div>
    </div>

    <div class="container">
        <div id="alertContainer"></div>

        <!-- Categories Section -->
        <div class="section">
            <h2 class="section-title">Kategoriler</h2>
            
            <div style="margin-bottom: 16px;">
                <button class="btn-secondary" onclick="loadCategories()">Kategorileri Yükle</button>
            </div>

            <form id="categoryForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="cat_name">Kategori Adı</label>
                        <input type="text" id="cat_name" class="form-input" placeholder="Kategori adı" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="cat_slug">Slug</label>
                        <input type="text" id="cat_slug" class="form-input" placeholder="kategori-slug" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Kategori Ekle</button>
            </form>

            <ul id="categories" class="list"></ul>
        </div>

        <!-- Products Section -->
        <div class="section">
            <h2 class="section-title">Ürünler</h2>
            
            <div style="margin-bottom: 16px;">
                <button class="btn-secondary" onclick="loadProducts()">Ürünleri Yükle</button>
            </div>

            <form id="productForm">
                <div class="form-group">
                    <label class="form-label" for="pr_title">Ürün Başlığı</label>
                    <input type="text" id="pr_title" class="form-input" placeholder="Ürün başlığı" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="pr_description">Açıklama</label>
                    <textarea id="pr_description" class="form-input" placeholder="Ürün açıklaması" rows="3"></textarea>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="pr_stock">Stok</label>
                        <input type="number" id="pr_stock" class="form-input" placeholder="0" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pr_category_id">Kategori ID</label>
                        <input type="number" id="pr_category_id" class="form-input" placeholder="1" min="1">
                    </div>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="pr_price_tl">Fiyat (TL)</label>
                        <input type="number" id="pr_price_tl" class="form-input" placeholder="0.00" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pr_price_eur">Fiyat (EUR)</label>
                        <input type="number" id="pr_price_eur" class="form-input" placeholder="0.00" step="0.01" min="0">
                    </div>
                </div>
                
                <button type="submit" class="btn-primary">Ürün Ekle</button>
            </form>

            <ul id="products" class="list"></ul>
        </div>
    </div>

    <!-- Category Edit Modal -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Kategori Düzenle</h2>
                <span class="close" onclick="closeModal('categoryModal')">&times;</span>
            </div>
            <form id="editCategoryForm">
                <input type="hidden" id="edit_cat_id">
                <div class="form-group">
                    <label class="form-label" for="edit_cat_name">Kategori Adı</label>
                    <input type="text" id="edit_cat_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit_cat_slug">Slug</label>
                    <input type="text" id="edit_cat_slug" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('categoryModal')">İptal</button>
                    <button type="submit" class="btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Edit Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Ürün Düzenle</h2>
                <span class="close" onclick="closeModal('productModal')">&times;</span>
            </div>
            <form id="editProductForm">
                <input type="hidden" id="edit_pr_id">
                <div class="form-group">
                    <label class="form-label" for="edit_pr_title">Ürün Başlığı</label>
                    <input type="text" id="edit_pr_title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit_pr_description">Açıklama</label>
                    <textarea id="edit_pr_description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="edit_pr_stock">Stok</label>
                        <input type="number" id="edit_pr_stock" class="form-input" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit_pr_category_id">Kategori ID</label>
                        <input type="number" id="edit_pr_category_id" class="form-input" min="1">
                    </div>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="edit_pr_price_tl">Fiyat (TL)</label>
                        <input type="number" id="edit_pr_price_tl" class="form-input" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit_pr_price_eur">Fiyat (EUR)</label>
                        <input type="number" id="edit_pr_price_eur" class="form-input" step="0.01" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('productModal')">İptal</button>
                    <button type="submit" class="btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const apiBase = '/api';
        let token = localStorage.getItem('api_token');
        let user = JSON.parse(localStorage.getItem('user') || '{}');

        // Check if user is logged in
        if (!token) {
            window.location.href = '/login';
        }

        // Set user name
        document.getElementById('userName').textContent = user.name || 'Kullanıcı';

        async function apiFetch(path, options = {}) {
            const headers = Object.assign({ 'Content-Type': 'application/json' }, options.headers || {});
            if (token) headers['Authorization'] = 'Bearer ' + token;
            
            const res = await fetch(apiBase + path, Object.assign({}, options, { headers }));
            if (!res.ok) {
                const msg = await res.text();
                throw new Error(msg || ('HTTP ' + res.status));
            }
            const ct = res.headers.get('content-type') || '';
            return ct.includes('application/json') ? res.json() : res.text();
        }

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        function logout() {
            localStorage.removeItem('api_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }

        // Categories
        async function loadCategories() {
            try {
                const list = await apiFetch('/categories');
                const ul = document.getElementById('categories');
                ul.innerHTML = '';
                list.forEach((c) => {
                    const li = document.createElement('li');
                    li.className = 'list-item';
                    li.innerHTML = `
                        <div class="list-item-content">
                            #${c.id} ${c.name} (${c.products_count || 0} ürün)
                        </div>
                        <div class="list-item-actions">
                            <button class="btn-warning" onclick="editCategory(${c.id}, '${c.name}', '${c.slug}')">Düzenle</button>
                            <button class="btn-danger" onclick="deleteCategory(${c.id}, '${c.name}')">Sil</button>
                        </div>
                    `;
                    ul.appendChild(li);
                });
                showAlert('Kategoriler yüklendi', 'success');
            } catch (err) {
                showAlert('Kategori yükleme hatası: ' + err.message, 'error');
            }
        }

        function editCategory(id, name, slug) {
            document.getElementById('edit_cat_id').value = id;
            document.getElementById('edit_cat_name').value = name;
            document.getElementById('edit_cat_slug').value = slug;
            document.getElementById('categoryModal').style.display = 'block';
        }

        async function deleteCategory(id, name) {
            if (confirm(`"${name}" kategorisini silmek istediğinizden emin misiniz? Bu kategoriye ait ürünler "Genel" kategorisine taşınacak.`)) {
                try {
                    await apiFetch(`/categories/${id}`, { method: 'DELETE' });
                    await loadCategories();
                    showAlert('Kategori silindi', 'success');
                } catch (err) {
                    showAlert('Kategori silme hatası: ' + err.message, 'error');
                }
            }
        }

        document.getElementById('categoryForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const body = {
                    name: document.getElementById('cat_name').value,
                    slug: document.getElementById('cat_slug').value
                };
                await apiFetch('/categories', { method: 'POST', body: JSON.stringify(body) });
                document.getElementById('categoryForm').reset();
                await loadCategories();
                showAlert('Kategori eklendi', 'success');
            } catch (err) {
                showAlert('Kategori ekleme hatası: ' + err.message, 'error');
            }
        });

        // Products
        async function loadProducts() {
            try {
                const resp = await apiFetch('/products');
                const items = resp?.data || [];
                const ul = document.getElementById('products');
                ul.innerHTML = '';
                items.forEach((p) => {
                    const li = document.createElement('li');
                    li.className = 'list-item';
                    li.innerHTML = `
                        <div class="list-item-content">
                            <strong>#${p.id} ${p.title}</strong><br>
                            <small>Stok: ${p.stock} | TL: ${p.price_tl} | EUR: ${p.price_eur} | Kategori: ${p.category?.name || p.category_id}</small>
                            ${p.description ? `<br><small>${p.description}</small>` : ''}
                        </div>
                        <div class="list-item-actions">
                            <button class="btn-warning" onclick="editProduct(${p.id}, '${p.title.replace(/'/g, "\\'")}', '${p.description ? p.description.replace(/'/g, "\\'") : ''}', ${p.stock}, ${p.price_tl}, ${p.price_eur}, ${p.category_id})">Düzenle</button>
                            <button class="btn-danger" onclick="deleteProduct(${p.id}, '${p.title.replace(/'/g, "\\'")}')">Sil</button>
                        </div>
                    `;
                    ul.appendChild(li);
                });
                showAlert('Ürünler yüklendi', 'success');
            } catch (err) {
                showAlert('Ürün yükleme hatası: ' + err.message, 'error');
            }
        }

        function editProduct(id, title, description, stock, priceTl, priceEur, categoryId) {
            document.getElementById('edit_pr_id').value = id;
            document.getElementById('edit_pr_title').value = title;
            document.getElementById('edit_pr_description').value = description;
            document.getElementById('edit_pr_stock').value = stock;
            document.getElementById('edit_pr_price_tl').value = priceTl;
            document.getElementById('edit_pr_price_eur').value = priceEur;
            document.getElementById('edit_pr_category_id').value = categoryId;
            document.getElementById('productModal').style.display = 'block';
        }

        async function deleteProduct(id, title) {
            if (confirm(`"${title}" ürününü silmek istediğinizden emin misiniz?`)) {
                try {
                    await apiFetch(`/products/${id}`, { method: 'DELETE' });
                    await loadProducts();
                    showAlert('Ürün silindi', 'success');
                } catch (err) {
                    showAlert('Ürün silme hatası: ' + err.message, 'error');
                }
            }
        }

        document.getElementById('productForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const body = {
                    title: document.getElementById('pr_title').value,
                    description: document.getElementById('pr_description').value,
                    stock: Number(document.getElementById('pr_stock').value || 0),
                    price_tl: Number(document.getElementById('pr_price_tl').value || 0),
                    price_eur: Number(document.getElementById('pr_price_eur').value || 0),
                    category_id: Number(document.getElementById('pr_category_id').value)
                };
                await apiFetch('/products', { method: 'POST', body: JSON.stringify(body) });
                document.getElementById('productForm').reset();
                await loadProducts();
                showAlert('Ürün eklendi', 'success');
            } catch (err) {
                showAlert('Ürün ekleme hatası: ' + err.message, 'error');
            }
        });

        // Modal functions
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const categoryModal = document.getElementById('categoryModal');
            const productModal = document.getElementById('productModal');
            if (event.target === categoryModal) {
                categoryModal.style.display = 'none';
            }
            if (event.target === productModal) {
                productModal.style.display = 'none';
            }
        }

        // Edit Category Form
        document.getElementById('editCategoryForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const id = document.getElementById('edit_cat_id').value;
                const body = {
                    name: document.getElementById('edit_cat_name').value,
                    slug: document.getElementById('edit_cat_slug').value
                };
                await apiFetch(`/categories/${id}`, { 
                    method: 'PUT', 
                    body: JSON.stringify(body) 
                });
                closeModal('categoryModal');
                await loadCategories();
                showAlert('Kategori güncellendi', 'success');
            } catch (err) {
                showAlert('Kategori güncelleme hatası: ' + err.message, 'error');
            }
        });

        // Edit Product Form
        document.getElementById('editProductForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const id = document.getElementById('edit_pr_id').value;
                const body = {
                    title: document.getElementById('edit_pr_title').value,
                    description: document.getElementById('edit_pr_description').value,
                    stock: Number(document.getElementById('edit_pr_stock').value || 0),
                    price_tl: Number(document.getElementById('edit_pr_price_tl').value || 0),
                    price_eur: Number(document.getElementById('edit_pr_price_eur').value || 0),
                    category_id: Number(document.getElementById('edit_pr_category_id').value)
                };
                await apiFetch(`/products/${id}`, { 
                    method: 'PUT', 
                    body: JSON.stringify(body) 
                });
                closeModal('productModal');
                await loadProducts();
                showAlert('Ürün güncellendi', 'success');
            } catch (err) {
                showAlert('Ürün güncelleme hatası: ' + err.message, 'error');
            }
        });
    </script>
</body>
</html>
