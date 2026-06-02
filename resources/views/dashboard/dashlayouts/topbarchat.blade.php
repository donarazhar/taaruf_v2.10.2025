<style>
    /* ===== TOPBAR CHAT HISTORY STYLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --white: #FFFFFF;
        --gray-100: #F8F9FA;
        --gray-600: #6C757D;
        --gray-800: #343A40;
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* ===== HEADER AREA ===== */
    .header-area {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        box-shadow: var(--shadow-md);
        backdrop-filter: blur(10px);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .header-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, 
            rgba(255,255,255,0.1) 0%, 
            transparent 50%, 
            rgba(255,255,255,0.1) 100%);
        pointer-events: none;
    }

    .header-content {
        padding: 1rem 0;
        min-height: 65px;
        position: relative;
        z-index: 1;
    }

    /* ===== CHAT USER INFO ===== */
    .chat-user--info {
        gap: 1rem;
        flex: 1;
    }

    /* ===== BACK BUTTON ===== */
    .back-button {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .back-button a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        color: var(--white);
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .back-button a:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateX(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .back-button a:active {
        transform: translateX(-3px) scale(0.95);
    }

    .back-button svg {
        width: 24px;
        height: 24px;
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
    }

    /* ===== USER THUMBNAIL & NAME ===== */
    .user-thumbnail-name {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        flex: 1;
    }

    .user-thumbnail {
        position: relative;
    }

    .user-thumbnail img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.9);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .user-thumbnail img:hover {
        transform: scale(1.08);
        border-color: var(--white);
    }

    /* Online Status Badge */
    .user-thumbnail::after {
        content: '';
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        background: #10B981;
        border: 2.5px solid var(--primary-color);
        border-radius: 50%;
        box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
        animation: pulse-online 2s infinite;
    }

    @keyframes pulse-online {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1);
        }
    }

    /* Offline Status */
    .user-thumbnail.offline::after {
        background: var(--gray-600);
        animation: none;
    }

    .user-info-text {
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .user-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        letter-spacing: 0.3px;
    }

    .user-status {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-weight: 500;
    }

    .user-status::before {
        content: '';
        width: 6px;
        height: 6px;
        background: #10B981;
        border-radius: 50%;
        display: inline-block;
        animation: blink 2s infinite;
    }

    .user-status.offline::before {
        background: var(--gray-600);
        animation: none;
    }

    @keyframes blink {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.4;
        }
    }

    .user-last-seen {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        font-weight: 400;
    }

    /* ===== HEADER ACTIONS ===== */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        color: var(--white);
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .action-btn:active {
        transform: translateY(0);
    }

    .action-btn i {
        font-size: 1.1rem;
    }

    /* ===== DROPDOWN MENU ===== */
    .dropdown-menu {
        background: var(--white);
        border: none;
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        padding: 0.5rem;
        min-width: 200px;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: var(--gray-800);
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .dropdown-item:hover {
        background: var(--gray-100);
        color: var(--primary-color);
        transform: translateX(3px);
    }

    .dropdown-item i {
        font-size: 1rem;
        width: 20px;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: var(--gray-200);
    }

    /* ===== TYPING INDICATOR IN HEADER ===== */
    .typing-indicator-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.8rem;
        font-style: italic;
    }

    .typing-dots-header {
        display: flex;
        gap: 0.2rem;
    }

    .typing-dot-header {
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        animation: typingHeader 1.4s infinite;
    }

    .typing-dot-header:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-dot-header:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot-header:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typingHeader {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.7;
        }
        30% {
            transform: translateY(-5px);
            opacity: 1;
        }
    }

    /* ===== CHAT TITLE ===== */
    .chat-title {
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .chat-title h6 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--white);
        margin: 0;
        text-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    .chat-subtitle {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        font-weight: 500;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .header-content {
            padding: 0.875rem 0;
            min-height: 60px;
        }

        .back-button a {
            width: 38px;
            height: 38px;
        }

        .back-button svg {
            width: 22px;
            height: 22px;
        }

        .user-thumbnail img {
            width: 40px;
            height: 40px;
            border-width: 2.5px;
        }

        .user-thumbnail::after {
            width: 11px;
            height: 11px;
            border-width: 2px;
        }

        .user-name {
            font-size: 0.95rem;
        }

        .user-status {
            font-size: 0.75rem;
        }

        .action-btn {
            width: 36px;
            height: 36px;
        }

        .action-btn i {
            font-size: 1rem;
        }

        .chat-title h6 {
            font-size: 0.95rem;
        }

        .chat-subtitle {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .header-content {
            padding: 0.75rem 0;
        }

        .chat-user--info {
            gap: 0.75rem;
        }

        .user-thumbnail-name {
            gap: 0.75rem;
        }

        .user-name {
            font-size: 0.9rem;
        }

        .user-status {
            font-size: 0.7rem;
        }

        .header-actions {
            gap: 0.35rem;
        }
    }

    /* ===== BODY PADDING FOR FIXED HEADER ===== */
    body {
        padding-top: 65px;
    }

    @media (max-width: 768px) {
        body {
            padding-top: 60px;
        }
    }
</style>

<div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content-->
        <div class="header-content position-relative d-flex align-items-center justify-content-between">
            <!-- Chat User Info-->
            <div class="chat-user--info d-flex align-items-center">
                <!-- Back Button-->
                <div class="back-button">
                    <a href="/dashboardadmin" title="Kembali ke Dashboard">
                        <svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" 
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </a>
                </div>

                <!-- User Thumbnail & Name-->
                <div class="user-thumbnail-name">
                    @if(isset($chatPartner))
                        <!-- User Avatar -->
                        <div class="user-thumbnail {{ $chatPartner->is_online ? '' : 'offline' }}">
                            @php
                                $avatarPath = !empty($chatPartner->foto) 
                                    ? Storage::url('uploads/karyawan/img/' . $chatPartner->foto)
                                    : asset('assets/img/' . ($chatPartner->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg'));
                            @endphp
                            <img src="{{ url($avatarPath) }}" alt="{{ $chatPartner->nama }}">
                        </div>

                        <!-- User Info Text -->
                        <div class="user-info-text">
                            <h6 class="user-name">{{ $chatPartner->nama }}</h6>
                            @if(isset($chatPartner->is_typing) && $chatPartner->is_typing)
                                <div class="typing-indicator-header">
                                    <span>sedang mengetik</span>
                                    <div class="typing-dots-header">
                                        <span class="typing-dot-header"></span>
                                        <span class="typing-dot-header"></span>
                                        <span class="typing-dot-header"></span>
                                    </div>
                                </div>
                            @else
                                <p class="user-status {{ $chatPartner->is_online ? '' : 'offline' }}">
                                    {{ $chatPartner->is_online ? 'Online' : 'Offline' }}
                                </p>
                                @if(!$chatPartner->is_online && isset($chatPartner->last_seen))
                                    <p class="user-last-seen">
                                        Terakhir dilihat {{ $chatPartner->last_seen }}
                                    </p>
                                @endif
                            @endif
                        </div>
                    @else
                        <!-- Default Chat Title -->
                        <div class="chat-title">
                            <h6>Riwayat Chat</h6>
                            <span class="chat-subtitle">Percakapan Anda</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

