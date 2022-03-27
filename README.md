# TOPUP MAMA LUMEN REST API

PHP(Lumen) API is used for listing the
names of books along with their authors and comment count, adding and listing
anonymous comments for a book, and getting the character list for a book.
The movie data is  fetched online from https://anapioficeandfire.com/ using the laravel Http-client API.
The http-client is wrapped around the Guzzle HTTP client, allowing you to quickly make outgoing HTTP requests
to communicate with other web applications



## API Endpoints

HEROKU URL = https://topupmama-backend.herokuapp.com/
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
    response: Returns a book specified by name {A Game of Thrones} 
        {
            "name": "A Game of Thrones",
            "authors": [
            "George R. R. Martin"
            ],
            "comments_count": 1
        }
    GET /api/v1/books?fromReleaseDate={fromReleaseDate}&toReleaseDate={toReleaseDate}
    response: Returns book filtered by date
        {
            "name": "A Game of Thrones",
            "authors": [
            "George R. R. Martin"
            ],
            "comments_count": 1
        }
    GET /api/vi/book/{id}/comments
    response: Returns a collection of book comments ordered in a descending order
	{
		"book_id": "1",
		"comment": "ghfhgfhgfhgfh\\",
		"ip_address": "127.0.0.1",
		"created_at": "2022-03-22 14:41:43"
	},
### Characters
    GET /api/v1/characters
    GET /api/v1/characters?gender={gender}
    GET /api/v1/characters?sort_by={value}&order={order}
### Comments
    GET /api/v1/comments
    GET /api/v1/comment/{id}
    POST /api/v1/comments

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).
