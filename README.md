### Requirements
* PHP 8.1
* Node 14+
* MySQL
* [redis](https://redis.io/docs/install/)

### Recursos actuales para SPA:

* [buefy](https://buefy.org/)
* [vue](https://v2.vuejs.org/v2/guide/?redirect=true)
* [vue-router](https://v3.router.vuejs.org/)
* [pinia](https://pinia.vuejs.org/)
* [axios](https://github.com/axios/axios)
* [dayjs](https://day.js.org/)
* [vue-fontawesome](https://github.com/FortAwesome/vue-fontawesome)

### Aplicaciones Web incluidas(SPA):

* Aplicación de Control de Embarque
    - vue, pinia, bulma, buefy, axios, dayjs, vue-fontawesome


## FIRST STEP WHEN PUSHING CHANGES TO SOURCE -> Change Remote Git Repo
**Remove Actual origin Repo Url**
```
git remote rm origin
git remote add origin "your new origin repo url"
```

### Pasos para instalar

```
composer install  
npm install  
cp .env.example .env  
"Agregar valores de las bases de datos en el archivo .env"  
"Si estas en producción cambiar el valor de APP_ENV=production" 
php artisan key:generate  
php artisan storage:link  
php artisan migrate   
```

### Para compilar aplicaciones Web SPA en desarrollo local usar:
```
npm run dev
```

### Para compilar aplicaciones Web SPA para producción usar:
```
npm run build
```

### Comandos para para usar queues y redis(aun no se usa)
```
php artisan queue:work // Si se hacen cambios en los archivos de los eventos o jobs hay que reiniciar este comando.
```
```
sudo service redis-server start // open ubuntu terminal (Windows WSL)
```

### Comandos de utilidad
```
"Para chequeo de errores en todo el proyecto de php"
php vendor/bin/phpstan analyse

"Para chequeo de errores de un archivo especifico de php"
php vendor/bin/phpstan analyse app/Http/Controllers/SiteController.php

"Para dar formato al código en php en todo el proyecto"
php vendor/bin/pint

"Generar Indices de Clases para VSCode Intelliphense"
php artisan ide-helper:generate
php artisan ide-helper:models

"Para ver los valores de variable al ejecutar un script en php usando -> dump($var)"
php artisan dump-server
php artisan dump-server --format=html > dump.html
```

```
"Para chequeo de errores en javascript y vue"
npm run lint

"Para dar formato al código en vue y javascript"
npm run format

"Log Viewer URL"
{APP_URL}/log-viewer
example: http://127.0.0.1:8000/log-viewer

"Ver Monitor de Jobs"
{APP_URL}/jobs
example: http://127.0.0.1:8000/jobs
```

### MongoDB Developement Windows Tips

Laragon
```
Es valido tambien instalar MongoDB fuera de Laragon... Solo se tiene que agregar el DLL de PHP.

Herramientas -> Quick add -> Configuracion...

Agregar url de mongodb 7.*
mongodb-7=https://fastdl.mongodb.org/windows/mongodb-windows-x86_64-7.0.4.zip

Then Download it from menu
Herramientas -> Quick add -> mongodb-7

Download from this link php_mongodb.dll v1.17.0:
https://mega.nz/file/41hRQC5S#0ptzi9Ih_LspIYdTm1UMS5-uDTHgPxGLVrqmnVDhQnM

Copy & Paste DLL at C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\ext or similar
Or from menu PHP -> dir:ext -> paste dll here

Add to php.ini: (menu PHP -> php.ini)
extension=php_mongodb.dll
```

Config File MongoDB (Important)
```
start mongo on laragon... it wil fail its ok!
Go to C:\laragon\bin\mongodb\mongodb-windows-7.0.4
backup original mongod.conf (maybe backup_mongod.conf)
then create new mongod.conf with next configuration:

--- mongod.conf ---

systemLog:
  destination: file
  logAppend: true
  path: C:\laragon\bin\mongodb\mongodb-windows-7.0.4\mongod.log
storage:
  dbPath: C:\laragon\data\mongodb
processManagement:
  pidFilePath: mongod.pid
net:
  port: 27017
  bindIp: 127.0.0.1
  
```

### MongoDB PHP Extension Ubuntu
```
https://www.php.net/manual/es/mongodb.installation.pecl.php
```

Laravel Package
```
https://github.com/mongodb/laravel-mongodb/tree/3.9#laravel-version-compatibility
```

MongoCompass como GUI de MongoDB
```
https://www.mongodb.com/es/products/tools/compass
```

PHP YAML
```
// yaml 2.2.2 for Windows (Laragon)
https://pecl.php.net/package/yaml/2.2.2/windows
***Choose Thread Safe x64
add extension=php_yaml.dll to php.ini
Restart Apache/Laragon.

// PHP YAML for Linux
sudo apt install php-yaml
```

PHP SSH2
```
// ssh2 1.3.1 for Windows (Laragon)
https://pecl.php.net/package/ssh2/1.3.1/windows
***Choose Thread Safe x64
add extension=php_ssh2.dll to php.ini
Restart Apache/Laragon.

// PHP ssh2 for Linux
sudo apt install php-ssh2
```