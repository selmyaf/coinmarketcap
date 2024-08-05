<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pabw</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- TradingView Widget CSS -->
    <link rel="stylesheet" type="text/css" href="https://s3.tradingview.com/external-embedding/embed-widget-timeline.css">
</head>
<style>
    /* style.css */

/* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* News Container */
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
            margin-left: 10px; /* Spacing between elements */
            margin-bottom: 2px; /* Spacing between elements */
        }

        #searchInput,
        #filterSelect {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 2px; /* Add margin below the input elements */
        }      
</style>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <ul class="side-menu top">
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
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
            <li>
                <a href="portofolio.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Portofolio</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- END SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <div id="weatherInfo">
                    <p>Loading...</p>
                </div>
                <ul class="box-info" id="globalMarketMetrics">            
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3 id="totalMarketCap" >Loading...</h3>
                        <p>Total Market Cap</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3 id="btcDominance">Loading...</h3>
                        <p>Bitcoin Dominance</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3 id="ethDominance">Loading...</h3>
                        <p>Ethereum Dominance</p>
                    </span>
                </li>
            </ul>

            <!-- Dini -->

            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright">
                    <a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank">
                        <span class="blue-text">Track all markets on TradingView</span>
                    </a>
                </div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                {
                "symbol": "OANDA:XAUUSD",
                "width": "990",
                "height": "400",
                "locale": "en",
                "dateRange": "12M",
                "colorTheme": "light",
                "isTransparent": false,
                "autosize": false,
                "largeChartUrl": ""
                }
                </script>
            </div>

            <!-- Rima -->

            <div class="table-data">
                <div class="order">
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright">
                            <a href="https://id.tradingview.com/" rel="noopener nofollow" target="_blank"></a>
                        </div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                        {
                            "feedMode": "all_symbols",
                            "isTransparent": true,
                            "displayMode": "compact",
                            "width": "1000",
                            "height": "410",
                            "colorTheme": "light",
                            "locale": "id"
                        }
                        </script>
                    </div>

                    <!-- Rima -->

                    
                    <div class="head">
                        <h3>Cryptocurrency</h3>
                        <div class="search-and-filter">
                            <div class="search-container">
                                <input type="text" id="searchInput" placeholder="Search" class='bx bx-search'>
                            </div>
                            <div class="filter-container">
                                <select id="filterSelect">
                                    <option value="all">All</option>
                                    <option value="top10">Top 10</option>
                                    <option value="top50">Top 50</option>
                                    <option value="top100">Top 100</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    

                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th></th>
                                <th>Symbol</th>
                                <th>Price</th>
                                <th>1h %</th>
                                <th>1d %</th>
                                <th>1w %</th>
                            </tr>
                        </thead>
                        <tbody id="coinTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
        <!-- END MAIN -->
    </section>

    <!-- JavaScript -->
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
        const apiKey = '12f177e0-4acc-404f-907a-eae5b7db67fd'; // Replace with your API key
        const globalMetricsUrl = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
        const cryptoDataUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        const cryptoInfoUrl = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';

        // API Global Metrics Data (Dini)
        fetch(globalMetricsUrl, {
            headers: {
                'X-CMC_PRO_API_KEY': apiKey
            }
        })
        .then(response => response.json())
        .then(data => {
            const metrics = data.data;
            const marketCap = metrics.quote.USD.total_market_cap;
            const dominanceBTC = metrics.btc_dominance;
            const dominanceETH = metrics.eth_dominance;

            const marketCapIDR = marketCap * 14000; // Assuming 1 USD = 14,000 IDR
            let marketCapFormatted = marketCapIDR.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0 
        });

        if (marketCapIDR > 99999) {
            marketCapFormatted = marketCapFormatted.substring(0, 13) + '..';
        }

        document.getElementById('totalMarketCap').textContent = marketCapFormatted;
                document.getElementById('btcDominance').textContent = dominanceBTC.toFixed(2) + '%';
                document.getElementById('ethDominance').textContent = dominanceETH.toFixed(2) + '%';
            })
            .catch(error => console.error('Error fetching global metrics:', error));

    // API cryptocurrency data (Selmy)
    fetchCryptoData();
    });

    function fetchCryptoData() {
        const apiKey = '12f177e0-4acc-404f-907a-eae5b7db67fd'; 
        const cryptoDataUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        const cryptoInfoUrl = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';
        const parameters = {
            start: '1',
            limit: '100', 
            convert: 'IDR'
        };

        const qs = new URLSearchParams(parameters).toString();
        const requestUrl = `${cryptoDataUrl}?${qs}`;

        fetch(requestUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CMC_PRO_API_KEY': apiKey
            }
        })
        .then(response => response.json())
        .then(data => {
            const coinTableBody = document.getElementById('coinTableBody');
            coinTableBody.innerHTML = ''; // Clear existing table data

            const coinIds = data.data.map(coin => coin.id).join(',');

            fetch(`${cryptoInfoUrl}?id=${coinIds}`, {
                headers: {
                    'X-CMC_PRO_API_KEY': apiKey
                }
            })
            .then(response => response.json())
            .then(infoData => {
                data.data.forEach((coin, index) => {
                    const coinInfo = infoData.data[coin.id];
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${index + 1}</td>
                    <td><a href="detail.php?id=${coin.id}">${coin.name}</a></td>
                <td class="logo-column"><img src="${coinInfo.logo}" alt="${coin.name}"></td>
                <td>${coin.symbol}</td> 
                <td>${parseFloat(coin.quote.IDR.price).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</td>
                <td>${parseFloat(coin.quote.IDR.percent_change_1h).toFixed(2)}%</td>
                <td>${parseFloat(coin.quote.IDR.percent_change_24h).toFixed(2)}%</td>
                <td>${parseFloat(coin.quote.IDR.percent_change_7d).toFixed(2)}%</td>
            `;
            coinTableBody.appendChild(row);
                        
                });
            })
            .catch(error => console.error('Error fetching cryptocurrency info:', error));
        })
        .catch(error => console.error('Error fetching cryptocurrency data:', error));
    }
            document.addEventListener('DOMContentLoaded', function() {
        fetchNews();

        
    });

    
    //API Tanggal (Dini)
    
    const apiKey = '6PXQOZE4AY89'; 
        const timezoneApiUrl = `http://api.timezonedb.com/v2.1/get-time-zone?key=${apiKey}&format=json&by=zone&zone=Asia/Jakarta`;

        fetch(timezoneApiUrl)
            .then(response => response.json())
            .then(data => {
                const timezoneInfo = document.getElementById('timezoneInfo');
                timezoneInfo.innerHTML = `
                    <h3>Timezone Information</h3>
                    <p>Timezone Name: ${data.zoneName}</p>
                    <p>GMT Offset: ${data.gmtOffset}</p>
                    <p>Timezone Abbreviation: ${data.abbreviation}</p>
                `;
            })
            .catch(error => console.error('Error fetching timezone information:', error));
            
    //Sorting
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');

    searchInput.addEventListener('input', handleSearch);
    filterSelect.addEventListener('change', handleFilter);

    function handleSearch() {
        const query = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#coinTableBody tr');
        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(query) ? '' : 'none';
        });
    }

    function handleFilter() {
        const filterValue = filterSelect.value;
        const rows = document.querySelectorAll('#coinTableBody tr');
        rows.forEach((row, index) => {
            if (filterValue === 'all') {
                row.style.display = '';
            } else if (filterValue === 'top10' && index < 10) {
                row.style.display = '';
            } else if (filterValue === 'top50' && index < 50) {
                row.style.display = '';
            } else if (filterValue === 'top100' && index < 100) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }  
            
            </script>
            
            <!-- END JavaScript -->
    <script src="script.js"></script>
    <!-- END External JavaScript -->
</body>
</html>
