<style>
    /* ===== MODERN FOOTER NAVIGATION ===== */
    .footer-nav-area {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: var(--footer-height);
        background: var(--white);
        border-top: 2px solid var(--gray-200);
        z-index: 999;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
    }

    .footer-nav {
        height: 100%;
        padding: 0;
    }

    .footer-nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .footer-nav li {
        flex: 1;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-nav li a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        text-decoration: none;
        color: var(--gray-600);
        transition: all 0.3s ease;
        padding: 8px 12px;
        border-radius: var(--radius-md);
        width: 100%;
        height: 100%;
        position: relative;
    }

    .footer-nav li a svg {
        width: 24px;
        height: 24px;
        transition: all 0.3s ease;
    }

    .footer-nav li a span {
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    /* Hover State */
    .footer-nav li a:hover {
        color: var(--black);
    }

    .footer-nav li a:hover svg {
        transform: translateY(-2px);
    }

    /* Active State */
    .footer-nav li.active a {
        color: var(--black);
        font-weight: 700;
    }

    .footer-nav li.active a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 3px;
        background: var(--black);
        border-radius: 0 0 3px 3px;
    }

    .footer-nav li.active a svg {
        transform: scale(1.1);
    }

    /* Ripple Effect */
    .footer-nav li a::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: var(--radius-md);
        background: var(--black);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .footer-nav li a:active::after {
        opacity: 0.1;
    }

    /* Mobile Adjustments */
    @media (max-width: 768px) {
        .footer-nav li a {
            padding: 6px 8px;
        }

        .footer-nav li a svg {
            width: 22px;
            height: 22px;
        }

        .footer-nav li a span {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 480px) {
        .footer-nav li a span {
            font-size: 0.65rem;
        }

        .footer-nav li a svg {
            width: 20px;
            height: 20px;
        }
    }

    /* Desktop Wide Screen */
    @media (min-width: 1200px) {
        .footer-nav-area {
            max-width: 600px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }
    }
</style>

<div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
        <div class="footer-nav position-relative">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <!-- Home -->
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" title="Home">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>

                <!-- Profile -->
                <li class="{{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" title="Profile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </li>

                @if ($menuAktif)
                    <!-- Ta'aruf -->
                    <li class="{{ request()->is('taaruf') ? 'active' : '' }}">
                        <a href="{{ route('taaruf') }}" title="Ta'aruf">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3m2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1" />
                            </svg>
                            <span>Ta'aruf</span>
                        </a>
                    </li>

                    <!-- Progress -->
                    <li class="{{ request()->is('progress') ? 'active' : '' }}">
                        <a href="{{ route('progress') }}" title="Progress">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                            </svg>
                            <span>Progress</span>
                        </a>
                    </li>
                @endif

                <!-- Logout -->
                <li class="{{ request()->is('proseslogout') ? 'active' : '' }}">
                    <a href="/proseslogout" title="Logout" onclick="return confirm('Yakin ingin logout?')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm10.5 10V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4A.5.5 0 0 0 10.5 12" />
                        </svg>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
