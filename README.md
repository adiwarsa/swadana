<h1 align="center">Selamat datang di Sistem Informasi Rental Kendaraan! 👋</h1>

## Apa itu Sistem Informasi Rental Kendaraan?

Web Sistem Informasi Rental Kendaraan yang dibuat oleh <a href="https://github.com/adiwarsa"> Adi Warsa </a>. **Sistem Informasi Rental Kendaraan adalah Website untuk mengelola rental kendaraan.**

## Fitur apa saja yang tersedia di Sistem Informasi Rental Kendaraan?

- Autentikasi Admin
- User & CRUD
- Mobil & CRUD
- Motor & CRUD
- Category & CRUD
- Vendor & CRUD
- Samsat & CRUD
- Whatsapp Notification & Telegram Notification
- Dan lain-lain

## Release Date

**Release date : Mar 2023**

> Sistem Informasi Rrental Kendaraan merupakan project skripsi yang dibuat oleh Adi Warsa. Kalian dapat download/fork/clone. Cukup beri stars di project ini agar memberiku semangat. Terima kasih!

---

## Default Account for testing

**Admin Default Account**

- email: admin@swadana.com
- Password: admin

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/adiwarsa/swadana.git
cd swadana
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

- Facebook : <a href="https://www.facebook.com/adi.limitha13/"> Adi Warsa</a>
- LinkedIn : <a href="https://www.linkedin.com/in/adiwarsa/"> Adi Warsa</a>

## Contributing

Contributions, issues and feature requests di persilahkan.
Jangan ragu untuk memeriksa halaman masalah jika Anda ingin berkontribusi. **Berhubung Project ini saya sudah selesaikan sendiri, namun banyak fitur yang kalian dapat tambahkan silahkan berkontribusi yaa!**

## License

- Copyright © 2022 Adi Warsa.
- **Sistem Informasi Rental Kendaraani licensed under the MIT license.**
