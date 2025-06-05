<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas</title>
    <link rel="stylesheet" href="/css/main.css">
    <style>
        body {
            min-height: 100vh;
            background: var(--background-color);
            color: var(--default-color);
            font-family: var(--default-font);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .estadisticas-container {
            background: color-mix(in srgb, var(--surface-color), transparent 85%);
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.12);
            padding: 40px 32px 32px 32px;
            max-width: 900px;
            width: 100%;
            margin: 40px auto;
        }
        .estadisticas-title {
            color: var(--accent-color);
            font-family: var(--heading-font);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 28px;
            letter-spacing: 1px;
            text-align: center;
        }
        .estadisticas-charts {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: center;
        }
        .estadisticas-chart-card {
            background: color-mix(in srgb, var(--surface-color), transparent 90%);
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            padding: 24px 18px 18px 18px;
            flex: 1 1 350px;
            min-width: 300px;
            max-width: 400px;
            text-align: center;
        }
        .estadisticas-back {
            margin-top: 32px;
            text-align: center;
        }
        .estadisticas-back a {
            color: var(--accent-color);
            font-family: var(--nav-font);
            font-size: 1rem;
            text-decoration: none;
            transition: color 0.2s;
            padding: 8px 24px;
            border-radius: 50px;
            border: 1.5px solid var(--accent-color);
            background: none;
            font-weight: 600;
        }
        .estadisticas-back a:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
        }
        @media (max-width: 900px) {
            .estadisticas-charts {
                flex-direction: column;
                gap: 24px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="estadisticas-container">
        <div class="estadisticas-title">Estadísticas</div>
        <div class="estadisticas-charts">
            <div class="estadisticas-chart-card">
                <h4>Ventas por Mes</h4>
                <canvas id="ventasMesChart" width="350" height="250"></canvas>
            </div>
            <div class="estadisticas-chart-card">
                <h4>Productos más vendidos</h4>
                <canvas id="productosVendidosChart" width="350" height="250"></canvas>
            </div>
        </div>
        <div class="estadisticas-back">
            <a href="{{ url('/dashboard') }}">← Volver</a>
        </div>
    </div>
    <script>
        const ventasMesLabels = @json($ventasMesLabels ?? []);
        const ventasMesData = @json($ventasMesData ?? []);
        const productosVendidosLabels = @json($productosVendidosLabels ?? []);
        const productosVendidosData = @json($productosVendidosData ?? []);

        new Chart(document.getElementById('ventasMesChart'), {
            type: 'bar',
            data: {
                labels: ventasMesLabels,
                datasets: [{
                    label: 'Ventas (€)',
                    data: ventasMesData,
                    backgroundColor: 'rgba(205, 164, 94, 0.7)',
                    borderColor: 'rgba(205, 164, 94, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('productosVendidosChart'), {
            type: 'doughnut',
            data: {
                labels: productosVendidosLabels,
                datasets: [{
                    label: 'Unidades vendidas',
                    data: productosVendidosData,
                    backgroundColor: [
                        'rgba(205, 164, 94, 0.8)',
                        'rgba(143, 22, 48, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: 'rgba(255,255,255,0.9)',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</body>
</html>