1. Download aplikasi local server yang mendukung PHP versi 8.1 seperti [XAMPP](https://www.apachefriends.org/download.html) atau [WAMP Server](https://www.wampserver.com/en/download-wampserver-64bits/) untuk sistem operasi Windows.
2. Download dan install [Composer](https://getcomposer.org/Composer-Setup.exe).
3. Download dan install [Node JS](https://nodejs.org/en/download/).
4. Restart komputer.
5. Jalankan aplikasi **XAMPP Control Panel**, klik tombol `RUN` untuk Apache dan MySQL.
6. Download dan install [Visual Studio Code](https://code.visualstudio.com/Download).
7. Download dan ekstrak project ini pada drive D komputer, rename folder hasil ekstrak menjadi `spk-moora`.
8. Jalankan aplikasi **Visual Studio Code**, pilih menu `File` -> `Open Folder` lalu pilih folder `spk-moora` hasil tahap sebelumnya.
9. Pilih menu `Terminal` -> `New Terminal` pada aplikasi **Visual Studio Code** lalu ketik perintah berikut satu-persatu untuk melakukan instalasi paket-paket yang dibutuhkan:

```
composer install
npm install
npm run build
```

10. Buka **Google Chrome**, ketikkan alamat [http://localhost/phpmyadmin](http://localhost/phpmyadmin) lalu buat database baru dengan nama `spk-moora`.
11. Buka kembali aplikasi **Visual Studio Code**. Ubah nama (_rename_) file `.env.example` menjadi `.env` lalu edit bagian database seperti berikut:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="spk-moora"
DB_USERNAME=root
DB_PASSWORD=
```

12. Ketik perintah berikut satu-persatu pada terminal **Visual Studio Code** untuk membuat app key, melakukan migrasi tabel menuju database, dan menjalankan local server:

```
php artisan key:generate
php artisan migrate
php artisan serve
```

13. Ketik alamat url ([http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)) pada web browser **Google Chrome** untuk melihat melakukan registrasi akun admin.

## Framework

Aplikasi ini dibangun menggunakan framework PHP [Laravel](https://laravel.com).

## License

Aplikasi ini berlisensi "open-sourced software" dibawah [MIT license](https://opensource.org/licenses/MIT).