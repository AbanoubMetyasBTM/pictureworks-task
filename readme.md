installation
-------------------
1. create a database, add the database name at .env file.
2. run php artisan migrate.

testing
-----------------
1. I added features tests, unit tests, you can run it
2. I'll also add postman collection to test everything
3. you can test artisan command by run "php artisan comment:append 1 comment", and it will work fine.

routes implemented
-------------------
1. get user => user/{id}
2. update comments => user/{id}/update-comments
3. everything will be at postman collection
4. https://www.getpostman.com/collections/5dccfbe1e09910badf8c
