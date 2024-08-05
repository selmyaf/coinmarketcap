<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pabw</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- TradingView Widget CSS -->
    <link rel="stylesheet" type="text/css" href="https://s3.tradingview.com/external-embedding/embed-widget-timeline.css">
    <style>
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
    </style>
</head>
<body>
    <!-- SIDEBAR -->
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
            <li>
                <a href="kategori.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Categories</span>
                </a>
            </li>
            <li class="active">
                <a href="portofolio.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Portofolio</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
        <main class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-4">
                        <h2 class="mb-4">Transaction Summary</h2>
                        
                        
                        <div class="total-rp">
                            <i class='bx bxs-dollar-circle'></i>
                            <span class="text">
                                <h3 id="totalValue">0</h3>
                                <p>RP</p>
                            </span>
                        </div>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Avg (RP.)</th>
                                    <th>Quantity</th>
                                    <th>Total (RP.)</th
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="transactionTableBody">
                                <!-- Transaction rows will be added here -->
                            </tbody>
                        </table>
                        
                        <div class="text-end">
                            <a href="add_transaction.php" class="btn btn-primary">Add Transaction</a>
                            <a href="monpor.php" class="btn btn-success mr-2">Monitoring</a>
                        </div>

                        <div id="chartContainer" style="height: 300px;"></div>

                    </div>
                </div>
            </div>
        </main>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const transactionTableBody = document.getElementById('transactionTableBody');
            const totalValueElement = document.getElementById('totalValue');

            // Get transactions from local storage
            let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

            function updateTransactionTable() {
                // Clear the table body
                transactionTableBody.innerHTML = '';
                let totalValue = 0;

                transactions.forEach((transaction, index) => {
                    const row = document.createElement('tr');
                    const total = transaction.quantity * transaction.pricePerCoin;
                    totalValue += total;

                    row.innerHTML = `
                        <td>${transaction.name}</td>
                        <td>RP. ${transaction.pricePerCoin.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</td>
                        <td>${transaction.quantity.toLocaleString('id-ID')}</td>
                        <td>RP. ${total.toLocaleString('id-ID', { minimumFractionDigits: 2 })}</td>
                        <td><button class="btn btn-danger" onclick="deleteTransaction(${index})">Delete</button></td>
                    `;

                    transactionTableBody.appendChild(row);

                    // Append TradingView widget for each transaction
                    appendTradingViewWidget(transaction.symbol);
                });

                totalValueElement.textContent = totalValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

            }

            function deleteTransaction(index) {
                // Remove the transaction at the specified index
                transactions.splice(index, 1);
                // Update the local storage
                localStorage.setItem('transactions', JSON.stringify(transactions));
                // Recalculate and update the table
                updateTransactionTable();
            }

            window.deleteTransaction = deleteTransaction;

            // Function to append TradingView widget for each transaction
            async function appendTradingViewWidget(symbol) {
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
                    "symbol": symbol,
                    "width": 350,
                    "height": 220,
                    "locale": "en",
                    "dateRange": "12M",
                    "colorTheme": "light",
                    "isTransparent": false,
                    "autosize": false,
                    "largeChartUrl": ""
                };
                script.innerHTML = JSON.stringify(json);
                container.appendChild(script);

                transactionTableBody.appendChild(container);
            }

            // Initialize the transaction table
            updateTransactionTable();
        });
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
