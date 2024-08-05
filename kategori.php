<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Categories</title>
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
            <li>
                <a href="pantau.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Monitor</span>
                </a>
            </li>
            <li class="active">
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
                    <h1>Categories</h1>
                    <ul class="breadcrumb"></ul>
                </div>
            </div>

            <div id="weatherInfo">
        <!-- Informasi cuaca akan ditampilkan di sini oleh JavaScript -->

                <p>Loading...</p>
            </div>


            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Orders</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search for categories.." title="Type in a category">
                        <i class='bx bx-search'></i>
                        <div id="suggestions" class="suggestions"></div>
                    </div>
                    <div class="selected-items" id="selectedItems"></div>
                    
                    
                  
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Avg. Price Change</th>
                                
                                <th>Market Cap</th>
                                
                                <th>Volume</th>
                                <th>Gainers / Losers Number</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody"></tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>

    <script>


/// API Kategori (Rima)
        const url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/categories';
        const headers = {
            Accept: 'application/json',
            'X-CMC_PRO_API_KEY': 'f09f5424-8c7b-44e1-823d-9790a031c8ae'
        };
        let categoryData = [];

        fetch(url, {
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
            categoryData = data.data;
            populateTable(categoryData);
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
        });

        function populateTable(data) {
            const categoryTableBody = document.getElementById('categoryTableBody');
            categoryTableBody.innerHTML = '';
            data.forEach(category => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${category.name}</td>
                    <td>${category.avg_price_change.toFixed(2)}%</td>
                    <td>${category.market_cap.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</td>
                    <td>${category.volume.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</td>
                    <td>${category.num_tokens} Tokens</td> <!-- Assuming 'num_tokens' as the count of tokens -->
                `;
                categoryTableBody.appendChild(row);
            });
        }
 /// Rima
document.getElementById('searchInput').addEventListener('input', function() {
    const input = this.value.toLowerCase();
    const suggestions = document.getElementById('suggestions');
    suggestions.innerHTML = '';
    if (input) {
        const filteredCategories = categoryData.filter(category => category.name.toLowerCase().includes(input));
        filteredCategories.forEach(category => {
            const suggestionItem = document.createElement('div');
            suggestionItem.textContent = category.name;
            suggestionItem.classList.add('suggestion-item');
            suggestionItem.addEventListener('click', function() {
                addSelectedItem(category.name);
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
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'monitor.php';

        selectedNames.forEach(name => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selectedNames[]';
            input.value = name;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    } else {
        alert("Please select at least one item to monitor.");
    }
});

const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i=> {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

</script>

