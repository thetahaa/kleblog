<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <title>Admin | Yeni Yorumlar</title>
    <style>
        :root {
            --bg-dark: #111827;
            --bg-medium: #1F2937;
            --bg-light: #374151;
            --text-primary: #F3F4F6;
            --text-secondary: #9CA3AF;
            --accent-color: #818CF8;
            --border-color: #4B5563;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .header {
            background-color: var(--bg-medium);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav-container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 1rem;
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
        }

        .menu-button {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.5rem;
        }

        .menu-button:hover {
            color: var(--text-primary);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--bg-light);
            border-radius: 0.375rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            min-width: 12rem;
            padding: 0.25rem 0;
        }

        .dropdown-menu.show {
            display: block;
        }

        .main-content {
            max-width: 72rem;
            margin: 0 auto;
            padding: 2rem 1rem;
            flex: 1;
            width: 100%;
        }

        .comment-container {
            background-color: var(--bg-medium);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .comment-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .comment-card {
            background-color: var(--bg-light);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-name {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .comment-time {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .comment-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .post-link {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.875rem;
        }

        .post-link:hover {
            color: #A5B4FC;
        }

        .footer {
            background-color: var(--bg-medium);
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .footer-content {
            max-width: 72rem;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .footer-text {
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin: 0.5rem 0;
        }

        .footer-links {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.75rem;
        }

        .footer-link:hover {
            color: var(--text-primary);
        }

        .divider {
            color: var(--text-secondary);
        }

        .icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .border-top {
            border-top: 1px solid var(--border-color);
            padding-top: 0.75rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .space-x-2 > * + * {
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <div class="nav-content">
                <a class="logo">Yorum Bildirimleri</a>
                <div class="flex items-center">
                    <div class="relative">
                        <button id="menuButton" class="menu-button">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                        </button>

                        
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <div class="comment-container">
            <h1 class="comment-title">Yeni Yorum Bildirimleri</h1>
            
            <div class="comment-list">
                <div class="comment-card">
                    <div class="comment-header">
                        <div class="user-info">
                            <span class="text-indigo-400">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    
                    <div class="comment-text">
                    </div>
                    
                    <div class="border-top">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-400">İlgili Post:</span>
                            <a href="{{ route('post.show', $comment->post->id) }}" class="post-link">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-inner">
                <p class="footer-text">
                    © 2025 Blog. Tüm hakları saklıdır.
                </p>
                <div class="footer-links">
                    <a href="/kvkk" class="footer-link">
                        KVKK
                    </a>
                    <span class="divider">|</span>
                    <a href="/gizlilik-politikasi" class="footer-link">
                        Gizlilik Politikası
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        
        if(menuButton && dropdownMenu) {
            menuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            
            document.addEventListener('click', (event) => {
                if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }
    </script>
</body>
</html> -->

<h3>Yeni Yorum Geldi!</h3>