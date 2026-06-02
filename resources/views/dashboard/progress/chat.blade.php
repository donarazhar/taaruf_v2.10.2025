@extends('dashboard.dashlayouts.topbarchat')

<style>
    /* ===== GAYA CHAT MODERN TANPA AVATAR ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-600: #6C757D;
        --gray-800: #343A40;
        --white: #FFFFFF;
        --radius-lg: 16px;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .chat-wrapper {
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

    .single-chat-item {
        display: flex;
        flex-direction: column;
        max-width: 80%;
        animation: fadeInUp 0.3s ease;
    }

    .single-chat-item.outgoing {
        align-self: flex-end;
        text-align: right;
    }

    .single-chat-item.incoming {
        align-self: flex-start;
        text-align: left;
    }

    .user-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray-600);
        margin-bottom: 0.25rem;
    }

    .single-message {
        border-radius: var(--radius-lg);
        padding: 0.875rem 1.125rem;
        word-wrap: break-word;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .single-chat-item.outgoing .single-message {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-top-right-radius: 4px;
    }

    .single-chat-item.incoming .single-message {
        background: var(--white);
        color: var(--gray-800);
        border-top-left-radius: 4px;
    }

    .message-time-status {
        font-size: 0.75rem;
        color: var(--gray-600);
        margin-top: 0.25rem;
    }

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
        background: var(--gray-200);
    }

    .date-divider::before { left: 0; }
    .date-divider::after { right: 0; }

    .date-divider span {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .chat-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--white);
        padding: 1rem;
        border-top: 2px solid var(--gray-200);
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
    }

    .chat-footer form {
        display: flex;
        gap: 0.75rem;
    }

    .chat-footer input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        border-radius: 25px;
        border: 2px solid var(--gray-200);
        background: var(--gray-100);
    }

    .chat-footer input:focus {
        outline: none;
        border-color: var(--primary-color);
        background: white;
    }

    .btn.btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border: none;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-sm);
    }
</style>

<div class="page-content-wrapper py-3 chat-wrapper">
    <div class="container">
        <div class="chat-content-wrap">
            @foreach ($datachat as $d)
                @if ($d->email_sender == auth()->user()->email)
                    <!-- Outgoing Chat -->
                    <div class="single-chat-item outgoing">
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s', strtotime($d->tgl_pesan)) }}</div>
                                <div class="sent-status seen"><i class="fa fa-check" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Incoming Chat -->
                    <div class="single-chat-item incoming">
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <strong>{{ $d->nama ?? 'User' }}</strong>
                                    <p>{{ $d->pesan }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s', strtotime($d->tgl_pesan)) }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Chat Footer -->
<div class="chat-footer fixed-bottom bg-white border-top">
    <div class="container-fluid px-2 py-2">
        @foreach ($dataprogress as $d)
            <form action="/chat/{{ $d->id }}/store" method="POST" class="d-flex align-items-center w-100">
                @csrf
                <input class="form-control flex-grow-1 me-2" 
                       type="text" 
                       name="pesan" 
                       id="pesan" 
                       placeholder="Ketik pesan di sini..." 
                       required>
                <button class="btn btn-primary px-3" type="submit">
                    <i class="bi bi-cursor"></i>
                </button>
            </form>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.querySelector('.chat-content-wrap');
    const chatId = "{{ $dataprogress->first()->id ?? '' }}";
    const userEmail = "{{ auth()->user()->email }}";
    const chatForm = document.getElementById('chatForm');
    const inputPesan = document.getElementById('pesan');

    let lastMessageCount = 0;
    let typingTimeout;

    // Elemen indikator typing
    const typingIndicator = document.createElement('div');
    typingIndicator.classList.add('typing-indicator');
    typingIndicator.innerHTML = `
        <div class="typing-dots">
            <span></span><span></span><span></span>
        </div>
    `;
    typingIndicator.style.display = 'none';
    chatContainer.appendChild(typingIndicator);

    // CSS tambahan untuk efek typing
    const style = document.createElement('style');
    style.textContent = `
        .typing-indicator {
            display: flex;
            justify-content: flex-start;
            padding: 8px 16px;
            margin-bottom: 10px;
            animation: fadeIn 0.3s ease;
        }
        .typing-dots span {
            width: 8px;
            height: 8px;
            background-color: #ccc;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
            animation: bounce 1.4s infinite;
        }
        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .chat-content-wrap {
            scroll-behavior: smooth; /* Smooth scrolling */
        }
    `;
    document.head.appendChild(style);

    // Fungsi ambil data chat
    async function loadChat() {
        try {
            const response = await fetch(`/chat/${chatId}/fetch`);
            const data = await response.json();

            // Jika jumlah pesan berubah, update tampilan
            if (data.length !== lastMessageCount) {
                lastMessageCount = data.length;
                let html = '';
                data.forEach(d => {
                    const outgoing = d.email_sender === userEmail;
                    html += `
                        <div class="single-chat-item ${outgoing ? 'outgoing' : 'incoming'}" style="animation: fadeIn 0.2s ease;">
                            <div class="user-message">
                                <div class="message-content">
                                    <div class="single-message">
                                        ${!outgoing ? `<strong>${d.nama ?? 'User'}</strong>` : ''}
                                        <p>${d.pesan}</p>
                                    </div>
                                </div>
                                <div class="message-time-status">
                                    <div class="sent-time">${new Date(d.tgl_pesan).toLocaleTimeString()}</div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                chatContainer.innerHTML = html;
                chatContainer.appendChild(typingIndicator);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        } catch (error) {
            console.error('Gagal memuat chat:', error);
        }
    }

    // Interval ambil pesan tiap 2 detik
    loadChat();
    setInterval(loadChat, 2000);

    // Kirim pesan via AJAX
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const pesan = inputPesan.value.trim();
        if (!pesan) return;

        const formData = new FormData(chatForm);
        await fetch(chatForm.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        inputPesan.value = '';
        typingIndicator.style.display = 'none';
        loadChat();
    });

    // Deteksi user mengetik
    inputPesan.addEventListener('input', function() {
        clearTimeout(typingTimeout);
        typingIndicator.style.display = 'block';

        typingTimeout = setTimeout(() => {
            typingIndicator.style.display = 'none';
        }, 1500);
    });
});
</script>



@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
