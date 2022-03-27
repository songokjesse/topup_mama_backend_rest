# TOPUP MAMA LUMEN REST API

The movie data should be fetched online from https://anapioficeandfire.com/

##API Endpoints
HEROKU URL = https://topupmama-backend.herokuapp.com/api/v1/
### Books Endpoint
    GET /api/v1/books
    GET /api/v1/books?name={name}
    GET /api/v1/books?fromReleaseDate={fromReleaseDate}&toReleaseDate={toReleaseDate}
    GET /api/vi/book/{id}/comments
 ### Book Responses

    GET /api/v1/books
        response: Returns a collection of Books
        {
            "name": "A Game of Thrones",
            "authors": [
            "George R. R. Martin"
            ],
            "comments_count": 1
        }
    GET /api/v1/books?name={name}
    response: Returns a specific book specified by name {A Game of Thrones} 
        {
            "name": "A Game of Thrones",
            "authors": [
            "George R. R. Martin"
            ],
            "comments_count": 1
        }
    GET /api/v1/books?fromReleaseDate={fromReleaseDate}&toReleaseDate={toReleaseDate}
    response: Returns book filtered by data
        {
            "name": "A Game of Thrones",
            "authors": [
            "George R. R. Martin"
            ],
            "comments_count": 1
        }
    GET /api/vi/book/{id}/comments
### Characters
    GET /api/v1/characters
    GET /api/v1/characters?gender={gender}
    GET /api/v1/characters?sort_by={value}&order={order}
### Comments
    GET /api/v1/comments
    POST /api/v1/comments

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).
