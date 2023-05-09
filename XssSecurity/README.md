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
• Sanitasi dan Validasi String.
Sanitasi berfungsi untuk menghapus tags, script berbahaya, dan karakter diluar ketentuan. Validasi berfungsi untuk mengecek apakah karakter, dan ukuran string sesuai dengan ketentuan. Output yang diberikan adalah data yang sudah disanitasi jika lolos validasi dan Null jika tidak lolos.
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

• Sanitasi dan Validasi Integer.
Sanitasi berfungsi untuk menghapus tags, script berbahaya, dan karakter selain 0-9, ".". Validasi berfungsi untuk mengecek apakah hanya berisi karakter 0-9, dan ukuran data sesuai dengan ketentuan. Output yang diberikan adalah datayang sudah disanitasi jika lolos validasi dan Null jika tidak lolos.
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

• Sanitasi dan Validasi Float.
Sanitasi berfungsi untuk menghapus tags, script berbahaya, dan karakter selain 0-9, ".". Validasi berfungsi untuk mengecek apakah hanya berisi karakter 0-9 dan ".", dan ukuran data sesuai dengan ketentuan. Output yang diberikan adalah data yang sudah disanitasi jika lolos validasi dan Null jika tidak lolos.
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

• Sanitasi dan Validasi URL/LINK.
Sanitasi berfungsi untuk menghapus tags, script berbahaya, dan karakter selain valid link karakter. Validasi berfungsi untuk mengecek apakah hanya berisi karakter tertemtu, dan ukuran data sesuai dengan ketentuan. Output yang diberikan adalah data yang sudah disanitasi jika lolos validasi dan Null jika tidak lolos.
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

## Sitasi

• [XSS Prevention Cheat Sheet OWASP](https://owasp.org/www-community/attacks/xss/).

• [Input Validation Cheat Sheet OWASP](https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html).
