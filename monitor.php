<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Cryptocurrency</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://s3.tradingview.com/tv.js"></script>
    <style>
        .tradingview-widget-container {
            margin-top: 20px;
            width: 100%;
        }
        .tradingview-widget-container__widget {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<section id="sidebar">
    <ul class="side-menu top">
        <li>
            <a href="index.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Monitor</span>
            </a>
        </li>
        <li class="active">
            <a href="pantau.php">
                <i class='bx bxs-shopping-bag-alt'></i>
                <span class="text">Monitor</span>
            </a>
        </li>
        <li>
            <a href="kategori.php">
                <i class='bx bxs-shopping-bag-alt'></i>
                <span class="text">Categories</span>
            </a>
        </li>
    </ul>
</section>

<section id="content">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Monitor Cryptocurrency</h1>
                <ul class="breadcrumb"></ul>
            </div>
        </div>

        <div id="chartsContainer"></div>
    </main>
</section>

<script>
const urlParams = new URLSearchParams(window.location.search);
const selectedCoins = urlParams.getAll('coins[]');

if (selectedCoins.length > 0) {
    selectedCoins.forEach(coin => {
        const container = document.createElement('div');
        container.classList.add('tradingview-widget-container');

        const widgetDiv = document.createElement('div');
        widgetDiv.className = "tradingview-widget-container__widget";
        container.appendChild(widgetDiv);

        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = "https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js";
        const json = {
            "symbol": `${coin}USDT`, 
            "width": "100%",
            "height": 220,
            "locale": "en",
            "dateRange": "12M",
            "colorTheme": "light",
            "isTransparent": false,
            "autosize": true,
            "largeChartUrl": ""
        };
        script.innerHTML = JSON.stringify(json);
        container.appendChild(script);

        document.getElementById('chartsContainer').appendChild(container);
    });
} else {
    document.getElementById('chartsContainer').innerHTML = '<p>No coins selected for monitoring.</p>';
}

</script>
</body>
</html>
