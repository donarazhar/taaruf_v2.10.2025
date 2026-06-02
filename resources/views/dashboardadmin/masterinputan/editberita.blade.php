<!DOCTYPE html>
<html>

<head>
    <style>
        /* ===== MODERN EDIT FORM STYLES ===== */
        .edit-form-container {
            padding: 0;
        }

        /* ===== IMAGE PREVIEW SECTION ===== */
        .image-preview-section {
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
        }

        .preview-image-wrapper {
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

        .preview-image-wrapper img {
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

        /* ===== FORM GROUPS ===== */
        .form-group-modern {
            margin-bottom: 24px;
        }

        .form-label-modern {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
            display: block;
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

        .form-control-modern:disabled,
        .form-control-modern:read-only {
            background: var(--gray-100);
            color: var(--gray-600);
            cursor: not-allowed;
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

        /* ===== TEXTAREA ===== */
        textarea.form-control-modern {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
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

        /* ===== HELPER TEXT ===== */
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

        /* ===== DIVIDER ===== */
        .form-divider {
            height: 1px;
            background: var(--gray-200);
            margin: 32px 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .image-preview-section {
                grid-template-columns: 1fr;
                padding: 16px;
                gap: 16px;
            }

            .preview-image-wrapper {
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
        <form action="/masterberita/{{ $databerita->id }}/updateberita" method="POST" enctype="multipart/form-data" id="editBeritaForm">
            @csrf
            
            <!-- Image Preview Section -->
            <div class="image-preview-section">
                <div class="preview-card">
                    <span class="preview-label">Foto Saat Ini</span>
                    <div class="preview-image-wrapper">
                        <span class="preview-badge">Current</span>
                        @if ($databerita->foto)
                            @php
                                $path = Storage::url('uploads/berita/' . $databerita->foto);
                            @endphp
                            <img src="{{ $path }}" alt="Foto Saat Ini">
                        @else
                            <img src="{{ asset('assets/img/preview.png') }}" alt="No Image">
                        @endif
                    </div>
                </div>
                
                <div class="preview-card">
                    <span class="preview-label">Preview Foto Baru</span>
                    <div class="preview-image-wrapper">
                        <span class="preview-badge">Preview</span>
                        <img id="preview-image" src="{{ asset('assets/img/preview.png') }}" alt="Preview">
                    </div>
                </div>
            </div>

            <!-- Hidden Old Photo Input -->
            <input type="hidden" id="fotoeditlama" name="fotoeditlama" value="{{ $databerita->foto }}">

            <!-- File Upload -->
            <div class="form-group-modern">
                <label class="form-label-modern" for="fotoedit">
                    <i class="fas fa-image"></i> Ubah Foto
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
                        <span>Pilih Foto Baru</span>
                    </label>
                    <div class="file-name-display" id="fileName"></div>
                </div>
                <div class="form-helper-text">
                    <i class="fas fa-info-circle"></i>
                    Format: JPG, PNG, GIF. Maksimal 2MB
                </div>
            </div>

            <div class="form-divider"></div>

            <!-- Judul -->
            <div class="form-group-modern">
                <label class="form-label-modern required" for="juduledit">
                    <i class="fas fa-heading"></i> Judul Berita
                </label>
                <input class="form-control-modern" 
                       id="juduledit" 
                       name="juduledit" 
                       type="text" 
                       value="{{ $databerita->judul }}"
                       placeholder="Masukkan judul berita"
                       required>
            </div>

            <!-- Sub Judul -->
            <div class="form-group-modern">
                <label class="form-label-modern required" for="subjuduledit">
                    <i class="fas fa-align-left"></i> Sub Judul
                </label>
                <input class="form-control-modern" 
                       id="subjuduledit" 
                       name="subjuduledit" 
                       type="text"
                       value="{{ $databerita->subjudul }}"
                       placeholder="Masukkan sub judul berita"
                       required>
            </div>

            <!-- Isi Berita -->
            <div class="form-group-modern">
                <label class="form-label-modern required" for="isiberitaedit">
                    <i class="fas fa-file-alt"></i> Isi Berita
                </label>
                <textarea class="form-control-modern" 
                          id="isiberitaedit" 
                          name="isiberitaedit"
                          placeholder="Masukkan isi berita"
                          required>{{ $databerita->isi }}</textarea>
                <div class="form-helper-text">
                    <i class="fas fa-info-circle"></i>
                    Gunakan editor untuk format teks
                </div>
            </div>

            <!-- Link -->
            <div class="form-group-modern">
                <label class="form-label-modern" for="linkedit">
                    <i class="fas fa-link"></i> Link Berita
                </label>
                <input class="form-control-modern" 
                       id="linkedit" 
                       name="linkedit" 
                       type="text" 
                       value="{{ $databerita->link }}"
                       placeholder="https://example.com"
                       readonly>
                <div class="form-helper-text">
                    <i class="fas fa-lock"></i>
                    Link tidak dapat diubah
                </div>
            </div>

            <!-- Submit Button -->
            <button class="btn-submit-modern" type="submit">
                <i class="fas fa-save"></i>
                Update Berita
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
        document.getElementById('editBeritaForm').addEventListener('submit', function(e) {
            const judul = document.getElementById('juduledit').value.trim();
            const subjudul = document.getElementById('subjuduledit').value.trim();
            const isi = document.getElementById('isiberitaedit').value.trim();

            if (!judul || !subjudul || !isi) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return false;
            }

            // Show loading state on button
            const btn = this.querySelector('.btn-submit-modern');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            btn.disabled = true;
        });
    </script>
</body>

</html>