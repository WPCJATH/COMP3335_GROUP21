# COMP3335_GROUP21

## Introduction
This is a group project implenmentation of course COMP3335 Database Security at The HK PolyU 2022 Fall By Group21. A hotel information management system demo is developed on the [LAMP Stack](https://en.wikipedia.org/wiki/LAMP_(software_bundle)) under [docker-compose](https://docs.docker.com/compose/). To ensure systematical security, serval technicals including cryptograph, https SSL/TLS connection, access-control, monitoring, etc. are utilized. 

## Contents
- [Introduction](#introduction)
- [Package Dependencies](#package-dependencies)
- [User-Activty Diagram](#user-activty-diagram)
- [Design Features](#design-features)
    - [Router System- COMP3335\_GROUP21](#router-system--comp3335_group21)
    - [Session and Cookies](#session-and-cookies)
    - [HTTPS SSL/TLS](#https-ssltls)
    - [Access Control](#access-control)
        - [Entity-Relationship Diagram](#entity-relationship-diagram)
        - [Privileges on different types of users](#privileges-on-different-types-of-users)
- [Partial Always-Encryption](#partial-always-encryption)
- [Montoring](#montoring)
- [Appearance](#appearance)
    - [Unregister User](#unregister-user)
    - [Customer](#customer)
    - [Manager](#manager)
    - [Front-Desk](#front-desk)
    - [Cleaner](#cleaner)
- [DEMO Video](#demo-video)
- [File Structures](#file-structures)
- [How to run?](#how-to-run)
    - [Deploy main components:](#deploy-main-components)
    - [Deploy Monitor:](#deploy-monitor)
- [Future works](#future-works)


## Package Dependencies
- Frontend: [Bootstrap5](https://getbootstrap.com), [JQuery/Ajax](https://jquery.com), [qrcode.js](https://davidshimjs.github.io/qrcodejs/)
- Backend: [php@7.4](https://www.php.net)
- Server: [Apache](https://www.apache.org) / [Ngnix](https://www.nginx.com)
- Database: [mysql@8.*](https://www.mysql.com)
- Data-admin: [phpmyadmin](https://www.phpmyadmin.net)
- Container: [docker](https://www.docker.com)/[docker-compose](https://docs.docker.com/compose/)

### User-Activty Diagram
TBD

## Design Features
### Router System- [COMP3335\_GROUP21](#comp3335_group21)

TBD

### Session and Cookies
TBD

### HTTPS SSL/TLS
TBD

### Access Control
#### Entity-Relationship Diagram
![ERD](./images/ERD.png)

#### Privileges on different types of users
| User Type  | Room              | Reservation        | Customer             | Staff         | Room Type | Grant | Create User |
|------------|-------------------|--------------------|----------------------|---------------|-----------|-------|-------------|
| Front Desk | R                 | RU - row&col level | R - row&col level    | R - row level | R         | \     | \           |
| Manager    | CRUD              | RU - row&col level | R - row&col level    | CRUD          | CRUD      | Y     | Y           |
| Cleaner    | R - row&col level | \                  | \                    | R - row level | R         | \     | \           |
| Customer   | \                 | CRU -col&row level | CRUD - row&col level | \             | R         | \     | \           |
| Server     | \                 |                    |                      | \             | R         | Y     | Y           |
| Unregister | \                 | \                  | \                    | \             | R         | \     | \           |

### Partial Always-Encryption
TBD

### Montoring
TBD



## Appearance
###  Unregister User
TBD

### Customer
TBD

### Manager
TBD

### Front-Desk
TBD

### Cleaner
TBD


## DEMO Video
[![Watch the video](./images/demo.png)](https://www.youtube-nocookie.com/embed/CWA3R_60B8s)

## File Structures
TBD

## How to run?

### Deploy main components:

- Ensure your computer/server have installed [docker](https://www.docker.com) and [docker-compose](https://docs.docker.com/compose/)
- `cd` to the directory `LAMP_STACK`
- Open terminal and run command `docker-compose up --build` to start and run `docker-comopse down` to stop

**OR**

- Run the file `start.sh`

**Then,**
- Use url https://localhost:8000 or http://localhost:8080 to access the system
- Use url https://localhost:8001 or http://localhost:8081 to access the phpmyadmin via account `root` and password `test`
- Use host `localhost` and port `33306` to access the database via account `root` and password `test`, the used schema is `hotel`

### Deploy Monitor:

* Type `git clone -b main https://github.com/SigNoz/signoz.git && cd signoz/deploy/`
* Type `./install.sh`
* A new container will show in your docker desktop. To access the monitor, To use the monitor, open your browser and enter `localhost:3301` (register required). It will monitor both HTTP requests and database requests.

## Future works

More updates will be address here https://github.com/WPCJATH/COMP3335_GROUP21
