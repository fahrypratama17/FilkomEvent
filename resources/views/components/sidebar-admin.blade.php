<style>
        :root {
            --blue-sidebar: #223A8C;
            --cyan-bg: #00BCD4;
            --orange-main: #FF742E;
            --bg-body: #FFFFFF;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 300px;
            background-color: var(--blue-sidebar);
            border-top-right-radius: 40px;
            padding: 40px 30px;
            color: white;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            box-sizing: border-box;
        }

        .logo-box {
            margin-bottom: 50px;
        }

        .logo-box img {
            width: 100px;
        }

        .menu-title {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 25px;
            opacity: 0.8;
            transition: 0.2s;
        }

        .menu-item:hover, .menu-item.active {
            opacity: 1;
            font-weight: 600;
        }

        .settings-section {
            margin-top: auto;
        }

        .logout-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            padding: 0;
            font-family: inherit;
            opacity: 0.8;
        }

        .logout-btn:hover {
            opacity: 1;
        }
    </style>

<aside class="sidebar">
        <div class="bg-primary-dark my-12 py-2 rounded-2xl">
            <h1 class="text-2xl font-extrabold text-center">FILKOM<span class="text-orange-550">EVENT</span></h1>
        </div>

        <div>
            <div class="menu-title">MENU UTAMA</div>
            <a href="#" class="menu-item active">
                <i data-lucide="home"></i> Beranda
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="calendar"></i> Event
            </a>
            <a href="#" class="menu-item">
                <i data-lucide="pen-line"></i> Tambah Event
            </a>
        </div>

        <div class="settings-section">
            <div class="menu-title">PENGATURAN</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-lucide="log-out"></i> Logout
                </button>
            </form>
        </div>
    </aside>