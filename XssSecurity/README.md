# Xss Security

## Deskripsi

XSS Security adalah library untuk mensanitasi dan memvalidasi parameter yang dikirimkan kepada API untuk memastikan parameter yang diterima dan disimpan ke DB merupakan parameter yang aman dan tidak mengandung script yang tidak diinginkan. XSS Security akan mensanitasi atau membersihkan input yang tidak sesuai dengan ketentuan setiap jenis datanya. Kemudian data yang sudah bersih dicek atau divalidasi apakah sesuai dengan syarat input berdasarkan tiap parameternya.

## Prasyarat

• PHP versi 7.3 keatas

## Instalasi

• Masuk ke project yang mau ditambahkan XSS Security

• Tambahkan file XssSecurity.php kedalam folder …/application/libraries/

• Tambahkan XssSecurity pada file …/application/config/autoload.php dan tambahkan JwtSecurity pada bagian libraries agar library dapat di load otomatis pada project.

```php
$autoload['libraries'] = array('database', "XssSecurity");
```

## Penggunaan

Panggil salah satu method/function
Sanitasi berfungsi untuk menghapus tags, script berbahaya dan karakter diluar ketentuan (sesuai jenis)
Input adalah data yang ingin di Sanitasi dan Validasi, (opsional) minlength, (opsional) maxlength
Output adalah data yang sudah di Sanitasi jika lolos validasi dan NULL jika tidak lolos

• Sanitasi dan Validasi String

Sanitasi menghapus karakter selain karakter berikut "A-Za-z0-9\_.+!\*\'(),{}|\\^~[\]`<>#%";\/?:@&=. -". Validasi mengecek apakah karakter, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // test
$xssSecurity = new XssSecurity();
$data = $xssSecurity->stringValidation($data) // (default) minlength = 4, maxlength = 30
```

```php
$data = $this->input->post('data'); // tester
$xssSecurity = new XssSecurity();
$data = $xssSecurity->stringValidation($data, 5, 10) // (opsional) minlength = 5, maxlength = 10
```

• Sanitasi dan Validasi Integer

Sanitasi menghapus karakter selain 0-9, ".", "-". Validasi mengecek apakah hanya berisi karakter 0-9, "-", dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 50
$xssSecurity = new XssSecurity();
$data = $xssSecurity->integerValidation($data) // (default) minlength = 1, maxlength = 20
```

```php
$data = $this->input->post('data'); // 12345
$xssSecurity = new XssSecurity();
$data = $xssSecurity->integerValidation($data, 5, 10) // (opsional) minlength = 5, maxlength = 10
```

• Sanitasi dan Validasi Float

Sanitasi menghapus karakter selain 0-9, ".", "-". Validasi berfungsi untuk mengecek apakah hanya berisi karakter 0-9 dan ".", "-", dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 5.5
$xssSecurity = new XssSecurity();
$data = $xssSecurity->floatValidation($data) // (default) minlength = 1, maxlength = 20
```

```php
$data = $this->input->post('data'); // 12.34
$xssSecurity = new XssSecurity();
$data = $xssSecurity->floatValidation($data, 5, 10) // (opsional) minlength = 5, maxlength = 10
```

• Sanitasi dan Validasi URL/LINK

Sanitasi menghapus karakter selain valid link karakter. Validasi mengecek apakah hanya berisi karakter tertentu, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // https://www.google.com/
$xssSecurity = new XssSecurity();
$data = $xssSecurity->urlValidation($data) // (default) minlength = 12, maxlength = 50
```

```php
$data = $this->input->post('data'); // https://www.w3schools.com/html/default.asp
$xssSecurity = new XssSecurity();
$data = $xssSecurity->urlValidation($data, 20, 100) // (opsional) minlength = 20, maxlength = 100
```

• Sanitasi dan Validasi Phone Number

Sanitasi menghapus karakter selain valid phone number. Validasi mengecek apakah hanya berisi 0-9 dan sesuai format no hp Indonesia, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 088123456789 || 6288123456789 || +6288123456789
$xssSecurity = new XssSecurity();
$data = $xssSecurity->phoneNumberValidation($data) // minlength = 3, maxlength = 15
```

• Sanitasi dan Validasi Location

Sanitasi menghapus karakter selain valid location karakter. Validasi mengecek apakah hanya berisi 0-9, sesuai range location Indonesia, dan ukuran data sesuai dengan ketentuan.
(Khusus method/function ini, output berupa array yang bisa langsung di destrukturisasi berupa [latitude, longitude] jika valid dan NULL jika tidak valid)
Berikut contoh penggunaannya :

```php
$latitude = $this->input->post('latitude'); // -7.256892,
$longitude = $this->input->post('longitude'); // 111.017757
$xssSecurity = new XssSecurity();
[$latitude, $longitude] = $xssSecurity->locationValidation($latitude, $longitude) // minlength = 1, maxlength = 9
```

• Sanitasi dan Validasi IP Address

Sanitasi menghapus karakter selain valid IP address karakter. Validasi mengecek apakah hanya berisi 0-9, ".", sesuai format IP Address, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 114.215.79.108
$xssSecurity = new XssSecurity();
$data = $xssSecurity->ipAddressValidation($data) // minlength = 7, maxlength = 15
```

• Sanitasi dan Validasi Image

Sanitasi menghapus karakter selain "A-Za-z0-9\_.+!\*\'(),{}|\\^~[\]`<>#%";\/?:@&=. -" pada nama image. Validasi mengecek apakah nama image hanya berisi karakter, ukuran nama sesuai dengan ketentuan, dan mimetype berupa "image/png", "image/jpg", "image/jpeg", "image/gif", "image/bmp".
(Khusus method/function ini, output berupa file image dengan nama image yang sudah disanitasi jika valid dan NULL jika tidak valid)
Berikut contoh penggunaannya :

```php
$image = isset($_FILES['image']) ? $_FILES['image'] : NULL; // file image dengan nama test.png
$xssSecurity = new XssSecurity();
$image = $xssSecurity->imageValidation($image)
```

• Sanitasi dan Validasi Email

Sanitasi menghapus karakter selain valid email karakter. Validasi mengecek apakah hanya berisi valid email karakter, sesuai format email, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // test@gmail.com
$xssSecurity = new XssSecurity();
$data = $xssSecurity->emailValidation($data) // minlength = 8, maxlength = 30
```

```php
$data = $this->input->post('data'); // test@gmail.com
$xssSecurity = new XssSecurity();
$data = $xssSecurity->emailValidation($data, 35) // minlength = 8, maxlength = 35
```

• Sanitasi dan Validasi Boolean

Sanitasi menghapus karakter selain 0-1. Validasi mengecek apakah hanya berisi 0-1, dan ukuran data 1 digit.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 0 || 1
$xssSecurity = new XssSecurity();
$data = $xssSecurity->boolValidation($data)
```

• Sanitasi dan Validasi Date

Sanitasi menghapus karakter selain karakter berikut "A-Za-z0-9\_.+!\*\'(),{}|\\^~[\]`<>#%";\/?:@&=. -". Validasi mengecek apakah hanya berisi valid date karakter, sesuai format default/custom input, dan ukuran data sesuai dengan ketentuan.
Berikut contoh penggunaannya :

```php
$data = $this->input->post('data'); // 2023-03-30 12:05:35
$xssSecurity = new XssSecurity();
$data = $xssSecurity->dateValidation($data) // (Y-m-d H:i:s)
```

```php
$data = $this->input->post('data'); // 2023/03/30
$xssSecurity = new XssSecurity();
$data = $xssSecurity->dateValidation($data) // (Y/m/d)
```

## Sitasi

• [XSS Prevention Cheat Sheet OWASP](https://owasp.org/www-community/attacks/xss/).

• [Input Validation Cheat Sheet OWASP](https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html).
