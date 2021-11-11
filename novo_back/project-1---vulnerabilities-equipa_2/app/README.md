# SIO - Project 1 - Vulnerabilities

-----

## Group members

| NMec | Name | email |
|--:|---|---|
| 97147 | Jodionísio Muachifi  | jodionsiomuachifi@ua.pt |
| 97737 | António Bento | a.f.bento@ua.pt |
| 97979 | Francisco Gamelas | fgamelas11@ua.pt |
| 92441 | Ivan Xavier | ivanxavier@ua.pt |


## Folder organization

- **app** -- contains the insecure application, including instructions to run it
- **app_sec** -- contains the secure application, including instructions to run it
- **analysis** -- contains scripts/textual descriptions/logs/screen captures demonstrating the exploration of each vulnerability and the fix implemented

## Instructions to run Project

## First Way
To run a project, make sure you have LAMP(for linux) or XAMPP(for windows) installed. After that
- **1º:** Put app and app_sec folder int /var/www/html/ (for linux) ou htdocs (for windows)
- **2º:** Open your browser and type localhost/phpmydamin . Create database dblogin and import DB that's in DBdumps folder into it
- **3º:** Now you're ready to test our application . Just type localhost/project-1---vulnerabilities-equipa_2
## Second Way - The best
- **1º:** Install docker-compose in your sistem. Ignore this step if you have already installed 
- **2º:** Make sure you are in project-1---vulnerabilities-equipa_2 folder and,  run in your terminal <br> **docker-compose up -d**
- **3º:** After the docker pull images for nginx, mysql and phpmydamin, go in your browser and just type **localhost:30080/app/login.php** for app,  **localhost:30080/app_sec/login.php** for app_sec and **localhost:38080/** for phpmyadmin . The credentials for phpmyadmin are :<br> password: **test**, user: **test**, server: **mysql**.
- **4º:** After login into phpmyadmin, import DB that's in DBdumps folder. Now you are ready to test vulnerability app.
- **In the login page (for app ou app_sec for example), you can use this credentials**: username: **qwerqwer**, password: **qwerqwer** 
- Now you can go to **analysis** folder to read and test app internally according to the type of vulnerability
- if you wanto turn off all container, just run **docker-compose down**

## Requirements

- Apache server(XAMPP)
	https://www.apachefriends.org/download.html   
- MYSQL server
	https://dev.mysql.com/downloads/mysql/
- Redis server windows
	https://github.com/microsoftarchive/redis/releases
- Redis server linux, mac, docker
	https://redis.io/download
- Python
	https://www.python.org/downloads/
