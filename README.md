# Laravel User Management
A Laravel package to manage users with UI.  
The package bases on Spatie Permissions library

## How to install  

```
composer require smbplus/usermanagement
```
  
Publish config  
```
php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="config"
```
  
Publish assets  
```
php artisan vendor:publish --provider="Smbplus\UserManagement\UserManagementServiceProvider" --tag="assets"
```
  
Optional - if you did not publish spatie-permission config, please run this
```shell
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Run migrate  
```
php artisan migrate
```

Then visit your laravel project with path:  
``` 
/spum/users
```