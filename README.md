# COMP3335_GROUP21

## Entity-Relationship Diagram
![ERD](./images/ERD.png)

## Privileges on different types of users
| User Type  | Room          | Reservation        | Customer             | Staff         | Room Type | Grant | Create User |
|------------|---------------|--------------------|----------------------|---------------|-----------|-------|-------------|
| Front Desk | R             | RU - col level     | R                    | R - row level | R         | \     | \           |
| Manager    | CRUD          | CRU - col level    | CR                   | CRUD          | CRUD      | Y     | Y           |
| Cleaner    | R - row level | R - row level      | \                    | \             | R         | \     | \           |
| Customer   | \             | CRU -col&row level | CRUD - row&col level | \             | R         | \     | \           |
| Server     | \             |                    |                      | \             | R         | Y     | Y           |

## How to run?
- Ensure your computer/server have installed [docker](https://www.docker.com) and [docker-compose](https://docs.docker.com/compose/)
- `cd` to the directory `LAMP_STACK`
- Open terminal and run command `docker-compose up --build` to start and run `docker-comopse down` to stop

**OR**

- Run the file `start.sh`


