### Environment

- **[Laravel v8](https://laravel.com/docs/8.x)**
- **[Composer v2](https://getcomposer.org/)**
- **[Mysql v8](https://www.mysql.com/)**
- **[Node v16](https://nodejs.org/en/)**


### Installation Steps
- **Cloning the repo** ```git clone git@github.com:ysha-nepal/pro-assessment.git ```
- **Change Directory** Move to the project directory
- **Initialize Submodule** ```git submodule init```
- **Update Submodule** ```git submodule update```
- **Master Branch Submodule** ```git submodule foreach git checkout master```
- **Copy .env.example as .env**
- **Configure database**
- **Configure APP_URL**
- **Install composer dependencies** ```composer install``` *composer may fail*
- **Update composer** ```composer update``` *To merge composer**
- **Project Setup** ```php artisan package:setup```


#### In Case of Some Failures/Mistakes Below Are the Individual Commands
### Console Commands
- **Generate Key** ```php artisan key:generate```
- **Run package migrate** ```php artisan package:migrate```
- **Generate Permission** ```php artisan generate:permission```
- **Generate Menus** ```****php artisan generate:menu```
- **Generate Super User** ```php artisan generate:super-user```
- **Generate Setting** ```php artisan generate:setting```
- **Compile Core Packages** ```PACKAGE=core npm run compile```
- **Install Npm** ```npm install```
- **Generate Assets** ```npm run dev```
- **Server the Project** ```php artisan serve```

<em>Note: If you have any queries or issues while installing the project. Please contact @ kundan.karna1994@gmail.com</em>

&copy; 2022 Kundan karna. All rights reserved
