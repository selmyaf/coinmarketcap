<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrency Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            width: 100%;
        }

        /* TradingView Widget */
        .tradingview-widget-container {
            margin-top: 20px;
            width: 100%;
            height: 600px;
        }

        .tradingview-widget-container__widget {
            width: 100%;
            height: 100%;
        }

        /* Additional CSS */
        .news-container {
            margin-top: 20px;
            width: 100%; 
            padding: 20px; 
            background-color: #f9f9f9; 
        }

        .news-container h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .news {
            display: flex;
            flex-direction: column; 
            gap: 20px; 
        }

        .news-item {
            background-color: transparent; 
            border: none; 
            padding: 0; 
        }

        .news-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .news-item p {
            font-size: 14px;
            color: #666;
        }

        .news-item a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .news-item a:hover {
            text-decoration: underline;
        }

        #weatherInfo {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #weatherInfo h3 {
            margin-bottom: 10px;
            color: #333;
        }

        #weatherInfo p {
            margin-bottom: 5px;
            color: #666;
        }

        .head {
            display: flex;
            align-items: center;
        }

        .search-container,
        .filter-container {
            margin-left: 10px;
            margin-bottom: 2px;
        }

        #searchInput,
        #filterSelect {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 2px;
        }

        .total-rp {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .total-rp i {
            font-size: 24px;
            margin-right: 10px;
        }

        .total-rp .text h3 {
            margin: 0;
        }

        .total-rp .text p {
            margin: 0;
            color: #666;
        }
        /* News Container */
        .news-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .news-container h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .news {
            display: grid;
            gap: 20px;
        }

        .news-item {
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .news-item h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .news-item p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .news-item a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .news-item a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title" id="crypto-name">Cryptocurrency Details</h1>
            <img id="crypto-logo" alt="Logo" class="img-fluid mb-3">
            <p><strong>Symbol:</strong> <span id="crypto-symbol"></span></p>
            <p><strong>Category:</strong> <span id="crypto-category"></span></p>
            <p><strong>Description:</strong> <span id="crypto-description"></span></p>
            <a id="crypto-website" class="btn btn-primary" style="display: none;">Official Website</a>
            
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                
            </div>
            <div class="news-container">
        <h2>Latest News</h2>
        <div class="news" id="news"></div>
    </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const apiKey = '12f177e0-4acc-404f-907a-eae5b7db67fd';  // Ganti dengan kunci API Anda
    const urlParams = new URLSearchParams(window.location.search);
    const cryptoId = urlParams.get('id');

    if (!cryptoId) {
        alert('Error: Tidak ada ID cryptocurrency yang ditentukan.');
        return;
    }

    const cryptoInfoUrl = `https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=${cryptoId}`;

    fetch(cryptoInfoUrl, {
        method: 'GET',
        headers: {
            'X-CMC_PRO_API_KEY': apiKey,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.data[cryptoId]) {
            alert('Error: ID cryptocurrency tidak valid atau kesalahan API.');
            return;
        }

        const cryptoData = data.data[cryptoId];
        const cryptoName = cryptoData.name; // Mengambil nama cryptocurrency dari data
        document.getElementById('crypto-name').textContent = `${cryptoName} Details`;
        document.getElementById('crypto-logo').src = cryptoData.logo;
        document.getElementById('crypto-logo').alt = `Logo of ${cryptoData.name}`;
        document.getElementById('crypto-symbol').textContent = cryptoData.symbol;
        document.getElementById('crypto-category').textContent = cryptoData.category;
        document.getElementById('crypto-description').textContent = cryptoData.description;

        if (cryptoData.urls.website && cryptoData.urls.website[0]) {
            const websiteLink = document.getElementById('crypto-website');
            websiteLink.href = cryptoData.urls.website[0];
            websiteLink.style.display = 'block';
        }

        // Call fetchCryptoNews() with the crypto name
        fetchCryptoNews(cryptoName);
        
        // Update TradingView Widget Symbol
        updateTradingViewSymbol(cryptoData.symbol + 'USDT');
    });

    function updateTradingViewSymbol(symbol) {
        const scriptContent = `
        {
            "autosize": true,
            "symbol": "${symbol}",
            "interval": "D",
            "timezone": "Etc/UTC",
            "theme": "light",
            "style": "1",
            "locale": "en",
            "allow_symbol_change": true,
            "calendar": false,
            "support_host": "https://www.tradingview.com"
        }`;

        // Remove the existing script if any
        const oldScript = document.querySelector('.tradingview-widget-container script');
        if (oldScript) {
            oldScript.remove();
        }

        // Create new script element
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
        script.text = scriptContent;

        // Append the new script to the container
        const container = document.querySelector('.tradingview-widget-container');
        if (container) {
            container.appendChild(script);
        }
    }

    // rima
    async function fetchCryptoNews(cryptoName) {
        const url = 'https://newsapi.org/v2/everything';
        const apiKey = '76c1b8a651f74153ad17dbb3abecb11b'; // Ganti dengan API key Anda
        const query = cryptoName;
        const fromDate = '2024-06-23';
        const sortBy = 'publishedAt';

        const requestUrl = `${url}?q=${query}&from=${fromDate}&sortBy=${sortBy}&apiKey=${apiKey}`;

        try {
            const response = await fetch(requestUrl);
            const data = await response.json();

            if (data.status === 'ok') {
                displayCryptoNews(data.articles);
            } else {
                console.error('Failed to fetch news:', data);
            }
        } catch (error) {
            console.error('Error fetching news:', error);
        }
    }

    // Function to display news on the web page
    function displayCryptoNews(articles) {
        const newsContainer = document.getElementById('news');
        // Clear the content before displaying new news
        newsContainer.innerHTML = '';
        articles.forEach(article => {
            const articleDiv = document.createElement('div');
            articleDiv.classList.add('news-item');
            articleDiv.innerHTML = `
                <h2>${article.title}</h2>
                <p>${article.description}</p>
                <a href="${article.url}" target="_blank">Read more</a>
            `;
            newsContainer.appendChild(articleDiv);
        });
    }
});

</script>
</body>
</html>
