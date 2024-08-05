<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminHub</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .search-container {
            margin-bottom: 20px;
            position: relative;
            width: 300px;
        }
        #searchInput {
            width: 100%;
            padding: 10px 35px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .search-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .suggestions {
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
            position: absolute;
            width: 100%;
            z-index: 1;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
        .selected-items {
            margin-top: 10px;
        }
        .selected-item {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f1f1f1;
            margin-right: 5px;
            margin-bottom: 5px;
            border-radius: 4px;
        }
        .selected-item .close {
            margin-left: 5px;
            color: red;
            cursor: pointer;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            touch-action: manipulation;
            cursor: pointer;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .tradingview-widget-container {
            height: 600px;
            width: 100%;
            margin-top: 20px;
        }
        .tradingview-widget-container__widget {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<section id="sidebar">
    <ul class="side-menu top">
        <li>
            <a href="index.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
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
        <li>
                <a href="portofolio.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Portofolio</span>
                </a>
            </li>
    </ul>
</section>

<section id="content">
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Monitor</h1>
                <ul class="breadcrumb"></ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search for names.." title="Type in a name">
                    <i class='bx bx-search'></i>
                    <div id="suggestions" class="suggestions"></div>
                </div>
                <div class="selected-items" id="selectedItems"></div>
                <button id="monitorBtn" class="btn btn-primary mb-3">Monitor</button>
                <br><br>

                <table>
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>1h %</th>
                            <th>1d %</th>
                            <th>1w %</th>
                        </tr>
                    </thead>
                    <tbody id="coinTableBody"></tbody>
                </table>
            </div>
        </div>
    </main>
</section>

<script>
    const url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    const parameters = {
        start: '1',
        limit: '100',
        convert: 'IDR'
    };

    const headers = {
        Accept: 'application/json',
        'X-CMC_PRO_API_KEY': 'f09f5424-8c7b-44e1-823d-9790a031c8ae'
    };

    const qs = new URLSearchParams(parameters).toString();
    const requestUrl = `${url}?${qs}`;

    let coinData = [];

    fetch(requestUrl, {
        method: 'GET',
        headers: headers
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        coinData = data.data;
        populateTable(coinData);
    })
    .catch(error => {
        console.error('Error fetching data: ', error);
    });

    function populateTable(data) {
    const coinTableBody = document.getElementById('coinTableBody');
    coinTableBody.innerHTML = '';
    data.forEach((coin, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${coin.name}</td>
            <td>${coin.symbol}</td> 
            <td>${parseFloat(coin.quote.IDR.price).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</td>
            <td>${parseFloat(coin.quote.IDR.percent_change_1h).toFixed(2)}%</td>
            <td>${parseFloat(coin.quote.IDR.percent_change_24h).toFixed(2)}%</td>
            <td>${parseFloat(coin.quote.IDR.percent_change_7d).toFixed(2)}%</td>
        `;
        coinTableBody.appendChild(row);
    });
}


document.getElementById('searchInput').addEventListener('input', function() {
    const input = this.value.toLowerCase();
    const suggestions = document.getElementById('suggestions');
    suggestions.innerHTML = '';
    if (input) {
        const filteredCoins = coinData.filter(coin => 
            coin.name.toLowerCase().includes(input) || coin.symbol.toLowerCase().includes(input)
        );
        filteredCoins.forEach(coin => {
            const suggestionItem = document.createElement('div');
            suggestionItem.textContent = `${coin.name} (${coin.symbol})`; 
            suggestionItem.classList.add('suggestion-item');
            suggestionItem.addEventListener('click', function() {
                addSelectedItem(coin.name);
                document.getElementById('searchInput').value = '';
                suggestions.innerHTML = '';
            });
            suggestions.appendChild(suggestionItem);
        });
    }
});


    function addSelectedItem(name) {
        const selectedItems = document.getElementById('selectedItems');
        const selectedItem = document.createElement('div');
        selectedItem.textContent = name;
        selectedItem.classList.add('selected-item');

        const closeButton = document.createElement('span');
        closeButton.textContent = '×';
        closeButton.classList.add('close');
        closeButton.addEventListener('click', function() {
            selectedItems.removeChild(selectedItem);
        });

        selectedItem.appendChild(closeButton);
        selectedItems.appendChild(selectedItem);
    }

    document.getElementById('monitorBtn').addEventListener('click', function() {
        const selectedNames = [];
        document.querySelectorAll('#selectedItems .selected-item').forEach(item => {
            selectedNames.push(item.textContent.slice(0, -1)); // Remove the '×' character from the name
        });

        if (selectedNames.length > 0) {
            const queryParams = new URLSearchParams();
            selectedNames.forEach(name => {
                queryParams.append('coins[]', name);
            });
            window.location.href = `monitor.php?${queryParams.toString()}`;
        } else {
            alert("Please select at least one item to monitor.");
        }
    });

    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    allSideMenu.forEach(item => {
        const li = item.parentElement;
        item.addEventListener('click', function() {
            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            });
            li.classList.add('active');
        });
    });
    
</script>
</body>
</html>
