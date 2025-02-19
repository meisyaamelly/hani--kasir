<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Produk</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: rgba(184, 212, 253, 0.767);
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 20px;
        background: rgb(255, 255, 255);
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        position: relative;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .product-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Maksimal 4 produk per baris */
    gap: 20px;
    position: relative;
    z-index: 1;
}


    .card {
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        align-items: center;
        padding: 15px;
        flex-direction: row;
        position: relative;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .card .details {
        margin-left: 15px;
        flex-grow: 1;
    }

    .card h4 {
        font-size: 18px;
        color: #34495e;
        margin: 0 0 5px;
    }

    .card p {
        font-size: 16px;
        color: #27ae60;
        font-weight: 500;
        margin: 0 0 10px;
    }


    .card p.category {
        margin-top: -1px;
        font-size: 12px !important;
        color: #888 !important;
    }

    .card p.stock {
        font-size: 15px !important;
        color: #888 !important;
        position: absolute;
        top: 10px;
        right: 10px;
    }



    /* Tombol Pesan dan Kuantitas */
    .quantity-btn {
        display: none;
        /* Default: sembunyikan tombol kuantitas */
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .quantity-btn button {
        background: #6376ac;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .quantity-btn button:hover {
        background: rgb(40, 98, 136);
    }

    .order-btn {
        background: #27ae60;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .order-btn:hover {
        background: #1e8449;
    }

    .cart-footer {
        z-index: 1000;
        border-radius: 20px;
        display: none;
        position: fixed;
        bottom: 0;
        left: 30%;
        margin-bottom: 20px;
        transform: translateX(-50%);
        background: rgb(42, 141, 65);
        color: white;
        padding: 15px 20px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, opacity 0.3s ease;
        transform: translateY(100%);
        opacity: 0;
        justify-content: space-between;
        align-items: center;
    }

    .cart-footer.show {
        transform: translateY(0);
        opacity: 1;
        display: flex;
    }

    .cart-footer span {
        font-weight: 600;
        font-size: 16px;
    }

    .cart-footer span:first-child {
        flex: 1;
    }

    .cart-footer:hover {
        background: rgb(34, 84, 52);
        cursor: pointer;
    }


    /* Tampilan Modal */
    .modal {
        display: none;
        /* Default: sembunyikan modal */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        width: 90%;
        max-width: 800px;
        border-radius: 10px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        position: relative;
        animation: fadeIn 0.3s ease;
    }


    .modal-cart,
    .modal-payment {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-cart h3,
    .modal-payment h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .modal-cart table {
        width: 100%;
        border-collapse: collapse;
    }

    .modal-cart th,
    .modal-cart td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
    }

    .modal-cart th {
        background: #eaeaea;
        font-weight: 600;
    }

    .modal-payment .summary {
        margin-top: 15px;
    }

    .modal-payment label {
        font-size: 14px;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    .modal-payment input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .modal-payment .error {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    .modal-payment .change {
        color: green;
        font-size: 14px;
        margin-top: 5px;
    }

    .modal-payment button {
        background: #27ae60;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .modal-payment button:hover {
        background: #1e8449;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* button pembayaran*/

    button {
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 16px;
    }

    /* Tombol Tutup */
    .btn-close {
        background: #e74c3c;
        color: white;
    }

    .btn-close:hover {
        transform: translateY(-3px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Tombol Bayar Sekarang */
    .btn-pay {
        background: #749cf1;
        color: white;
        margin-left: 10px;
    }

    .btn-pay:hover {
        transform: translateY(-3px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .search-bar {
        display: flex;
        gap: 10px;
    }

    .search-bar input {
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .filter-btn {
        background: rgb(96, 134, 236);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .filter-btn:hover {
        background: #671e84;
    }

    </style>
</head>

<body>
<div class="container">
        <div class="header-bar">
            <h2>Order Produk</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari produk..." onkeyup="searchProduct()">
                <button class="filter-btn" onclick="filterProducts('all')">All</button>
                <button class="filter-btn" onclick="filterProducts('Makanan')">Makanan</button>
                <button class="filter-btn" onclick="filterProducts('Minuman')">Minuman</button>
            </div>
        </div>
        <div class="product-list" id="productList">
            @foreach ($produk as $p)
            <div class="card product-item" id="product-{{ $p->ProdukID }}" data-category="{{ $p->Kategori }}">
                <img src="{{ asset($p->image) }}" alt="Gambar Produk">
                <div class="details">
                    <h4>{{ $p->NamaProduk }}</h4>
                    <p class="category">{{ $p->Kategori }}</p>
                    <p>Rp {{ number_format($p->Harga, 0, ',', '.') }}</p>
                    <div class="quantity-btn" id="cart-btn-{{ $p->ProdukID }}">
                        <button onclick="decreaseQuantity({{ $p->ProdukID }})">-</button>
                        <span id="quantity-{{ $p->ProdukID }}">0</span>
                        <button onclick="increaseQuantity({{ $p->ProdukID }})">+</button>
                    </div>
                    <button class="order-btn" id="order-btn-{{ $p->ProdukID }}" onclick="increaseQuantity({{ $p->ProdukID }})">Pesan</button>
                </div>
                <p class="stock">Stok: {{ $p->Stok }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="cart-footer" onclick="showCartModal()">
        <span id="cart-items">0 items</span>
        <span id="cart-total">Rp 0</span>
    </div>

    <!-- Modal untuk Cart -->
    <div id="cartModal" class="modal">
    <div class="modal-content">
        <div class="modal-cart">
            <h3>Keranjang Belanja</h3>
            <div id="cartDetails"></div>
            <div class="cart-total">
                <h3>Total Keseluruhan: <span id="total-price">50000</span></h3>
            </div>  
            <div class="payment-input">
                <label for="paymentAmount">Nominal Pembayaran:</label>
                <input type="text" id="paymentAmount" placeholder="Masukkan jumlah pembayaran"
                    style="width: 100%; padding: 10px; margin-top: 5px;" oninput="formatCurrency(this)">
            </div>
            <div id="paymentError" style="color: red; display: none;">Nominal pembayaran tidak cukup!</div>
            <div id="paymentChange" style="color: rgb(0, 87, 128); display: none;">Kembalian: <span id="changeAmount">0</span></div>
            <div style="text-align: right; margin-top: 20px;">
                <button onclick="closeCartModal()" style="background: #c0392b; color: white;">Tutup</button>
                <button id="bayarSekarangBtn" style="background: #2771ae; color: white;">Bayar Sekarang</button>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];

// Saat halaman dimuat, ambil data dari localStorage
window.onload = function() {
    const savedCart = localStorage.getItem('cart');
    document.getElementById('cartModal').style.display = 'none';
    if (savedCart) {
        cart = JSON.parse(savedCart);
        cart.forEach(item => {
            updateCartButton(item.ProdukID);
            toggleQuantity(item.ProdukID);
        });
        updateCartFooter();
    }
};

// Tambah kuantitas produk
function increaseQuantity(ProdukID) {
    let product = cart.find(item => item.ProdukID === ProdukID);
    if (product) {
        product.JumlahProduk += 1;
    } else {
        cart.push({ ProdukID, JumlahProduk: 1 });
    }
    updateCartFooter();
    updateCartButton(ProdukID);
    toggleQuantity(ProdukID); // Memastikan tombol quantity atau pesan ditampilkan
}

// Kurangi kuantitas produk
function decreaseQuantity(ProdukID) {
    let product = cart.find(item => item.ProdukID === ProdukID);
    if (product) {
        product.JumlahProduk -= 1;

        // Jika kuantitas produk mencapai 0, hapus produk dari keranjang
        if (product.JumlahProduk <= 0) {
            cart = cart.filter(item => item.ProdukID !== ProdukID);
            resetProductDisplay(ProdukID);
        }
        
        // Perbarui tampilan keranjang dan tombol quantity
        updateCartFooter();
        updateCartButton(ProdukID);
        toggleQuantity(ProdukID);  // Perbarui tampilan tombol setelah perubahan
    }
}

// Tampilkan tombol quantity atau order
function toggleQuantity(ProdukID) {
    const quantityDiv = document.getElementById(`cart-btn-${ProdukID}`);
    const orderBtn = document.getElementById(`order-btn-${ProdukID}`);
    const product = cart.find(item => item.ProdukID === ProdukID);

    // Jika produk ada dan kuantitas lebih besar dari 0, tampilkan tombol quantity
    if (product && product.JumlahProduk > 0) {
        quantityDiv.style.display = 'flex'; // Tombol quantity muncul
        orderBtn.style.display = 'none';    // Tombol pesan disembunyikan
    } else {
        quantityDiv.style.display = 'none'; // Tombol quantity disembunyikan
        orderBtn.style.display = 'block';   // Tombol pesan muncul
    }
}

// Update tampilan tombol quantity
function updateCartButton(ProdukID) {
    const product = cart.find(item => item.ProdukID === ProdukID);
    const button = document.getElementById(`quantity-${ProdukID}`);

    // Update tombol quantity jika produk ada
    if (product) {
        button.innerText = product.JumlahProduk;
    } else {
        button.innerText = 0; // Jika produk sudah tidak ada, tampilkan 0
    }
}

// Perbarui footer keranjang
function updateCartFooter() {
    let totalItems = cart.reduce((sum, item) => sum + item.JumlahProduk, 0);
    let totalPrice = cart.reduce((sum, item) => sum + (item.JumlahProduk * findProductById(item.ProdukID).Harga), 0);

    document.getElementById('cart-items').innerText = `${totalItems} items`;
    document.getElementById('cart-total').innerText = `Rp ${totalPrice.toLocaleString()}`;

    const cartFooter = document.querySelector('.cart-footer');
    if (totalItems > 0) {
        cartFooter.classList.add('show');
    } else {
        cartFooter.classList.remove('show');
    }

    localStorage.setItem('cart', JSON.stringify(cart)); // Simpan cart ke localStorage
}

// Reset tampilan produk jika dihapus dari keranjang
function resetProductDisplay(ProdukID) {
    // Menghilangkan tombol quantity dan menampilkan tombol pesan kembali
    const quantityDiv = document.getElementById(`cart-btn-${ProdukID}`);
    const orderBtn = document.getElementById(`order-btn-${ProdukID}`);

    quantityDiv.style.display = 'none';
    orderBtn.style.display = 'block';
}


// Tampilkan modal keranjang
function showCartModal() {
    const cartDetails = document.getElementById('cartDetails');
    cartDetails.innerHTML = '';

    if (cart.length === 0) {
        cartDetails.innerHTML = '<p>Keranjang belanja kosong.</p>';
    } else {
        let modalContent = '<table style="width: 100%; border-collapse: collapse;">';
        modalContent += `
            <tr>
                <th style="text-align: left; padding: 10px;">Nama Produk</th>
                <th style="text-align: center; padding: 10px;">Harga</th>
                <th style="text-align: center; padding: 10px;">Jumlah</th>
                <th style="text-align: right; padding: 10px;">Subtotal</th>
            </tr>
        `;
        cart.forEach(item => {
            const product = findProductById(item.ProdukID);
            const subtotal = item.JumlahProduk * product.Harga;
            modalContent += `
                <tr>
                    <td style="padding: 10px;">${product.NamaProduk}</td>
                    <td style="text-align: center; padding: 10px;">Rp ${product.Harga.toLocaleString()}</td>
                    <td style="text-align: center; padding: 10px;">${item.JumlahProduk}</td>
                    <td style="text-align: right; padding: 10px;">Rp ${subtotal.toLocaleString()}</td>
                </tr>
            `;
        });

        modalContent += '</table>';
        cartDetails.innerHTML = modalContent;
    }

    calculateTotal();
    document.getElementById('cartModal').style.display = 'flex';
}

// Tutup modal keranjang
function closeCartModal() {
    document.getElementById('cartModal').style.display = 'none';
}

// Hitung total keseluruhan
function calculateTotal() {
    let total = cart.reduce((sum, item) => {
        const product = findProductById(item.ProdukID);
        return sum + (item.JumlahProduk * product.Harga);
    }, 0);

    document.getElementById('total-price').innerText = `Rp ${total.toLocaleString()}`;
    return total;
}

// Cari produk berdasarkan ID
function findProductById(ProdukID) {
    return @json($produk).find(product => product.ProdukID === ProdukID);
}

// Proses pembayaran
$(document).ready(function () {
    // Menambahkan event listener untuk input pembayaran
    $('#paymentAmount').on('input', function () {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalHarga = cart.reduce((total, item) => total + (item.JumlahProduk * findProductById(item.ProdukID).Harga), 0);
        let paymentAmount = parseInt($('#paymentAmount').val().replace(/[^\d]/g, '')) || 0;

        let nominalKurang = totalHarga - paymentAmount;
        let kembalian = paymentAmount - totalHarga;

        // Menampilkan nominal kurang
        if (nominalKurang > 0) {
            $('#paymentError').show();
            $('#paymentError').text(`Nominal pembayaran kurang: Rp ${nominalKurang.toLocaleString()}`);
            $('#paymentChange').hide();
        } else {
            $('#paymentError').hide();
        }

        // Menampilkan kembalian jika pembayaran lebih
        if (kembalian > 0) {
            $('#paymentChange').show();
            $('#paymentChange').html(`Kembalian: Rp ${kembalian.toLocaleString()}`);
        } else {
            $('#paymentChange').hide();
        }
    });

    $('#bayarSekarangBtn').on('click', function () {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalHarga = cart.reduce((total, item) => total + (item.JumlahProduk * findProductById(item.ProdukID).Harga), 0);
        let paymentAmount = parseInt($('#paymentAmount').val().replace(/[^\d]/g, '')) || 0;

        if (isNaN(paymentAmount) || paymentAmount < totalHarga) {
            alert('Nominal pembayaran tidak cukup.');
            return;
        }
        
        // Kirim data penjualan ke server menggunakan AJAX
        $.ajax({
            url: "{{ route('order.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                PelangganID: {{ $idPelanggan }},  // Menggunakan ID pelanggan dari controller
                TotalHarga: totalHarga,
                NominalPembayaran: paymentAmount,
                Cart: JSON.stringify(cart)  // Ubah cart menjadi JSON string untuk dikirim
            },
            success: function (response) {
                alert('Data penjualan berhasil disimpan!');
                localStorage.removeItem('cart');
                window.location.href = "/struk/" + response.penjualanID;
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Debugging: tampilkan pesan error di console
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    });

    function findProductById(ProdukID) {
        return @json($produk).find(product => product.ProdukID === ProdukID);
    }
});

// Fungsi untuk memformat input menjadi format Rp secara live
function formatCurrency(input) {
    let value = input.value.replace(/[^\d]/g, ''); // Hapus karakter non-digit
    if (value) {
        value = 'Rp ' + value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'); // Format menjadi Rp xxx,xxx
    }
    input.value = value;
}

function searchProduct() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let products = document.getElementsByClassName("product-item");
            
            for (let i = 0; i < products.length; i++) {
                let name = products[i].getElementsByTagName("h4")[0].innerText.toLowerCase();
                products[i].style.display = name.includes(input) ? "flex" : "none";
            }
        }
        
        function filterProducts(category) {
            let products = document.getElementsByClassName("product-item");
            
            for (let i = 0; i < products.length; i++) {
                let productCategory = products[i].getAttribute("data-category");
                
                if (category === 'all' || productCategory === category) {
                    products[i].style.display = "flex";
                } else {
                    products[i].style.display = "none";
                }
            }
        }
</script>

</body>

</html>