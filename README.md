# test_kollaborative_media

1. Add virtual host to you local env:
   1. ```vim /etc/hosts```
   2. Add row ```127.0.0.1 test.local```
3. Run docker: 
   1. Go to docker source folder: ```cd  _test_docker```
   2. Add self-made certificate from ```cert``` folder to your trusted. ForMAc you can run:
      * ```sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain test.crt```
   3. Run docker ```docker-compose up -d```
4. Migrate database with command ```docker exec test_app php artisan migrate``` 
5. Seed database with command ```docker exec test_app php artisan db:seed``` 
6. Start test app with url ```https://test.local/basket``` 
