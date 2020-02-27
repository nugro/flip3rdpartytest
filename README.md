# flip3rdpartytest

This Project Is Only For Testing Purpose
Build with PHP 5.6 and MySql/MariaDB database.

1. Please setup the connection,url and token on file config/Connection.php
2. Create Database manually
3. Run Migrate
4. Run post/request disbursement
5. Run check disbursement status

for migrate

```
cd migrate
php migrate.php
```

for post disbursement

```
cd api
php disburse.php
```

for check disbursement status

```
cd api
php disbursementstatus.php 9999999999
// 9999999 is replace by id
```

Example
```
cd migrate
php migrate.php 
cd ..
cd api
php disburse.php
{"message":"Post Created id: 6070319090"}                                                                               
php disbursementstatus.php 6070319090
{"id":6070319090,"amount":10000,"status":"PENDING","timestamp":"2020-02-27 21:18:04","bank_code":"bni","account_number":"1234567890","beneficiary_name":"PT FLIP","remark":"sample remark","receipt":"https:\/\/flip-receipt.oss-ap-southeast-5.aliyuncs.com\/debit_receipt\/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg","time_served":"2020-02-27 21:27:04","fee":4000}
```
