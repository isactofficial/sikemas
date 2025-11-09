<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Transaction - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--skm-teal:#1F6D72;--skm-blue:#074159;--skm-blue-2:#053244;--skm-accent:#ff5722;--skm-bg:#F4F7F6;--skm-border:#E5E7EB}*{box-sizing:border-box;margin:0;padding:0}body{font-family:'Besley',system-ui,sans-serif;background:var(--skm-bg);min-height:100vh}.skm-admin-main{margin-left:240px;padding:40px 24px;display:flex;flex-direction:column;gap:24px}.skm-header{background:#fff;border-radius:12px;padding:24px;box-shadow:0 2px 10px rgba(0,0,0,.04)}.skm-header h1{color:var(--skm-blue);font-size:28px;font-weight:800;margin-bottom:8px}.skm-header p{color:#23C8B8;font-size:14px}.skm-form-container{background:#fff;border-radius:12px;padding:32px 40px;box-shadow:0 2px 10px rgba(0,0,0,.04);border:1px solid var(--skm-border)}.form-section{margin-bottom:32px}.form-section:last-child{margin-bottom:0}.section-title{color:var(--skm-blue);font-size:20px;font-weight:800;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid var(--skm-border)}.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}.form-grid.single{grid-template-columns:1fr}.form-group{display:flex;flex-direction:column;gap:8px}.form-group label{font-size:14px;font-weight:700;color:var(--skm-blue)}.form-group label .required{color:var(--skm-accent)}.form-control{padding:12px 16px;border:1.5px solid var(--skm-border);border-radius:8px;font-size:14px;font-family:'Besley',serif;color:var(--skm-blue-2);transition:all .2s ease}.form-control:focus{outline:0;border-color:var(--skm-teal);box-shadow:0 0 0 3px rgba(31,109,114,.1)}.form-control::placeholder{color:#9CA3AF}.form-control:disabled{background-color:#F3F4F6;cursor:not-allowed}textarea.form-control{min-height:100px;resize:vertical}select.form-control{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23074159' d='M6 9L1 4h10z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px}.item-card{border:2px solid var(--skm-border);border-radius:12px;padding:20px;margin-bottom:16px;position:relative;background:#FAFBFC}.item-card:last-child{margin-bottom:0}.item-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--skm-border)}.item-number{font-size:16px;font-weight:800;color:var(--skm-blue)}.remove-item-btn{background:#FEE2E2;color:#991B1B;border:none;padding:6px 12px;border-radius:6px;font-size:12px;font-weight:700;cursor:pointer;transition:all .2s ease}.remove-item-btn:hover{background:#FDD2D2}.add-item-btn{background:var(--skm-teal);color:#fff;border:none;padding:12px 24px;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .2s ease;margin-top:16px}.add-item-btn:hover{background:var(--skm-blue)}.form-row{display:grid;grid-template-columns:1fr;gap:16px;margin-bottom:16px}.form-row.two-cols{grid-template-columns:repeat(2,1fr)}.form-group.full{grid-column:1/-1}.alert{padding:14px 18px;border-radius:8px;margin-bottom:20px;display:flex;align-items:center;gap:12px;font-size:14px}.alert-danger{background:#FEE2E2;color:#991B1B;border:1px solid #FDD2D2}.alert i{font-size:18px}.form-actions{display:flex;gap:12px;justify-content:flex-end;padding-top:24px;border-top:2px solid var(--skm-border)}.btn{padding:12px 24px;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .2s ease;text-decoration:none;border:none;font-family:'Besley',serif}.btn-primary{background:var(--skm-teal);color:#fff}.btn-primary:hover{background:var(--skm-blue)}.btn-secondary{background:#E5E7EB;color:var(--skm-blue-2)}.btn-secondary:hover{background:#D1D5DB}.help-text{font-size:12px;color:#6B7280;margin-top:4px}@media (max-width:1024px){.skm-admin-main{margin-left:0;padding:20px}}@media (max-width:768px){.form-grid,.form-row.two-cols{grid-template-columns:1fr}}
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')
    <main class="skm-admin-main">
        <div class="skm-header">
            <h1>Tambah Transaksi Baru</h1>
            <p>Isi form di bawah untuk menambah transaksi baru</p>
        </div>
        <form action="{{ route('admin.transactions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="skm-form-container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div><strong>Terjadi kesalahan:</strong><ul style="margin:8px 0 0 0;padding-left:20px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    </div>
                @endif
                <div class="form-section">
                    <h2 class="section-title">Informasi Customer</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="user_id">Pilih Customer <span class="required">*</span></label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="" disabled {{ !old('user_id') ? 'selected' : '' }}>Pilih Customer</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="address-wrapper" style="display:none">
                            <label for="shipping_address_id">Alamat Pengiriman <span class="required">*</span></label>
                            <select name="shipping_address_id" id="shipping_address_id" class="form-control" required disabled>
                                <option value="">Pilih User Terlebih Dahulu</option>
                            </select>
                            <span class="help-text">Alamat pengiriman akan muncul setelah memilih customer</span>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="section-title">Detail Pengiriman</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="shipping_cost">Biaya Pengiriman (Rp)</label>
                            <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" value="{{ old('shipping_cost',0) }}" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran</label>
                            <input type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Contoh: Transfer Bank, COD, E-Wallet" value="{{ old('payment_method') }}">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="section-title">Item Pesanan</h2>
                    <div id="order-items-container">
                        @if(old('items'))
                            @foreach(old('items') as $index => $item)
                                <div class="item-card">
                                    <div class="item-header">
                                        <span class="item-number">Item #{{ $index + 1 }}</span>
                                        <button type="button" class="remove-item-btn" onclick="removeItem(this)"><i class="fas fa-times"></i> Hapus</button>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Pilih Produk <span class="required">*</span></label>
                                            <select name="items[{{ $index }}][product_name]" class="form-control product-select" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->name }}" data-price="{{ $product->price }}" {{ (old('items.'.$index.'.product_name') == $product->name) ? 'selected' : '' }}>
                                                        {{ $product->name }} @if($product->price) - Rp {{ number_format($product->price, 0, ',', '.') }} @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row two-cols">
                                        <div class="form-group">
                                            <label>Kuantitas <span class="required">*</span></label>
                                            <input type="number" name="items[{{ $index }}][quantity]" class="form-control" value="{{ old('items.'.$index.'.quantity', 1) }}" min="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Satuan (Rp) <span class="required">*</span></label>
                                            <input type="number" name="items[{{ $index }}][unit_price]" class="form-control price-input" value="{{ old('items.'.$index.'.unit_price', 0) }}" min="0" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group full">
                                            <label>File Desain Kustom</label>
                                            <input type="file" name="items[{{ $index }}][custom_design_file]" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr">
                                            <span class="help-text">Format: JPG, PNG, PDF, AI, PSD, CDR (Maks. 10MB)</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="item-card">
                                <div class="item-header">
                                    <span class="item-number">Item #1</span>
                                    <button type="button" class="remove-item-btn" onclick="removeItem(this)" style="display:none"><i class="fas fa-times"></i> Hapus</button>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Pilih Produk <span class="required">*</span></label>
                                        <select name="items[0][product_name]" class="form-control product-select" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->name }}" data-price="{{ $product->price }}">
                                                    {{ $product->name }} @if($product->price) - Rp {{ number_format($product->price, 0, ',', '.') }} @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row two-cols">
                                    <div class="form-group">
                                        <label>Kuantitas <span class="required">*</span></label>
                                        <input type="number" name="items[0][quantity]" class="form-control" value="1" min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Satuan (Rp) <span class="required">*</span></label>
                                        <input type="number" name="items[0][unit_price]" class="form-control price-input" value="0.00" min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group full">
                                        <label>File Desain Kustom</label>
                                        <input type="file" name="items[0][custom_design_file]" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr">
                                        <span class="help-text">Format: JPG, PNG, PDF, AI, PSD, CDR (Maks. 10MB)</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="add-item-btn" onclick="addItem()"><i class="fas fa-plus"></i> Tambah Item</button>
                </div>
                <div class="form-section">
                    <h2 class="section-title">Catatan</h2>
                    <div class="form-grid single">
                        <div class="form-group">
                            <label for="notes">Catatan Tambahan</label>
                            <textarea name="notes" id="notes" class="form-control" placeholder="Catatan atau instruksi khusus untuk pesanan ini...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="section-title">Status Pesanan</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="payment_status">Status Pembayaran <span class="required">*</span></label>
                            <select name="payment_status" id="payment_status" class="form-control" required>
                                <option value="Unpaid" {{ old('payment_status')=='Unpaid'?'selected':'' }}>Unpaid</option>
                                <option value="Paid" {{ old('payment_status')=='Paid'?'selected':'' }}>Paid</option>
                                <option value="Cancelled" {{ old('payment_status')=='Cancelled'?'selected':'' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shipping_status">Status Pengiriman <span class="required">*</span></label>
                            <select name="shipping_status" id="shipping_status" class="form-control" required>
                                <option value="Pending" {{ old('shipping_status')=='Pending'?'selected':'' }}>Pending</option>
                                <option value="Shipped" {{ old('shipping_status')=='Shipped'?'selected':'' }}>Shipped</option>
                                <option value="Arrived" {{ old('shipping_status')=='Arrived'?'selected':'' }}>Arrived</option>
                                <option value="Cancelled" {{ old('shipping_status')=='Cancelled'?'selected':'' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="skm-form-container">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
                </div>
            </div>
        </form>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        const userSelect=document.getElementById('user_id');
        const addressSelect=document.getElementById('shipping_address_id');
        const addressWrapper=document.getElementById('address-wrapper');
        
        // Event listener untuk auto-fill harga saat pilih produk
        document.addEventListener('change',function(e){
            if(e.target.classList.contains('product-select')){
                const selectedOption=e.target.options[e.target.selectedIndex];
                const price=selectedOption.getAttribute('data-price');
                const itemCard=e.target.closest('.item-card');
                const priceInput=itemCard.querySelector('.price-input');
                if(price&&priceInput){
                    priceInput.value=price;
                }
            }
        });
        
        // Event listener untuk perubahan user
        userSelect.addEventListener('change',function(){
            const userId=this.value;
            addressSelect.innerHTML='<option value="" disabled selected>Memuat alamat...</option>';
            addressSelect.disabled=true;
            if(userId){
                fetch(`/admin/users/${userId}/addresses`,{
                    method:'GET',
                    headers:{
                        'Content-Type':'application/json',
                        'X-Requested-With':'XMLHttpRequest',
                        'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response=>{
                    if(!response.ok)throw new Error('Gagal mengambil data alamat');
                    return response.json();
                }).then(addresses=>{
                    addressSelect.innerHTML='';
                    if(addresses&&addresses.length>0){
                        addressSelect.disabled=false;
                        addressWrapper.style.display='block';
                        const defaultOption=document.createElement('option');
                        defaultOption.value='';
                        defaultOption.textContent='Pilih Alamat Pengiriman';
                        defaultOption.disabled=true;
                        defaultOption.selected=true;
                        addressSelect.appendChild(defaultOption);
                        addresses.forEach(address=>{
                            const option=document.createElement('option');
                            option.value=address.id;
                            let addressText=address.full_address||buildAddressText(address);
                            if(address.is_primary)addressText+=' (Utama)';
                            option.textContent=addressText;
                            if(address.is_primary)option.selected=true;
                            addressSelect.appendChild(option);
                        });
                    }else{
                        addressSelect.innerHTML='<option value="">User ini belum memiliki alamat</option>';
                        addressSelect.disabled=true;
                        addressWrapper.style.display='block';
                    }
                }).catch(error=>{
                    console.error('Error:',error);
                    addressSelect.innerHTML='<option value="">Gagal memuat alamat</option>';
                    addressSelect.disabled=true;
                    addressWrapper.style.display='block';
                });
            }else{
                addressSelect.innerHTML='<option value="">Pilih Customer Terlebih Dahulu</option>';
                addressSelect.disabled=true;
                addressWrapper.style.display='none';
            }
        });
        
        function buildAddressText(address){
            const parts=[];
            if(address.address_line)parts.push(address.address_line);
            if(address.city)parts.push(address.city);
            if(address.province)parts.push(address.province);
            if(address.postal_code)parts.push(address.postal_code);
            if(address.country)parts.push(address.country);
            return parts.join(', ');
        }
        
        let itemCount={{old('items')?count(old('items')):1}};
        if(itemCount===0)itemCount=1;
        
        window.addItem=function(){
            const container=document.getElementById('order-items-container');
            const newItem=document.createElement('div');
            newItem.className='item-card';
            newItem.innerHTML=`
                <div class="item-header">
                    <span class="item-number">Item #${itemCount+1}</span>
                    <button type="button" class="remove-item-btn" onclick="removeItem(this)"><i class="fas fa-times"></i> Hapus</button>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Pilih Produk <span class="required">*</span></label>
                        <select name="items[${itemCount}][product_name]" class="form-control product-select" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->name }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} @if($product->price) - Rp {{ number_format($product->price, 0, ',', '.') }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row two-cols">
                    <div class="form-group">
                        <label>Kuantitas <span class="required">*</span></label>
                        <input type="number" name="items[${itemCount}][quantity]" class="form-control" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Satuan (Rp) <span class="required">*</span></label>
                        <input type="number" name="items[${itemCount}][unit_price]" class="form-control price-input" value="0.00" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label>File Desain Kustom</label>
                        <input type="file" name="items[${itemCount}][custom_design_file]" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr">
                        <span class="help-text">Format: JPG, PNG, PDF, AI, PSD, CDR (Maks. 10MB)</span>
                    </div>
                </div>
            `;
            container.appendChild(newItem);
            itemCount++;
            updateRemoveButtons();
        };
        
        window.removeItem=function(button){
            const itemCard=button.closest('.item-card');
            itemCard.remove();
            const items=document.querySelectorAll('.item-card');
            itemCount=items.length;
            items.forEach((item,index)=>{
                const itemNumber=item.querySelector('.item-number');
                itemNumber.textContent=`Item #${index+1}`;
                item.querySelectorAll('input,select,textarea').forEach(input=>{
                    if(input.name)input.name=input.name.replace(/items\[\d+\]/,`items[${index}]`);
                    if(input.id)input.id=input.id.replace(/items\[\d+\]/,`items[${index}]`);
                });
                item.querySelectorAll('label').forEach(label=>{
                    if(label.htmlFor)label.htmlFor=label.htmlFor.replace(/items\[\d+\]/,`items[${index}]`);
                });
            });
            updateRemoveButtons();
        };
        
        function updateRemoveButtons(){
            const items=document.querySelectorAll('.item-card');
            items.forEach(item=>{
                const removeBtn=item.querySelector('.remove-item-btn');
                if(items.length>1)removeBtn.style.display='inline-flex';
                else removeBtn.style.display='none';
            });
        }
        
        updateRemoveButtons();
        @if(old('user_id'))userSelect.dispatchEvent(new Event('change'));@endif
    });
    </script>
</body>
</html>