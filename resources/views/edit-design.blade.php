<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Desain - SIKEMAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Besley:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Three.js for 3D View -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Besley', serif;
            background-color: #f5f5ff;
            overflow-x: hidden;
        }

        /* Main Editor Container */
        .editor-container {
            display: flex;
            height: 100vh;
            background-color: #f5f5ff;
        }

        /* Left Sidebar - Elements & Upload */
        .left-sidebar {
            width: 280px;
            background-color: #ffffff;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-section {
            margin-bottom: 2rem;
        }

        .upload-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #00b4a8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .upload-button:hover {
            background-color: #009a8f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 180, 168, 0.3);
        }

        .upload-input {
            display: none;
        }

        /* Elements Grid */
        .elements-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .element-item {
            aspect-ratio: 1;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .element-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .element-item:hover {
            border-color: #00b4a8;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 180, 168, 0.2);
        }

        .element-item.selected {
            border-color: #00b4a8;
            border-width: 3px;
        }

        /* Tab Switcher */
        .tab-switcher {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            background-color: #f0f0f0;
            padding: 0.25rem;
            border-radius: 8px;
        }

        .tab-button {
            flex: 1;
            padding: 0.5rem;
            background: transparent;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
        }

        .tab-button.active {
            background-color: white;
            color: #074159;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* View Switcher Container */
        .view-switcher-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background-color: transparent;
            padding: 0;
            border-radius: 0;
        }

        .view-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }

        .view-3d-button {
            background-color: #074159;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
        }

        .view-3d-button:hover {
            background-color: #053244;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(7, 65, 89, 0.3);
        }

        .view-3d-button img {
            filter: brightness(0) invert(1);
        }

        .view-3d-button span {
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Canvas Area */
        .canvas-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            position: relative;
            background-color: #F4F7F6;
        }

        .design-title-bar {
            width: 100%;
            max-width: calc(100% - 4rem);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            background-color: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .canvas-wrapper {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            max-width: calc(100% - 4rem);
            width: 100%;
            position: relative;
        }

        .canvas {
            width: 100%;
            height: 700px;
            border: 2px dashed #d0d0d0;
            border-radius: 8px;
            position: relative;
            background-color: #fafafa;
            overflow: hidden;
        }

        /* Dimension Labels */
        .dimension-label {
            position: absolute;
            background: #074159;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .dimension-horizontal {
            left: 50%;
            transform: translateX(-50%);
        }

        .dimension-vertical {
            top: 50%;
            transform: translateY(-50%) rotate(-90deg);
        }

        /* Canvas Controls */
        .canvas-controls {
            position: relative;
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            background: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: calc(100% - 4rem);
            justify-content: center;
        }

        .control-button {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            background: #f0f0f0;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .control-button:hover {
            background: #00b4a8;
            color: white;
            transform: scale(1.1);
        }

        .control-button:hover svg {
            stroke: white;
        }

        .control-button svg {
            stroke: #333;
        }

        #luar-btn {
            background: white;
            color: #074159;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        #luar-btn:hover {
            background: #074159;
            color: white;
            border-color: #074159;
        }

        #luar-btn:hover svg {
            stroke: white;
        }

        #luar-btn svg {
            stroke: #074159;
        }

        .zoom-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            padding: 0 1rem;
        }

        /* Right Sidebar - Properties */
        .right-sidebar {
            width: 320px;
            background-color: #ffffff;
            border-left: 1px solid #e0e0e0;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .property-section {
            margin-bottom: 2rem;
        }

        .property-title {
            font-size: 1rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
        }

        .dimension-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .dimension-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .dimension-label-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: #666;
        }

        .dimension-value {
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #f8f8f8;
            font-weight: 600;
            color: #074159;
            text-align: center;
        }

        .dimension-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: #ffffff;
            font-family: 'Besley', serif;
            font-weight: 600;
            color: #074159;
            text-align: center;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .dimension-input:focus {
            outline: none;
            border-color: #074159;
            box-shadow: 0 0 0 3px rgba(7, 65, 89, 0.1);
            background: #ffffff;
        }

        .dimension-input:hover {
            border-color: #00b4a8;
        }

        /* Material Selection */
        .material-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .material-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.75rem;
            border: 2px solid transparent;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .material-item:hover {
            border-color: #00b4a8;
            background: #f8f8f8;
        }

        .material-item.selected {
            border-color: #00b4a8;
            background: #e8f9f8;
        }

        .material-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .material-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #074159;
            text-align: center;
        }

        /* Color Selection */
        .color-grid {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .color-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .color-item:hover {
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .color-item.selected {
            border-color: #074159;
            transform: scale(1.15);
        }

        /* Action Buttons */
        .action-buttons {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
            z-index: 100;
            align-items: center;
        }

        .action-button {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .button-exit {
            background: transparent;
            color: #666;
            border: none;
            box-shadow: none;
        }

        .button-exit:hover {
            background: #f0f0f0;
            color: #074159;
        }

        .button-save {
            background: #FF611A; /* Diubah */
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .button-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 97, 26, 0.4); /* Disesuaikan */
            background: #ff7d40; /* Disesuaikan */
        }

        /* Draggable Elements on Canvas */
        .draggable-element {
            position: absolute;
            cursor: move;
            user-select: none;
            border: 2px dashed transparent;
            transition: border-color 0.2s ease;
        }

        .draggable-element:hover,
        .draggable-element.selected {
            border-color: #00b4a8;
        }

        .draggable-element img {
            width: 100%;
            height: 100%;
            pointer-events: none;
            object-fit: cover;
        }

        /* Resize Handles */
        .resize-handle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #00b4a8;
            border: 2px solid white;
            border-radius: 50%;
            display: none;
            z-index: 10;
        }

        .draggable-element.selected .resize-handle {
            display: block;
        }

        .resize-handle.nw { top: -6px; left: -6px; cursor: nw-resize; }
        .resize-handle.ne { top: -6px; right: -6px; cursor: ne-resize; }
        .resize-handle.sw { bottom: -6px; left: -6px; cursor: sw-resize; }
        .resize-handle.se { bottom: -6px; right: -6px; cursor: se-resize; }

        /* 3D Canvas */
        #canvas-3d {
            width: 100%;
            height: 600px;
            border-radius: 8px;
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .left-sidebar,
            .right-sidebar {
                width: 250px;
            }
        }

        @media (max-width: 992px) {
            .editor-container {
                flex-direction: column;
            }

            .left-sidebar,
            .right-sidebar {
                width: 100%;
                height: auto;
                max-height: 300px;
            }

            .action-buttons {
                position: fixed;
                bottom: 1rem;
                right: 1rem;
                flex-direction: row;
            }
        }

        /* Success Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 2rem;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: slideDown 0.3s ease;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #00b4a8 0%, #00d4c4 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            color: white;
        }

        .modal-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #074159;
            margin-bottom: 1rem;
        }

        .modal-text {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .modal-button {
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { 
                transform: translateY(-50px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Loading Indicator */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #00b4a8;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="editor-container">
        <aside class="left-sidebar">
            <h3 class="sidebar-title" style="background-color: #ffffff; color: #074159; padding: 0.75rem 1.5rem; margin: -1.5rem -1.5rem 1.5rem -1.5rem;">Unggah & Desain</h3>
            
            <div id="upload-tab">
                <div class="upload-section">
                    <input type="file" id="image-upload" class="upload-input" accept="image/*" multiple>
                    <button class="upload-button" onclick="document.getElementById('image-upload').click()">
                        + Tambah Gambar
                    </button>
                    <p style="font-size: 0.85rem; color: #666; text-align: center; margin-top: 0.5rem;">Mendukung JPG, PNG, SVG</p>
                </div>

                <div id="uploaded-images-grid" class="elements-grid">
                    </div>
            </div>

            <div id="elements-tab">
                <h3 class="sidebar-title">
                    Elemen
                </h3>
                <div class="elements-grid" id="elements-grid">
                    <div class="element-item" data-element="product1">
                        <img src="{{ asset('assets/img/product1.png') }}" alt="Product 1">
                    </div>
                    <div class="element-item" data-element="product2">
                        <img src="{{ asset('assets/img/product2.png') }}" alt="Product 2">
                    </div>
                    <div class="element-item" data-element="product3">
                        <img src="{{ asset('assets/img/product3.png') }}" alt="Product 3">
                    </div>
                    <div class="element-item" data-element="product4">
                        <img src="{{ asset('assets/img/product4.png') }}" alt="Product 4">
                    </div>
                    <div class="element-item" data-element="product5">
                        <img src="{{ asset('assets/img/product5.png') }}" alt="Product 5">
                    </div>
                    <div class="element-item" data-element="product6">
                        <img src="{{ asset('assets/img/product6.png') }}" alt="Product 6">
                    </div>
                </div>
            </div>
        </aside>

        <main class="canvas-area">
            <div class="design-title-bar">
                <span style="font-size: 1.5rem; font-weight: 700; color: #074159; display: flex; align-items: center; gap: 0.5rem;">
                    Desain Kotak Kemasan Khusus
                    <span style="font-weight: 400; color: #999; cursor: pointer; font-size: 1.5rem;">×</span>
                </span>
                <div class="view-switcher-container">
                    <span class="view-label">2D Pack + 3D Live View</span>
                    <button class="view-3d-button" data-view="3d">
                        <img src="{{ asset('assets/img/3D.svg') }}" alt="3D" width="18" height="18">
                        <span>3D</span>
                    </button>
                </div>
            </div>

            <div class="canvas-wrapper">
                <div class="canvas" id="design-canvas">
                    <div class="dimension-label dimension-horizontal" style="top: 10px;">120.6 mm</div>
                    <div class="dimension-label dimension-horizontal" style="bottom: 10px;">161.1 mm</div>
                    <div class="dimension-label dimension-vertical" style="left: 10px;">60.6 mm</div>
                </div>
                
                <!-- 3D Canvas -->
                <div id="canvas-3d"></div>
            </div>

            <div class="canvas-controls">
                    <button class="control-button" id="undo-btn" title="Undo">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7v6h6"/>
                            <path d="M21 17a9 9 0 00-9-9 9 9 0 00-6 2.3L3 13"/>
                        </svg>
                    </button>
                    <button class="control-button" id="redo-btn" title="Redo">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 7v6h-6"/>
                            <path d="M3 17a9 9 0 019-9 9 9 0 016 2.3l3 2.7"/>
                        </svg>
                    </button>
                    <div class="zoom-display">
                        <button class="control-button" id="zoom-out" title="Zoom Out">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="M21 21l-4.35-4.35"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                        </button>
                        <span id="zoom-level">100%</span>
                        <button class="control-button" id="zoom-in" title="Zoom In">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="M21 21l-4.35-4.35"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                        </button>
                    </div>
                    <button class="control-button" id="reset-view" title="Reset View">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0118.8-4.3M22 12.5a10 10 0 01-18.8 4.2"/>
                        </svg>
                    </button>
                    <button class="control-button" id="luar-btn" title="Luar" style="padding: 0 1rem; width: auto; border-radius: 20px; font-weight: 600; font-size: 0.95rem;">
                        Luar
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 0.25rem;">
                            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </button>
                </div>
        </main>

        <aside class="right-sidebar">
            <h3 class="sidebar-title" style="background-color: #f0f0f0; color: #074159; padding: 0.75rem 1.5rem; margin: -1.5rem -1.5rem 1.5rem -1.5rem;">Properti</h3>

            <div class="property-section">
                <h3 class="property-title">Ukuran</h3>
                <div class="dimension-group">
                    <div class="dimension-item">
                        <span class="dimension-label-text">Panjang</span>
                        <input type="text" class="dimension-input" value="120.6 mm" id="dimension-length">
                    </div>
                    <div class="dimension-item">
                        <span class="dimension-label-text">Lebar</span>
                        <input type="text" class="dimension-input" value="60.6 mm" id="dimension-width">
                    </div>
                </div>
                <div class="dimension-item">
                    <span class="dimension-label-text">Tinggi</span>
                    <input type="text" class="dimension-input" value="161.1 mm" id="dimension-height">
                </div>
            </div>

            <div class="property-section">
                <h3 class="property-title">Material</h3>
                <div class="material-grid">
                    <div class="material-item selected" data-material="karton">
                        <div class="material-circle" style="background-image: url('{{ asset('assets/img/product1.png') }}');"></div>
                        <span class="material-name">Karton</span>
                    </div>
                    <div class="material-item" data-material="daur-ulang">
                        <div class="material-circle" style="background-image: url('{{ asset('assets/img/product2.png') }}');"></div>
                        <span class="material-name">Daur Ulang</span>
                    </div>
                    <div class="material-item" data-material="kraft">
                        <div class="material-circle" style="background-image: url('{{ asset('assets/img/product3.png') }}');"></div>
                        <span class="material-name">Kraft</span>
                    </div>
                </div>
            </div>

            <div class="property-section">
                <h3 class="property-title">Warna Kemasan</h3>
                <div class="color-grid">
                    <div class="color-item selected" style="background-color: #FFD700;" data-color="gold"></div>
                    <div class="color-item" style="background-color: #E8E8E8;" data-color="silver"></div>
                    <div class="color-item" style="background-color: #F5F5F5;" data-color="white"></div>
                    <div class="color-item" style="background-color: #87CEEB;" data-color="lightblue"></div>
                    <div class="color-item" style="background-color: #FFB6C1;" data-color="pink"></div>
                    <div class="color-item" style="background-color: #90EE90;" data-color="lightgreen"></div>
                </div>
            </div>
        </aside>
    </div>

    <div class="action-buttons">
        <button class="action-button button-exit" id="exit-button">Luar</button>
        <button class="action-button button-save" id="save-button">
            Simpan
        </button>
    </div>

    <div id="success-modal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">✓</div>
            <h2 class="modal-title">Desain Tersimpan!</h2>
            <p class="modal-text">Desain Anda telah berhasil disimpan dan didownload sebagai gambar PNG ke perangkat lokal.</p>
            <button class="modal-button" onclick="closeModal()">OK, Mengerti</button>
        </div>
    </div>

    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Design Editor State
        let designState = {
            title: 'Desain Kotak Kemasan Khusus',
            dimensions: {
                length: 120.6,
                width: 60.6,
                height: 161.1
            },
            material: 'karton',
            color: 'gold',
            elements: [],
            uploadedImages: [],
            zoom: 100,
            history: [],
            historyIndex: -1
        };

        let isDragging = false;
        let isResizing = false;
        let currentElement = null;
        let currentHandle = null;
        let offsetX = 0;
        let offsetY = 0;
        let elementIdCounter = 0;
        let currentView = '2d';

        // 3D Scene Variables
        let scene, camera, renderer, box3D;

        // View Switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Image Upload Handler
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            const grid = document.getElementById('uploaded-images-grid');
            
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const imageData = event.target.result;
                        designState.uploadedImages.push(imageData);
                        
                        const div = document.createElement('div');
                        div.className = 'element-item';
                        div.innerHTML = `<img src="${imageData}" alt="Uploaded Image">`;
                        div.addEventListener('click', function() {
                            addElementToCanvas(imageData, 'image');
                        });
                        grid.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Add Element to Canvas
        function addElementToCanvas(src, type) {
            const canvas = document.getElementById('design-canvas');
            const element = document.createElement('div');
            element.className = 'draggable-element';
            element.id = 'element-' + (++elementIdCounter);
            
            const img = document.createElement('img');
            img.src = src;
            element.appendChild(img);
            
            // Add resize handles
            ['nw', 'ne', 'sw', 'se'].forEach(pos => {
                const handle = document.createElement('div');
                handle.className = `resize-handle ${pos}`;
                handle.dataset.handle = pos;
                element.appendChild(handle);
            });
            
            element.style.left = Math.random() * (canvas.offsetWidth - 150) + 'px';
            element.style.top = Math.random() * (canvas.offsetHeight - 150) + 'px';
            element.style.width = '150px';
            element.style.height = '150px';
            
            canvas.appendChild(element);
            
            designState.elements.push({
                id: element.id,
                src: src,
                type: type,
                x: parseInt(element.style.left),
                y: parseInt(element.style.top),
                width: 150,
                height: 150
            });
            
            makeDraggable(element);
            makeResizable(element);
            saveHistory();
        }

        // Make Element Draggable
        function makeDraggable(element) {
            element.addEventListener('mousedown', function(e) {
                if (e.target.classList.contains('resize-handle')) return;
                
                isDragging = true;
                currentElement = element;
                offsetX = e.clientX - element.offsetLeft;
                offsetY = e.clientY - element.offsetTop;
                element.classList.add('selected');
                
                document.querySelectorAll('.draggable-element').forEach(el => {
                    if (el !== element) el.classList.remove('selected');
                });
            });
        }

        // Make Element Resizable
        function makeResizable(element) {
            element.querySelectorAll('.resize-handle').forEach(handle => {
                handle.addEventListener('mousedown', function(e) {
                    e.stopPropagation();
                    isResizing = true;
                    currentElement = element;
                    currentHandle = this.dataset.handle;
                    
                    document.querySelectorAll('.draggable-element').forEach(el => {
                        el.classList.remove('selected');
                    });
                    element.classList.add('selected');
                });
            });
        }

        document.addEventListener('mousemove', function(e) {
            if (isDragging && currentElement && !isResizing) {
                const canvas = document.getElementById('design-canvas');
                const canvasRect = canvas.getBoundingClientRect();
                
                let newX = e.clientX - canvasRect.left - offsetX;
                let newY = e.clientY - canvasRect.top - offsetY;
                
                newX = Math.max(0, Math.min(newX, canvas.offsetWidth - currentElement.offsetWidth));
                newY = Math.max(0, Math.min(newY, canvas.offsetHeight - currentElement.offsetHeight));
                
                currentElement.style.left = newX + 'px';
                currentElement.style.top = newY + 'px';
            } else if (isResizing && currentElement) {
                const rect = currentElement.getBoundingClientRect();
                const canvas = document.getElementById('design-canvas');
                const canvasRect = canvas.getBoundingClientRect();
                
                let newWidth = currentElement.offsetWidth;
                let newHeight = currentElement.offsetHeight;
                let newX = parseInt(currentElement.style.left);
                let newY = parseInt(currentElement.style.top);
                
                if (currentHandle.includes('e')) {
                    newWidth = e.clientX - rect.left;
                }
                if (currentHandle.includes('w')) {
                    const deltaX = e.clientX - rect.left;
                    newWidth = currentElement.offsetWidth - deltaX;
                    newX = parseInt(currentElement.style.left) + deltaX;
                }
                if (currentHandle.includes('s')) {
                    newHeight = e.clientY - rect.top;
                }
                if (currentHandle.includes('n')) {
                    const deltaY = e.clientY - rect.top;
                    newHeight = currentElement.offsetHeight - deltaY;
                    newY = parseInt(currentElement.style.top) + deltaY;
                }
                
                // Minimum size 50x50
                if (newWidth >= 50 && newHeight >= 50) {
                    currentElement.style.width = newWidth + 'px';
                    currentElement.style.height = newHeight + 'px';
                    currentElement.style.left = newX + 'px';
                    currentElement.style.top = newY + 'px';
                }
            }
        });

        document.addEventListener('mouseup', function() {
            if (isDragging || isResizing) {
                if (currentElement) {
                    const elementData = designState.elements.find(el => el.id === currentElement.id);
                    if (elementData) {
                        elementData.x = parseInt(currentElement.style.left);
                        elementData.y = parseInt(currentElement.style.top);
                        elementData.width = currentElement.offsetWidth;
                        elementData.height = currentElement.offsetHeight;
                    }
                    saveHistory();
                }
                
                isDragging = false;
                isResizing = false;
                currentElement = null;
                currentHandle = null;
            }
        });

        // Element Selection
        document.querySelectorAll('.element-item').forEach(item => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                if (img) {
                    addElementToCanvas(img.src, 'element');
                }
            });
        });

        // Material Selection
        document.querySelectorAll('.material-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.material-item').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
                designState.material = this.dataset.material;
                saveHistory();
            });
        });

        // Color Selection
        document.querySelectorAll('.color-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.color-item').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
                designState.color = this.dataset.color;
                document.getElementById('design-canvas').style.backgroundColor = this.style.backgroundColor;
                saveHistory();
            });
        });

        // Zoom Controls
        let zoomLevel = 100;
        document.getElementById('zoom-in').addEventListener('click', function() {
            if (zoomLevel < 200) {
                zoomLevel += 10;
                updateZoom();
            }
        });

        document.getElementById('zoom-out').addEventListener('click', function() {
            if (zoomLevel > 50) {
                zoomLevel -= 10;
                updateZoom();
            }
        });

        document.getElementById('reset-view').addEventListener('click', function() {
            zoomLevel = 100;
            updateZoom();
        });

        function updateZoom() {
            const canvas = document.getElementById('design-canvas');
            canvas.style.transform = `scale(${zoomLevel / 100})`;
            document.getElementById('zoom-level').textContent = zoomLevel + '%';
            designState.zoom = zoomLevel;
        }

        // History Management
        function saveHistory() {
            const currentState = {
                elements: JSON.parse(JSON.stringify(designState.elements)),
                material: designState.material,
                color: designState.color,
                zoom: designState.zoom
            };
            
            designState.history = designState.history.slice(0, designState.historyIndex + 1);
            designState.history.push(currentState);
            designState.historyIndex++;
        }

        document.getElementById('undo-btn').addEventListener('click', function() {
            if (designState.historyIndex > 0) {
                designState.historyIndex--;
                restoreState(designState.history[designState.historyIndex]);
            }
        });

        document.getElementById('redo-btn').addEventListener('click', function() {
            if (designState.historyIndex < designState.history.length - 1) {
                designState.historyIndex++;
                restoreState(designState.history[designState.historyIndex]);
            }
        });

        function restoreState(state) {
            // Clear canvas
            const canvas = document.getElementById('design-canvas');
            const elements = canvas.querySelectorAll('.draggable-element');
            elements.forEach(el => el.remove());
            
            // Restore elements
            designState.elements = JSON.parse(JSON.stringify(state.elements));
            
            // Re-create elements on canvas
            designState.elements.forEach(elementData => {
                const element = document.createElement('div');
                element.className = 'draggable-element';
                element.id = elementData.id;
                element.style.left = elementData.x + 'px';
                element.style.top = elementData.y + 'px';
                element.style.width = elementData.width + 'px';
                element.style.height = elementData.height + 'px';
                
                const img = document.createElement('img');
                img.src = elementData.src;
                element.appendChild(img);
                
                // Add resize handles
                ['nw', 'ne', 'sw', 'se'].forEach(pos => {
                    const handle = document.createElement('div');
                    handle.className = `resize-handle ${pos}`;
                    handle.dataset.handle = pos;
                    element.appendChild(handle);
                });
                
                canvas.appendChild(element);
                makeDraggable(element);
                makeResizable(element);
            });
            
            // Restore other properties
            designState.material = state.material;
            designState.color = state.color;
            designState.zoom = state.zoom;
            
            // Update UI
            document.querySelectorAll('.material-item').forEach(item => {
                item.classList.toggle('selected', item.dataset.material === state.material);
            });
            
            document.querySelectorAll('.color-item').forEach(item => {
                item.classList.toggle('selected', item.dataset.color === state.color);
            });
            
            zoomLevel = state.zoom;
            updateZoom();
        }

        // Save Design - Export as PNG Image
        document.getElementById('save-button').addEventListener('click', function() {
            const loadingOverlay = document.getElementById('loading-overlay');
            loadingOverlay.style.display = 'flex';
            
            const designData = {
                ...designState,
                timestamp: new Date().toISOString(),
                id: 'design-' + Date.now()
            };
            
            setTimeout(() => {
                try {
                    // Save to localStorage
                    let savedDesigns = JSON.parse(localStorage.getItem('sikemas_designs')) || [];
                    savedDesigns.push(designData);
                    localStorage.setItem('sikemas_designs', JSON.stringify(savedDesigns));
                    localStorage.setItem('sikemas_latest_design', JSON.stringify(designData));
                    
                    // Export canvas as PNG image
                    const canvas = document.getElementById('design-canvas');
                    
                    // Create temporary canvas untuk capture
                    const tempCanvas = document.createElement('canvas');
                    const ctx = tempCanvas.getContext('2d');
                    
                    // Set size sesuai canvas asli
                    tempCanvas.width = canvas.offsetWidth;
                    tempCanvas.height = canvas.offsetHeight;
                    
                    // Fill background
                    ctx.fillStyle = canvas.style.backgroundColor || '#fafafa';
                    ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
                    
                    // Draw semua elemen ke canvas
                    const elements = canvas.querySelectorAll('.draggable-element');
                    let loadedImages = 0;
                    const totalImages = elements.length;
                    
                    if (totalImages === 0) {
                        // Tidak ada elemen, langsung download canvas kosong
                        downloadCanvasAsImage(tempCanvas);
                        loadingOverlay.style.display = 'none';
                        document.getElementById('success-modal').style.display = 'block';
                        return;
                    }
                    
                    elements.forEach(element => {
                        const img = element.querySelector('img');
                        if (img) {
                            const tempImg = new Image();
                            tempImg.crossOrigin = 'anonymous';
                            tempImg.onload = function() {
                                const x = parseInt(element.style.left) || 0;
                                const y = parseInt(element.style.top) || 0;
                                const width = element.offsetWidth;
                                const height = element.offsetHeight;
                                
                                ctx.drawImage(tempImg, x, y, width, height);
                                
                                loadedImages++;
                                if (loadedImages === totalImages) {
                                    downloadCanvasAsImage(tempCanvas);
                                    loadingOverlay.style.display = 'none';
                                    document.getElementById('success-modal').style.display = 'block';
                                }
                            };
                            tempImg.onerror = function() {
                                loadedImages++;
                                if (loadedImages === totalImages) {
                                    downloadCanvasAsImage(tempCanvas);
                                    loadingOverlay.style.display = 'none';
                                    document.getElementById('success-modal').style.display = 'block';
                                }
                            };
                            tempImg.src = img.src;
                        }
                    });
                    
                } catch (error) {
                    console.error('Error saving design:', error);
                    alert('Gagal menyimpan desain. Error: ' + error.message);
                    loadingOverlay.style.display = 'none';
                }
            }, 500);
        });
        
        function downloadCanvasAsImage(canvas) {
            // Convert canvas to blob
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = `Desain-Kemasan-${Date.now()}.png`;
                link.click();
                URL.revokeObjectURL(url);
            }, 'image/png');
        }

        // Exit Button
        document.getElementById('exit-button').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin keluar? Perubahan yang tidak disimpan akan hilang.')) {
                window.location.href = '{{ url('/') }}';
            }
        });

        // Luar Button (di canvas controls)
        document.getElementById('luar-btn').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin keluar? Perubahan yang tidak disimpan akan hilang.')) {
                window.location.href = '{{ url('/') }}';
            }
        });

        // Close Modal
        function closeModal() {
            document.getElementById('success-modal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('success-modal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Prevent default untuk input fields
            const isInputField = document.activeElement.tagName === 'INPUT' || 
                                document.activeElement.tagName === 'TEXTAREA';
            
            if (e.key === 'Delete' || e.key === 'Backspace') {
                if (!isInputField) {
                    const selected = document.querySelector('.draggable-element.selected');
                    if (selected) {
                        e.preventDefault();
                        selected.remove();
                        designState.elements = designState.elements.filter(el => el.id !== selected.id);
                        saveHistory();
                    }
                }
            }
            
            if (e.ctrlKey && e.key === 'z') {
                e.preventDefault();
                document.getElementById('undo-btn').click();
            }
            
            if (e.ctrlKey && (e.key === 'y' || (e.shiftKey && e.key === 'Z'))) {
                e.preventDefault();
                document.getElementById('redo-btn').click();
            }
            
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('save-button').click();
            }
        });

        // Dimension Input Change Handler
        const dimensionInputs = {
            length: document.getElementById('dimension-length'),
            width: document.getElementById('dimension-width'),
            height: document.getElementById('dimension-height')
        };

        const dimensionLabels = {
            horizontal1: document.querySelector('.dimension-label.dimension-horizontal[style*="top"]'),
            horizontal2: document.querySelector('.dimension-label.dimension-horizontal[style*="bottom"]'),
            vertical: document.querySelector('.dimension-label.dimension-vertical')
        };

        // Update dimension labels when input changes
        if (dimensionInputs.length) {
            dimensionInputs.length.addEventListener('input', function() {
                if (dimensionLabels.horizontal1) {
                    dimensionLabels.horizontal1.textContent = this.value;
                }
            });
        }

        if (dimensionInputs.width) {
            dimensionInputs.width.addEventListener('input', function() {
                if (dimensionLabels.vertical) {
                    dimensionLabels.vertical.textContent = this.value;
                }
            });
        }

        if (dimensionInputs.height) {
            dimensionInputs.height.addEventListener('input', function() {
                if (dimensionLabels.horizontal2) {
                    dimensionLabels.horizontal2.textContent = this.value;
                }
            });
        }

        // 3D View Toggle - Updated for new button structure
        const view3DButton = document.querySelector('.view-3d-button[data-view]');
        let is3DView = false;
        
        if (view3DButton) {
            view3DButton.addEventListener('click', function() {
                is3DView = !is3DView;
                currentView = is3DView ? '3d' : '2d';
                
                if (is3DView) {
                    // Switch to 3D view
                    document.getElementById('design-canvas').style.display = 'none';
                    document.getElementById('canvas-3d').style.display = 'block';
                    this.style.backgroundColor = '#00b4a8';
                    if (!renderer) {
                        init3DScene();
                    }
                    render3DCanvas();
                } else {
                    // Switch back to 2D view
                    document.getElementById('design-canvas').style.display = 'block';
                    document.getElementById('canvas-3d').style.display = 'none';
                    this.style.backgroundColor = '#074159';
                }
            });
        }

        // Initialize 3D Scene
        function init3DScene() {
            const container = document.getElementById('canvas-3d');
            
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0xf5f5ff);
            
            camera = new THREE.PerspectiveCamera(75, container.offsetWidth / 600, 0.1, 1000);
            camera.position.set(3, 3, 5);
            camera.lookAt(0, 0, 0);
            
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(container.offsetWidth, 600);
            container.appendChild(renderer.domElement);
            
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(5, 10, 7);
            scene.add(directionalLight);
            
            const geometry = new THREE.BoxGeometry(2, 3, 1);
            const material = new THREE.MeshPhongMaterial({ 
                color: 0xFFD700,
                shininess: 50
            });
            box3D = new THREE.Mesh(geometry, material);
            scene.add(box3D);
            
            const gridHelper = new THREE.GridHelper(10, 10);
            scene.add(gridHelper);
            
            function animate() {
                requestAnimationFrame(animate);
                if (currentView === '3d' && box3D) {
                    box3D.rotation.y += 0.005;
                    renderer.render(scene, camera);
                }
            }
            animate();
        }

        function render3DCanvas() {
            if (renderer && scene && camera) {
                renderer.render(scene, camera);
            }
        }

        function update3DColor() {
            if (box3D) {
                const colorMap = {
                    'gold': 0xFFD700,
                    'silver': 0xE8E8E8,
                    'white': 0xF5F5F5,
                    'lightblue': 0x87CEEB,
                    'pink': 0xFFB6C1,
                    'lightgreen': 0x90EE90
                };
                box3D.material.color.setHex(colorMap[designState.color] || 0xFFD700);
            }
        }

        // Update color selection untuk 3D
        const originalColorHandler = document.querySelectorAll('.color-item');
        document.querySelectorAll('.color-item').forEach(item => {
            item.addEventListener('click', function() {
                update3DColor();
            });
        });

        // Initialize
        saveHistory();
    </script>
</body>
</html>