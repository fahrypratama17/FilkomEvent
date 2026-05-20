<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
      :root {
            --cyan-bg: #00B4D8;
            --orange-main: #F9682A;
            --bg-body: #FFFFFF;
        }
      /* --- MAIN CONTENT --- */
        .main-content {
            flex: 1;
            padding: 40px 60px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .header-title img {
            width: 70px;
        }

        .header-title h1 {
            font-size: 38px;
            font-weight: 800;
            margin: 0;
            color: #000;
        }

        .header-title h1 span {
            color: var(--orange-main);
        }

        /* --- STATS CARDS --- */
        .stats-wrapper {
            background-color: var(--cyan-bg);
            border-radius: 20px;
            padding: 30px 100px;
            display: flex;
            gap: 55px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            background-color: var(--orange-main);
            border-radius: 20px;
            padding: 60px 45px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .stat-item, .stat-card {
            flex: 1;
            max-width: 180px; 
            margin: 0 auto; 
        }

        .stat-card h2 {
            font-size: 70px;
            font-weight: 800;
            margin: 0 0 10px 0;
            line-height: 1;
        }

        .stat-card p {
            font-size: 20px;
            margin: 0;
            line-height: 1.4;
        }

        /* --- CHART SECTION --- */
        .chart-wrapper {
            background-color: var(--orange-main);
            border-radius: 30px;
            padding: 40px 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 100px;
        }

        /* Donut Chart CSS Murni */
        .donut-chart {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: conic-gradient(
                #03045E 0deg 90deg,     
                #023E8A 90deg 180deg,   
                #0096C7 180deg 270deg,  
                #00B4D8 270deg 360deg   
            );
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donut-inner {
            width: 160px;
            height: 160px;
            background-color: var(--orange-main);
            border-radius: 50%;
        }

        /* Legend */
        .legend-card {
            background-color: white;
            border-radius: 20px;
            padding: 30px 40px;
            width: 400px;
            height: 200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .legend-list {
            list-style: none;
            padding: 20;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 24px;
            font-weight: 650;
            color: #03045E;
        }

        .dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            gap: 10px;
            padding: 8px;
        }
    </style>
</head>
<body>

    @php
        // Data PHP untuk Statistik
        $stats = [
            ['value' => '24', 'label' => 'Jumlah<br>Event'],
            ['value' => '08', 'label' => 'Event Akan<br>Datang'],
            ['value' => '15', 'label' => 'Event Sedang<br>Berlangsung'],
            ['value' => '01', 'label' => 'Event<br>Selesai'],
        ];
    @endphp

    @include('components.sidebar-admin')

    <main class="main-content">
        
        <div class="header-title">
            <img src="{{ asset('icon/FilkomEventAvatar.svg') }}" alt="Filko">
            <h1>Welcome, <span>Admin!</span></h1>
        </div>

        <div class="stats-wrapper">
            @foreach($stats as $item)
            <div class="stat-card">
                <h2>{{ $item['value'] }}</h2>
                <p>{!! $item['label'] !!}</p>
            </div>
            @endforeach
        </div>

        <div class="chart-wrapper">
            <div class="donut-chart">
                <div class="donut-inner"></div>
            </div>

            <div class="legend-card">
                <ul class="legend-list">
                    <li class="legend-item"><span class="dot" style="background-color: #03045E;"></span> Lomba</li>
                    <li class="legend-item"><span class="dot" style="background-color: #023E8A;"></span> Webinar</li>
                    <li class="legend-item"><span class="dot" style="background-color: #0096C7;"></span> Seminar</li>
                    <li class="legend-item"><span class="dot" style="background-color: #00B4D8;"></span> Workshop</li>
                </ul>
            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>