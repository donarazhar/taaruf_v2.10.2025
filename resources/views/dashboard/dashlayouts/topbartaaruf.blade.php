<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --white: #FFFFFF;
        --gray-100: #F8F9FA;
        --gray-800: #343A40;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
    }

    /* ===== HEADER AREA ===== */
    #headerArea {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        box-shadow: var(--shadow-md);
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
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: var(--radius-md);
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateX(-3px);
        box-shadow: var(--shadow-sm);
    }

    .back-button a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: var(--white);
        text-decoration: none;
    }

    .back-button svg {
        width: 28px;
        height: 28px;
        color: var(--white);
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    /* ===== PAGE TITLE ===== */
    .page-heading {
        flex: 1;
        text-align: center;
        padding: 0 1rem;
    }

    .page-heading h6 {
        color: var(--white);
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
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
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--white);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        background: var(--white);
        position: relative;
    }

    .avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 16px rgba(255,255,255,0.4);
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
        box-shadow: 0 4px 20px rgba(0, 83, 197, 0.3);
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
                <h6 class="mb-0" title="Profile {{ $karyawan->nama }}">
                    Profile {{ $karyawan->nama }}
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
                                $defaultAvatar = $karyawan->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                            @endphp
                            <img src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}"
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