# flip3rdpartytest

This Project Is Only For Testing Purpose

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
