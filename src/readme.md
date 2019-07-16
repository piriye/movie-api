# Movie API

### Endpoints
List of all available endpoints
- [Get all movies](#get-all-movies): GET /movies
- [Get all characters](#get-all-characters): GET /movies/{movie_id}/people
- [Add a comment](#add-a-comment): POST /movies/1/comments

### Get all movies

GET /movies

**Description**

Fetches a list of all movies

**Parameters**

None

**Return format**

A JSON array with the list of movies

**Example**

```
{
    "status": "success",
    "message": "Successfully fetched movies",
    "data": [
        {
            "id": 1,
            "episode_id": 4,
            "title": "A New Hope",
            "opening_crawl": "It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal secret\r\nplans to the Empire's\r\nultimate weapon, the DEATH\r\nSTAR, an armored space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued by the Empire's\r\nsinister agents, Princess\r\nLeia races home aboard her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and restore\r\nfreedom to the galaxy....",
            "director": "George Lucas",
            "producer": "Gary Kurtz, Rick McCallum",
            "release_date": "1977-05-25",
            "created": "2014-12-10",
            "edited": "2015-04-11",
            "url": "https://swapi.co/api/films/1/",
            "created_at": "2019-07-15 19:24:25",
            "updated_at": "2019-07-15 19:24:25",
            "comments_count": 3,
            "people": [...],
            "comments": [...]
        },
        {
            "id": 6,
            "episode_id": 5,
            "title": "The Empire Strikes Back",
            "opening_crawl": "It is a dark time for the\r\nRebellion. Although the Death\r\nStar has been destroyed,\r\nImperial troops have driven the\r\nRebel forces from their hidden\r\nbase and pursued them across\r\nthe galaxy.\r\n\r\nEvading the dreaded Imperial\r\nStarfleet, a group of freedom\r\nfighters led by Luke Skywalker\r\nhas established a new secret\r\nbase on the remote ice world\r\nof Hoth.\r\n\r\nThe evil lord Darth Vader,\r\nobsessed with finding young\r\nSkywalker, has dispatched\r\nthousands of remote probes into\r\nthe far reaches of space....",
            "director": "Irvin Kershner",
            "producer": "Gary Kurtz, Rick McCallum",
            "release_date": "1980-05-17",
            "created": "2014-12-12",
            "edited": "2017-04-19",
            "url": "https://swapi.co/api/films/2/",
            "created_at": "2019-07-15 19:28:03",
            "updated_at": "2019-07-15 19:28:03",
            "comments_count": 0,
            "people": [...],
            "comments": [...]
        }
    ]
}
```

### Get all characters

GET /movies/{movie_id}/people

**Description**

Fetches a list of all characters

**Parameters**

- **filters** - Field to filter by and value (e.g. gender:male)
- **order_by** - Field to order by and sort order (e.g. name:asc)

**Sample request**

0.0.0.0:32794/movies/1/people?filters=gender:male

**Return format**

A JSON array with the list of characters

**Example**

```
{
    "status": "success",
    "message": "Successfully fetched characters",
    "data": [
        {
            "id": 1,
            "name": "Luke Skywalker",
            "height": 172,
            "mass": 77,
            "hair_color": "blond",
            "skin_color": "fair",
            "eye_color": "blue",
            "birth_year": "19BBY",
            "gender": "male",
            "homeworld": "https://swapi.co/api/planets/1/",
            "created": "2014-12-09",
            "edited": "2014-12-20",
            "url": "https://swapi.co/api/people/1/",
            "created_at": "2019-07-15 19:24:27",
            "updated_at": "2019-07-15 19:24:27"
        },
        {
            "id": 2,
            "name": "C-3PO",
            "height": 167,
            "mass": 75,
            "hair_color": "n/a",
            "skin_color": "gold",
            "eye_color": "yellow",
            "birth_year": "112BBY",
            "gender": "n/a",
            "homeworld": "https://swapi.co/api/planets/1/",
            "created": "2014-12-10",
            "edited": "2014-12-20",
            "url": "https://swapi.co/api/people/2/",
            "created_at": "2019-07-15 19:24:28",
            "updated_at": "2019-07-15 19:24:28"
        },
    ]
}
```

### Add a comment

POST /movies/{movie_id}/comments

**Description**

Add a comment to a movie

**Post parameters**

- **message** (_required_) - the comment text
- **ip_address** - public IP address of the commenter

**Return format**

A JSON array with created comment

**Example**

```
{
    "status": "success",
    "message": "Successfully created comment",
    "data": {
        "message": "Because the bounty hunter was originally imagined to be part of an elite squad of stormtroopers, his armour was first drafted up to be completely white. Only after several screen tests did his costume then incorporate the iconic military green and rusty red colourway we know today. Despite this widespread myth, Boba Fett's gargantuan vehicle was actually inspired by a satellite dish.",
        "ip_address": "247.251.142.31",
        "movie_id": 1,
        "updated_at": "2019-07-15 20:20:50",
        "created_at": "2019-07-15 20:20:50",
        "id": 3
    }
}
```
