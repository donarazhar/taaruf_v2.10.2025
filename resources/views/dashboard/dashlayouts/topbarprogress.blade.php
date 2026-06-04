<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #2563EB;
        --primary-light: #3B82F6;
        --primary-dark: #1D4ED8;
        --white: #FFFFFF;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-600: #6C757D;
        --gray-800: #343A40;
        --dark: #1F2937;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        --radius-sm: 8px;
        --radius-md: 12px;
    }

    /* ===== HEADER AREA ===== */
    #headerArea {
        background: var(--white);
        box-shadow: var(--shadow-sm);
        border-bottom: 1px solid var(--gray-200);
        padding: 0.75rem 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        width: 100%;
    }

    .header-content {
        padding: 0.5rem 0;
    }

    /* ===== BACK BUTTON ===== */
    .back-button {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-100);
        border: none;
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
    }

    .back-button:hover {
        background: var(--gray-200);
    }

    .back-button a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: var(--dark);
        text-decoration: none;
    }

    .back-button svg {
        width: 24px;
        height: 24px;
        color: var(--dark);
    }

    /* ===== PAGE TITLE ===== */
    .page-heading {
        flex: 1;
        text-align: center;
        padding: 0 1rem;
    }

    .page-heading h6 {
        color: var(--dark);
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ===== PROFILE AVATAR ===== */
    .setting-wrapper {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
    }

    .logo-wrapper {
        width: 100%;
        height: 100%;
    }

    .logo-wrapper a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--gray-200);
        transition: all 0.2s ease;
        background: var(--white);
        position: relative;
    }

    .avatar:hover {
        border-color: var(--primary-color);
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== PROFILE BADGE ===== */
    .profile-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 18px;
        height: 18px;
        background: #10B981;
        border: 2px solid var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
        color: var(--white);
        box-shadow: var(--shadow-sm);
    }

    /* ===== HEADER SCROLL EFFECT ===== */
    #headerArea.scrolled {
        box-shadow: var(--shadow-md);
    }

    /* ===== PULSE ANIMATION FOR AVATAR ===== */
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }
        50% {
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0);
        }
    }

    .avatar-pulse {
        animation: pulse 2s infinite;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        #headerArea {
            padding: 0.5rem 0;
        }

        .back-button {
            width: 40px;
            height: 40px;
        }

        .back-button svg {
            width: 24px;
            height: 24px;
        }

        .page-heading h6 {
            font-size: 1rem;
        }

        .setting-wrapper {
            width: 40px;
            height: 40px;
        }

        .avatar {
            width: 40px;
            height: 40px;
        }

        .profile-badge {
            width: 16px;
            height: 16px;
            font-size: 0.55rem;
        }
    }

    @media (max-width: 480px) {
        #headerArea {
            padding: 0.4rem 0;
        }

        .back-button {
            width: 38px;
            height: 38px;
        }

        .back-button svg {
            width: 22px;
            height: 22px;
        }

        .page-heading {
            padding: 0 0.5rem;
        }

        .page-heading h6 {
            font-size: 0.9rem;
        }

        .setting-wrapper {
            width: 38px;
            height: 38px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-width: 2px;
        }
    }
</style>

<div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content-->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
            
            <!-- Back Button-->
            <div class="back-button">
                <a href="/taaruf" title="Kembali ke Ta'aruf">
                    <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" 
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z">
                        </path>
                    </svg>
                </a>
            </div>
            
            <!-- Page Title-->
            <div class="page-heading">
                <h6 class="mb-0" title="Progress {{ $karyawan->nama }}">
                    Progress {{ $karyawan->nama }}
                </h6>
            </div>
            
            <!-- Profile Avatar-->
            <div class="setting-wrapper">
                <div class="logo-wrapper">
                    <a href="/dashboard" title="Kembali ke Dashboard">
                        <div class="avatar">
                            @php
                                $path = !empty($karyawan->foto) 
                                    ? Storage::url('uploads/karyawan/img/' . $karyawan->foto) 
                                    : '';
                                $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($karyawan->nama) . '&background=random&color=fff&size=200';
                            @endphp
                            <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                                 alt="{{ $karyawan->nama }}"
                                 title="{{ $karyawan->nama }}">
                            
                            <!-- Verified Badge -->
                            <span class="profile-badge">
                                <i class="fa fa-check" style="font-size: 0.5rem;"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const headerArea = document.getElementById('headerArea');
        const avatar = document.querySelector('.avatar');
        
        // Add scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                headerArea.classList.add('scrolled');
            } else {
                headerArea.classList.remove('scrolled');
            }
        });
        
        // Optional: Add pulse animation to avatar on hover
        if (avatar) {
            avatar.addEventListener('mouseenter', function() {
                this.classList.add('avatar-pulse');
            });
            
            avatar.addEventListener('mouseleave', function() {
                this.classList.remove('avatar-pulse');
            });
        }
    });
</script>
