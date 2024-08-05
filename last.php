<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .news-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .news-item h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
        }
        .news-item p {
            color: #666;
        }
        .news-item a {
            color: #007bff;
            text-decoration: none;
        }
        .news-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Latest Crypto News</h1>
        <form id="cryptoForm">
            <label for="cryptoName">Enter Crypto Name:</label>
            <input type="text" id="cryptoName" name="cryptoName">
            <button type="submit">Search</button>
        </form>
        <div id="news"></div>
    </div>

    <script>
        // Fungsi untuk mengambil dan menampilkan berita tentang kripto yang dimasukkan pengguna
        async function fetchCryptoNews(cryptoName) {
            const url = 'https://newsapi.org/v2/everything';
            const apiKey = '7333597aade5434dbf36ed9a9a9c9b48'; // Ganti dengan API key Anda
            const query = cryptoName;
            const fromDate = '2024-05-05';
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

        // Fungsi untuk menampilkan berita di halaman web
        function displayCryptoNews(articles) {
            const newsContainer = document.getElementById('news');
            // Bersihkan konten sebelum menampilkan berita baru
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

        // Tangani penyerahan formulir untuk mencari berita kripto
        document.getElementById('cryptoForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir
            const cryptoName = document.getElementById('cryptoName').value.trim();
            if (cryptoName) {
                fetchCryptoNews(cryptoName);
            } else {
                alert('Please enter a crypto name.');
            }
        });
    </script>
</body>
</html>
