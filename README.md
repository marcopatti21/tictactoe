# Tic tac toe

## Project overview
The project has been implemented using Laravel 9.x.

MySql has been used as datastore.

## Project structure
Project has a DDD structure with the following layers:
- Application
- Domain
- Infrastructure

Two simple domains have been implemented:
- Common
    - Mostly for Laravel files and also for basic error handling classes 
- Game
    - In which all logic is implemented

## Database structure

Assumptions:
- For simplicity no Players table has been implemented.
- The application allows by default only player 1 and 2.
- References to player ids are no real foreign key since there is not Players table.

### Tables
- Games
    - Id
        - integer (auto-increment)
    - cell_0, cell_1 ... cell_8
        - integer
        - It contains the player id that moved on the cell.
        - Null until a player moved on that cell.
    - next_player_id
        - integer
        - It represents the player id that have to play the next time 
        - When a game has been started by a player, it is null (waiting for the first player).
        - Null at the end of the game
    - winner_id
        - integer
        - It represents the player id that won the game
        - Null until there is a winner

## How to run
Run 
```
docker-compose up
```
from the main folder to create docker containers both for Laravel and Mysql.

Laravel application listens on port 8000.

Then, from the container app folder run
```
php artisan migrate
```
to execute db migrations.


## Tests
A simple GameTest has been implemented.
It calls the start game api and move api (in order for player 1 and 2) to let player 1 win.

Final board result for that case is:

```
X X X
O O -
- - -
```

To run the test:
```
./vendor/bin/phpunit
```

## Curl api examples

```
curl --location --request POST 'http://localhost:8000/api/game/create'
```

```
curl --location --request PUT 'http://localhost:8000/api/game/move' \
--header 'Content-Type: application/json' \
--data-raw '{
    "gameId": 1,
    "playerId": 1,
    "position": 0
}'
```