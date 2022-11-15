# COMP3335_GROUP21

## Privileges on different types of users
| User Type  | Room          | Reservation        | Customer             | Staff         | Room Type | Grant | Create User |
|------------|---------------|--------------------|----------------------|---------------|-----------|-------|-------------|
| Front Desk | R             | RU - col level     | R                    | R - row level | R         | \     | \           |
| Manager    | CRUD          | CRU - col level    | CR                   | CRUD          | CRUD      | Y     | Y           |
| Cleaner    | R - row level | R - row level      | \                    | \             | R         | \     | \           |
| Customer   | \             | CRU -col&row level | CRUD - row&col level | \             | R         | \     | \           |
| Server     | \             |                    |                      | \             | R         | Y     | Y           |