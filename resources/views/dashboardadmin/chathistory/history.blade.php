@extends('dashboard.dashlayouts.topbarchathistory')

<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --success-color: #10B981;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-300: #DEE2E6;
        --gray-600: #6C757D;
        --gray-700: #495057;
        --gray-800: #343A40;
        --white: #FFFFFF;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    /* ===== GLOBAL STYLES ===== */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* ===== CHAT WRAPPER ===== */
    .chat-wrapper {
        background: transparent;
        min-height: 100vh;
        padding: 1.5rem 0 100px;
    }

    .chat-content-wrap {
        max-width: 800px;
        margin: 0 auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* ===== CHAT ITEM BASE ===== */
    .single-chat-item {
        display: flex;
        gap: 0.75rem;
        max-width: 85%;
        animation: fadeInUp 0.3s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== USER AVATAR ===== */
    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 3px solid var(--white);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .user-avatar:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
    }

    /* ===== USER MESSAGE ===== */
    .user-message {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .message-content {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .single-message {
        border-radius: var(--radius-lg);
        padding: 0.875rem 1.125rem;
        word-wrap: break-word;
        box-shadow: var(--shadow-sm);
        position: relative;
        transition: all 0.3s ease;
    }

    .single-message:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .single-message p {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--gray-800);
    }

    /* ===== OUTGOING MESSAGE (SENT BY USER) ===== */
    .single-chat-item.outgoing {
        flex-direction: row-reverse;
        align-self: flex-end;
        margin-left: auto;
    }

    .single-chat-item.outgoing .user-message {
        align-items: flex-end;
    }

    .single-chat-item.outgoing .single-message {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border-top-right-radius: 4px;
        color: var(--white);
    }

    .single-chat-item.outgoing .single-message p {
        color: var(--white);
    }

    .single-chat-item.outgoing .message-time-status {
        flex-direction: row-reverse;
        text-align: right;
    }

    /* ===== INCOMING MESSAGE (RECEIVED) ===== */
    .single-chat-item.incoming {
        flex-direction: row;
        align-self: flex-start;
    }

    .single-chat-item.incoming .user-message {
        align-items: flex-start;
    }

    .single-chat-item.incoming .single-message {
        background: var(--white);
        border-top-left-radius: 4px;
    }

    .single-chat-item.incoming .message-time-status {
        flex-direction: row;
        text-align: left;
    }

    /* ===== MESSAGE TIME & STATUS ===== */
    .message-time-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0 0.5rem;
    }

    .sent-time {
        font-size: 0.75rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    .sent-status {
        display: flex;
        align-items: center;
        font-size: 0.75rem;
    }

    .sent-status.seen {
        color: var(--success-color);
    }

    .sent-status i {
        font-size: 0.85rem;
    }

    /* ===== DATE DIVIDER ===== */
    .date-divider {
        text-align: center;
        margin: 1.5rem 0;
        position: relative;
    }

    .date-divider::before,
    .date-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: calc(50% - 60px);
        height: 1px;
        background: var(--gray-300);
    }

    .date-divider::before {
        left: 0;
    }

    .date-divider::after {
        right: 0;
    }

    .date-divider span {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: var(--shadow-sm);
        display: inline-block;
    }

    /* ===== EMPTY STATE ===== */
    .empty-chat-state {
        text-align: center;
        padding: 4rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
    }

    .empty-chat-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .empty-chat-text h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    .empty-chat-text p {
        color: var(--gray-600);
        font-size: 1rem;
    }

    /* ===== CHAT INPUT AREA ===== */
    .chat-input-area {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--white);
        padding: 1rem;
        border-top: 2px solid var(--gray-200);
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
        z-index: 999;
    }

    .chat-input-container {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .chat-input-wrapper {
        flex: 1;
        position: relative;
    }

    .chat-input {
        width: 100%;
        padding: 0.875rem 3rem 0.875rem 1.25rem;
        border: 2px solid var(--gray-200);
        border-radius: 25px;
        font-size: 0.95rem;
        background: var(--gray-100);
        transition: all 0.3s ease;
    }

    .chat-input:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
    }

    .btn-attach {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--gray-600);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-attach:hover {
        color: var(--primary-color);
        transform: translateY(-50%) scale(1.1);
    }

    .btn-send {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 50%;
        color: var(--white);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .btn-send:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
    }

    .btn-send:active {
        transform: scale(0.95);
    }

    /* ===== TYPING INDICATOR ===== */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        max-width: 80px;
    }

    .typing-dots {
        display: flex;
        gap: 0.25rem;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        background: var(--gray-600);
        border-radius: 50%;
        animation: typing 1.4s infinite;
    }

    .typing-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.7;
        }
        30% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    /* ===== MESSAGE BUBBLE TAIL ===== */
    .single-chat-item.outgoing .single-message::before {
        content: '';
        position: absolute;
        top: 0;
        right: -8px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 0 12px 12px;
        border-color: transparent transparent var(--primary-light) transparent;
    }

    .single-chat-item.incoming .single-message::before {
        content: '';
        position: absolute;
        top: 0;
        left: -8px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 12px 12px 0;
        border-color: transparent var(--white) transparent transparent;
    }

    /* ===== SCROLL TO BOTTOM BUTTON ===== */
    .scroll-to-bottom {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 50%;
        color: var(--white);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
    }

    .scroll-to-bottom.show {
        opacity: 1;
        visibility: visible;
    }

    .scroll-to-bottom:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-lg);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .chat-content-wrap {
            padding: 0.75rem;
        }

        .single-chat-item {
            max-width: 90%;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-width: 2px;
        }

        .single-message {
            padding: 0.75rem 1rem;
        }

        .single-message p {
            font-size: 0.9rem;
        }

        .sent-time {
            font-size: 0.7rem;
        }

        .chat-input-container {
            gap: 0.5rem;
        }

        .btn-send {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }

        .date-divider span {
            font-size: 0.75rem;
            padding: 0.35rem 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .single-chat-item {
            max-width: 95%;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
        }

        .single-message {
            padding: 0.65rem 0.875rem;
        }

        .chat-input {
            font-size: 0.9rem;
            padding: 0.75rem 2.75rem 0.75rem 1rem;
        }
    }

    /* ===== LINK STYLING ===== */
    .single-message a {
        color: inherit;
        text-decoration: underline;
        opacity: 0.9;
    }

    .single-message a:hover {
        opacity: 1;
    }

    /* ===== IMAGE IN MESSAGE ===== */
    .message-image {
        max-width: 100%;
        border-radius: var(--radius-md);
        margin-top: 0.5rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .message-image:hover {
        transform: scale(1.02);
    }

    /* ===== LOADING STATE ===== */
    .loading-chat {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid var(--gray-200);
        border-top-color: var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div class="page-content-wrapper py-3 chat-wrapper">
    <div class="container">
        <div class="chat-content-wrap">
            @php
                $allChats = $allChats
                    ->sortBy(function ($item) {
                        return $item->tgl_pesan_sender ?? $item->tgl_pesan_profile;
                    })
                    ->values();
                
                $currentDate = null;
            @endphp

            @forelse ($allChats as $index => $d)
                @php
                    // Get message date
                    $messageDate = $d->tgl_pesan_sender ?? $d->tgl_pesan_profile;
                    $messageDay = date('Y-m-d', strtotime($messageDate));
                    
                    // Check if we need to show date divider
                    $showDateDivider = false;
                    if ($currentDate !== $messageDay) {
                        $showDateDivider = true;
                        $currentDate = $messageDay;
                    }
                    
                    // Format date for divider
                    $today = date('Y-m-d');
                    $yesterday = date('Y-m-d', strtotime('-1 day'));
                    
                    if ($messageDay === $today) {
                        $dateLabel = 'Hari Ini';
                    } elseif ($messageDay === $yesterday) {
                        $dateLabel = 'Kemarin';
                    } else {
                        $dateLabel = date('d F Y', strtotime($messageDay));
                    }
                @endphp

                {{-- Date Divider --}}
                @if ($showDateDivider)
                    <div class="date-divider">
                        <span>{{ $dateLabel }}</span>
                    </div>
                @endif

                @if ($d->nama_sender && $d->pesan_sender !== null)
                    {{-- Outgoing Chat Item (Sent by current user) --}}
                    <div class="single-chat-item outgoing">
                        <div class="user-avatar-wrapper">
                            @php
                                $pathchat = !empty($d->foto_sender) 
                                    ? Storage::url('uploads/karyawan/img/' . $d->foto_sender)
                                    : asset('assets/img/avatar.jpg');
                            @endphp
                            <img class="user-avatar" src="{{ url($pathchat) }}" alt="{{ $d->nama_sender }}"
                                 title="{{ $d->nama_sender }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan_sender }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">
                                    {{ date('H:i', strtotime($d->tgl_pesan_sender)) }}
                                </div>
                                <div class="sent-status seen" title="Terkirim">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($d->nama_profile && $d->pesan_profile !== null)
                    {{-- Incoming Chat Item (Received from other user) --}}
                    <div class="single-chat-item incoming">
                        <div class="user-avatar-wrapper">
                            @php
                                $pathchatprofile = !empty($d->foto_profile)
                                    ? Storage::url('uploads/karyawan/img/' . $d->foto_profile)
                                    : asset('assets/img/avatarwanita.jpg');
                            @endphp
                            <img class="user-avatar" src="{{ url($pathchatprofile) }}" alt="{{ $d->nama_profile }}"
                                 title="{{ $d->nama_profile }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan_profile }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">
                                    {{ date('H:i', strtotime($d->tgl_pesan_profile)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                {{-- Empty State --}}
                <div class="empty-chat-state">
                    <div class="empty-chat-icon">💬</div>
                    <div class="empty-chat-text">
                        <h3>Belum Ada Pesan</h3>
                        <p>Mulai percakapan dengan mengirim pesan pertama</p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
</div>

{{-- Scroll to Bottom Button --}}
<button class="scroll-to-bottom" id="scrollToBottom" onclick="scrollToBottom()">
    <i class="fa fa-chevron-down"></i>
</button>

{{-- JavaScript --}}
<script>
    // Scroll to bottom on page load
    window.addEventListener('load', function() {
        scrollToBottom();
    });

    // Scroll to bottom function
    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }

    // Show/hide scroll to bottom button
    window.addEventListener('scroll', function() {
        const scrollBtn = document.getElementById('scrollToBottom');
        const scrollPosition = window.innerHeight + window.scrollY;
        const documentHeight = document.body.scrollHeight;
        
        if (documentHeight - scrollPosition > 500) {
            scrollBtn.classList.add('show');
        } else {
            scrollBtn.classList.remove('show');
        }
    });

    // Auto-scroll on new message (for real-time updates)
    function scrollOnNewMessage() {
        const chatWrap = document.querySelector('.chat-content-wrap');
        const isNearBottom = window.innerHeight + window.scrollY >= document.body.scrollHeight - 100;
        
        if (isNearBottom) {
            scrollToBottom();
        }
    }

    // Format time helper
    function formatTime(date) {
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    // Get date label helper
    function getDateLabel(date) {
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        
        const messageDate = new Date(date);
        
        if (messageDate.toDateString() === today.toDateString()) {
            return 'Hari Ini';
        } else if (messageDate.toDateString() === yesterday.toDateString()) {
            return 'Kemarin';
        } else {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return messageDate.toLocaleDateString('id-ID', options);
        }
    }
</script>

@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')