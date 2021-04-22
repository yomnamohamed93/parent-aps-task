# Parent-APS-laravel-task

Laravel version "5.8".

### Installation and configuration steps

 <pre> git clone https://github.com/yomnamohamed93/parent-aps-task.git </pre>   
 <pre>  cd parent-aps-task </pre>
 <pre>  composer install </pre>
 <pre> cp .env.example .env </pre>
 <pre> php artisan key:generate </pre>
Start the local development server

   <pre> php artisan serve </pre>
# Testing API

Users api can now be accessed through **GET** request at: 

    http://localhost:8000/api/topRatedMovies
    
- No paramters are required for this api.</br> </br>
***All the following parameters is sent as query string parameters***. </br>
- You can filter by payment providers using parameter called **dataProvider** .
- You can filter by statusCode using parameter called **statusCode** .
- You can filter by currency using parameter called **currency** .
- You can filter by amount range using parameters called **balanceMin** and **balanceMax** .
