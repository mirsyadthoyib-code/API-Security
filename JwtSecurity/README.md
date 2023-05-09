JWT Security
=======

Deskripsi
------------
JWT Security adalah library untuk membuat dan memvalidasi token JWT yang dapat digunakan untuk memberikan keamanan tambahan dalam pertukaran informasi dengan API. JWT akan membuat token dengan masa aktif yang telah ditentukan yang kemudian digunakan untuk memverifikasi apakah user yang mengakses adalah yang berhak dan terpercaya.

Prasyarat
------------
•	Sudah menginstall library firebase/php-jwt

•	PHP versi 7.3 keatas

Instalasi
------------

•	Masuk ke project yang mau ditambahkan JWT

•	Install library firebase/php-jwt

```bash
composer require firebase/php-jwt
```

•	Tambahkan variable JWT_SECRET pada .env file dan isi value dengan secret password JWT yang diinginkan, recommended 64 characters length:

```php
JWT_SECRET='7ycT36bB@3%n@WBs8PtDTSNx4vS8cSA!!QBQc3Pvf$R_dWcyEsR5#v@wv?=Q+nTD'
```

•	Tambahkan file JwtSecurity.php kedalam folder …/application/libraries/

•	Tambahkan JwtSecurity pada file …/application/config/autoload.php dan tambahkan JwtSecurity pada bagian libraries agar library dapat di load otomatis pada project.

```php
$autoload['libraries'] = array('database', "JwtSecurity");
```

Penggunaan
------------
•	Generate Token, tambahkan kode dibawah pada method/function login setelah user terautentikasi, pada method generateToken masukkan 2 parameter yaitu, username sebagai penanda user dalam token dan masa expire token dalam satuan menit.

```php
// JWT Token Generation

$JwtSecurity = new JwtSecurity();
$token = $JwtSecurity->generateToken($username, 30);

// JWT End
```

•	Validate Token, tambahkan kode dibawah pada seluruh API endpoint dibagian paling awal method/function.

```php
// JWT Validation

$JwtSecurity = new JwtSecurity();
$auth = isset($this->input->request_headers()['auth']) ? 
$this->input->request_headers()['auth'] : '';
if(!$JwtSecurity->validateToken($auth)) return;

// end JWT Validation
```

Contoh penerapan pada end point ReportPhotoVisit() (letakkan pada awal method/function sebelum proses apapun) :
```php
    public function ReportPhotoVisit()
    {
        // JWT Validation

        $JwtSecurity = new JwtSecurity();
        $auth = isset($this->input->request_headers()['auth']) ? $this->input->request_headers()['auth'] : '';
        if(!$JwtSecurity->validateToken($auth)) return;

        // end JWT Validation
```

•	Pastikan Aplikasi yang mengakses API endpoint telah menambahkan header pada setiap request dengan key “auth” dan value “Bearer {{token}}” ganti token dengan token yang dikirimkan API pada saat login.

Alur Implementasi pada Postman
------------
•	Tambahkan code dibawah pada Login API bagian Tests untuk menyimpan token pada environment Postman setiap Login API di Run
```javascript
const jsonData = JSON.parse(responseBody);
pm.environment.set('token', jsonData.token);
console.log(jsonData.token);
```
![Set Postman Environment Variable](https://github.com/mirsyadthoyib-code/API-Security/blob/main/Set_Environment_Postman.jpg?raw=true)

•	Tambahkan header variable pada Postman dengan format : Key "auth" Value "Bearer {{token}}"
![Set Header Value](https://github.com/mirsyadthoyib-code/API-Security/blob/main/Set_Header_and_Use_Environment_Token.jpg?raw=true)

Alur Implementasi pada APK
------------
![Alur Implementasi Penyimpanan dan Pemakaian Token](https://github.com/mirsyadthoyib-code/API-Security/blob/main/implementation_flow_APK.png?raw=true)

Sitasi
------------
•	[JWT Introduction](https://jwt.io/introduction).

•	[Firebase php JWT library](https://github.com/firebase/php-jwt/blob/main/README.md).