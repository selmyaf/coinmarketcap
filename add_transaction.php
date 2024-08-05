<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .crypto-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        .dropdown-container {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 400px;">
            <h2 class="mb-4">Add Transaction</h2>
            <form id="transactionForm">
                <div id="cryptoSelectContainer" class="mb-3">
                    <label for="cryptoCurrency" class="form-label">Cryptocurrency</label>
                    <div class="dropdown-container">
                        <img id="cryptoLogo" class="crypto-logo" src="" alt="Crypto Logo">
                        <select id="cryptoCurrency" name="cryptoCurrency" class="form-select">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="0.00" required>
                </div>

                <div class="mb-3">
                    <label for="pricePerCoin" class="form-label">Price Per Coin (IDR)</label>
                    <input type="text" id="pricePerCoin" name="pricePerCoin" class="form-control" placeholder="0.00" readonly>
                </div>

                <input type="hidden" id="cryptoName" name="cryptoName">
                <input type="hidden" id="cryptoSymbol" name="cryptoSymbol">

                <button type="submit" id="addTransactionBtn" class="btn btn-primary w-100">Add Transaction</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apiKey = '12f177e0-4acc-404f-907a-eae5b7db67fd';
            const cryptoDataUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
            const cryptoInfoUrl = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';
            const usdToIdrRate = 15000; // Example conversion rate, you should fetch the latest rate

            const cryptoCurrencySelect = document.getElementById('cryptoCurrency');
            const pricePerCoinInput = document.getElementById('pricePerCoin');
            const cryptoLogo = document.getElementById('cryptoLogo');
            const cryptoNameInput = document.getElementById('cryptoName');
            const cryptoSymbolInput = document.getElementById('cryptoSymbol');
            const transactionForm = document.getElementById('transactionForm');

            // Fetch cryptocurrency data and populate select options
            fetch(cryptoDataUrl, {
                method: 'GET',
                headers: {
                    'X-CMC_PRO_API_KEY': apiKey
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.data) {
                    data.data.forEach(crypto => {
                        const option = document.createElement('option');
                        option.value = crypto.id;
                        option.textContent = `${crypto.name} (${crypto.symbol})`;
                        option.dataset.symbol = crypto.symbol;
                        option.dataset.name = crypto.name;
                        cryptoCurrencySelect.appendChild(option);
                    });

                    // Trigger change event to set initial price and logo
                    cryptoCurrencySelect.dispatchEvent(new Event('change'));
                }
            })
            .catch(error => console.error('Error fetching cryptocurrency data:', error));
            

            cryptoCurrencySelect.addEventListener('change', function() {
                const selectedCryptoId = this.value;
                const selectedOption = this.options[this.selectedIndex];

                fetch(cryptoDataUrl, {
                    method: 'GET',
                    headers: {
                        'X-CMC_PRO_API_KEY': apiKey
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const selectedCrypto = data.data.find(crypto => crypto.id == selectedCryptoId);
                    if (selectedCrypto) {
                        const priceInUSD = selectedCrypto.quote.USD.price;
                        const priceInIDR = priceInUSD * usdToIdrRate;
                        pricePerCoinInput.value = priceInIDR.toFixed(2);

                        // Update hidden inputs for crypto name and symbol
                        cryptoNameInput.value = selectedOption.dataset.name;
                        cryptoSymbolInput.value = selectedOption.dataset.symbol;
                    } else {
                        pricePerCoinInput.value = '0.00';
                    }
                })
                .catch(error => console.error('Error fetching cryptocurrency price:', error));

                fetch(`${cryptoInfoUrl}?id=${selectedCryptoId}`, {
                    method: 'GET',
                    headers: {
                        'X-CMC_PRO_API_KEY': apiKey
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const cryptoInfo = data.data[selectedCryptoId];
                    if (cryptoInfo) {
                        cryptoLogo.src = cryptoInfo.logo;
                    } else {
                        cryptoLogo.src = '';
                    }
                })
                .catch(error => console.error('Error fetching cryptocurrency info:', error));
            });

            // Handle form submission
            transactionForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const transaction = {
                    cryptoId: cryptoCurrencySelect.value,
                    name: cryptoNameInput.value,
                    symbol: cryptoSymbolInput.value,
                    quantity: parseFloat(document.getElementById('quantity').value),
                    pricePerCoin: parseFloat(pricePerCoinInput.value)
                };

                // Get existing transactions from local storage
                let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

                // Add new transaction
                transactions.push(transaction);

                // Save back to local storage
                localStorage.setItem('transactions', JSON.stringify(transactions));

                // Redirect to portfolio page (portofolio.php)
                window.location.href = 'portofolio.php';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
