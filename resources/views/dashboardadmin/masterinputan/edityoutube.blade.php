<!DOCTYPE html>
<html>

<head>
    <style>
        /* ===== MODERN EDIT YOUTUBE STYLES ===== */
        :root {
            --black: #000000;
            --gray-900: #1A1A1A;
            --gray-800: #2D2D2D;
            --gray-700: #404040;
            --gray-600: #666666;
            --gray-500: #808080;
            --gray-400: #999999;
            --gray-300: #CCCCCC;
            --gray-200: #E5E5E5;
            --gray-100: #F5F5F5;
            --gray-50: #FAFAFA;
            --white: #FFFFFF;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* ===== EDIT FORM CONTAINER ===== */
        .edit-form-container {
            padding: 0;
        }

        /* ===== THUMBNAIL PREVIEW SECTION ===== */
        .thumbnail-preview-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
            padding: 24px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border: 2px dashed var(--gray-300);
        }

        .preview-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .preview-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .preview-label i {
            font-size: 1rem;
            color: #FF0000;
        }

        .preview-thumbnail-wrapper {
            width: 100%;
            height: 180px;
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--gray-200);
            position: relative;
        }

        .preview-thumbnail-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .preview-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 4px 12px;
            background: var(--black);
            color: var(--white);
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .youtube-play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 0, 0, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .youtube-play-icon i {
            color: white;
            font-size: 20px;
            margin-left: 3px;
        }

        /* ===== FORM GROUPS ===== */
        .form-group-modern {
            margin-bottom: 24px;
        }

        .form-label-modern {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label-modern i {
            font-size: 1rem;
        }

        .form-label-modern.required::after {
            content: '*';
            color: #ef4444;
            margin-left: 4px;
        }

        .form-control-modern {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--gray-900);
            font-family: 'Inter', sans-serif;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--black);
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        /* ===== FILE INPUT ===== */
        .file-input-wrapper {
            position: relative;
        }

        .file-input-custom {
            display: none;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            background: var(--gray-100);
            border: 2px dashed var(--gray-300);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .file-input-label:hover {
            background: var(--gray-200);
            border-color: var(--black);
            color: var(--black);
        }

        .file-input-label i {
            font-size: 1.2rem;
        }

        .file-name-display {
            margin-top: 8px;
            padding: 8px 12px;
            background: var(--gray-50);
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            color: var(--gray-600);
            display: none;
        }

        .file-name-display.show {
            display: block;
        }

        .form-helper-text {
            font-size: 0.8rem;
            color: var(--gray-500);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-helper-text i {
            font-size: 0.9rem;
        }

        /* ===== YOUTUBE LINK INPUT ===== */
        .youtube-link-wrapper {
            position: relative;
        }

        .youtube-link-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #FF0000;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .form-control-modern.with-icon {
            padding-left: 48px;
        }

        /* ===== BUTTONS ===== */
        .btn-submit-modern {
            width: 100%;
            padding: 14px 32px;
            background: var(--black);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 32px;
        }

        .btn-submit-modern:hover {
            background: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-submit-modern:active {
            transform: translateY(0);
        }

        .btn-submit-modern i {
            font-size: 1.1rem;
        }

        /* ===== DIVIDER ===== */
        .form-divider {
            height: 1px;
            background: var(--gray-200);
            margin: 32px 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .thumbnail-preview-section {
                grid-template-columns: 1fr;
                padding: 16px;
                gap: 16px;
            }

            .preview-thumbnail-wrapper {
                height: 150px;
            }

            .form-group-modern {
                margin-bottom: 20px;
            }

            .btn-submit-modern {
                padding: 12px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="edit-form-container">
        <form action="/masteryoutube/{{ $datayoutube->id }}/updateyoutube" method="POST" enctype="multipart/form-data" id="editYoutubeForm">
            @csrf
            
            <!-- Thumbnail Preview Section -->
            <div class="thumbnail-preview-section">
                <div class="preview-card">
                    <span class="preview-label">
                        <i class="fab fa-youtube"></i>
                        Thumbnail Saat Ini
                    </span>
                    <div class="preview-thumbnail-wrapper">
                        <span class="preview-badge">Current</span>
                        @if ($datayoutube->gambar)
                            @php
                                $path = Storage::url('uploads/youtube/' . $datayoutube->gambar);
                            @endphp
                            <img src="{{ $path }}" alt="Current Thumbnail">
                        @else
                            <img src="{{ asset('assets/img/preview.png') }}" alt="No Thumbnail">
                        @endif
                        <div class="youtube-play-icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                    </div>
                </div>
                
                <div class="preview-card">
                    <span class="preview-label">
                        <i class="fas fa-eye"></i>
                        Preview Thumbnail Baru
                    </span>
                    <div class="preview-thumbnail-wrapper">
                        <span class="preview-badge">Preview</span>
                        <img id="preview-image" src="{{ asset('assets/img/preview.png') }}" alt="Preview">
                        <div class="youtube-play-icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Old Photo Input -->
            <input type="hidden" id="fotoeditlama" name="fotoeditlama" value="{{ $datayoutube->gambar }}">

            <!-- File Upload -->
            <div class="form-group-modern">
                <label class="form-label-modern" for="fotoedit">
                    <i class="fas fa-image"></i>
                    Ubah Thumbnail Video
                </label>
                <div class="file-input-wrapper">
                    <input type="file" 
                           class="file-input-custom" 
                           id="fotoedit" 
                           name="fotoedit" 
                           accept="image/*"
                           onchange="previewImage()">
                    <label for="fotoedit" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Pilih Thumbnail Baru</span>
                    </label>
                    <div class="file-name-display" id="fileName"></div>
                </div>
                <div class="form-helper-text">
                    <i class="fas fa-info-circle"></i>
                    Format: JPG, PNG, GIF. Maksimal 2MB. Rekomendasi: 1280x720px
                </div>
            </div>

            <div class="form-divider"></div>

            <!-- YouTube Link -->
            <div class="form-group-modern">
                <label class="form-label-modern required" for="linkedit">
                    <i class="fab fa-youtube"></i>
                    Link Video YouTube
                </label>
                <div class="youtube-link-wrapper">
                    <i class="fab fa-youtube youtube-link-icon"></i>
                    <input class="form-control-modern with-icon" 
                           id="linkedit" 
                           name="linkedit" 
                           type="url" 
                           value="{{ $datayoutube->link }}"
                           placeholder="https://www.youtube.com/watch?v=..."
                           required>
                </div>
                <div class="form-helper-text">
                    <i class="fas fa-info-circle"></i>
                    Masukkan link lengkap dari YouTube
                </div>
            </div>

            <!-- Submit Button -->
            <button class="btn-submit-modern" type="submit">
                <i class="fas fa-save"></i>
                Update Video YouTube
            </button>
        </form>
    </div>

    <script>
        function previewImage() {
            const input = document.getElementById('fotoedit');
            const previewImage = document.getElementById('preview-image');
            const fileNameDisplay = document.getElementById('fileName');

            const file = input.files[0];

            if (file) {
                // Check file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    input.value = '';
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak valid! Gunakan JPG, PNG, atau GIF');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(file);

                // Show file name
                fileNameDisplay.textContent = '📁 ' + file.name;
                fileNameDisplay.classList.add('show');
            } else {
                previewImage.src = '{{ asset('assets/img/preview.png') }}';
                fileNameDisplay.classList.remove('show');
            }
        }

        // Form validation
        document.getElementById('editYoutubeForm').addEventListener('submit', function(e) {
            const link = document.getElementById('linkedit').value.trim();

            if (!link) {
                e.preventDefault();
                alert('Mohon masukkan link YouTube!');
                return false;
            }

            // Validate YouTube URL
            const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
            if (!youtubeRegex.test(link)) {
                e.preventDefault();
                alert('Link YouTube tidak valid! Pastikan link berasal dari YouTube.');
                return false;
            }

            // Show loading state on button
            const btn = this.querySelector('.btn-submit-modern');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            btn.disabled = true;
        });

        // Link input validation on blur
        document.getElementById('linkedit').addEventListener('blur', function() {
            const link = this.value.trim();
            if (link) {
                const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
                if (!youtubeRegex.test(link)) {
                    this.style.borderColor = '#ef4444';
                    this.setCustomValidity('Link YouTube tidak valid');
                } else {
                    this.style.borderColor = '';
                    this.setCustomValidity('');
                }
            }
        });

        // Reset border color on input
        document.getElementById('linkedit').addEventListener('input', function() {
            this.style.borderColor = '';
        });
    </script>
</body>

</html>