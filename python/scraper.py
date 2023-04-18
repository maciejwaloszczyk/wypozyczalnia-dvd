from imdb import Cinemagoer
f = open("movies.txt", "w")

ia = Cinemagoer()

top = ia.get_top250_movies()

with open('movies.txt', 'w') as file:
     file.write(f"INSERT INTO videos (title, genre, releaseYear, director, photoDirectory, description, dateAdded, Rating) VALUES")
     for i in range(100):
        id = top[i].movieID
        movie = ia.get_movie(id)
        title = movie['title']
        title1 = title.replace("'", "").replace('"', '')
        year = movie['year']
        director = movie['director']
        for director in movie['directors']:
            director1 = director['name']
            director2 = director1.replace("'", "").replace('"', '')
        genre = movie['genre']
        genre1 = genre[0]
        rating = movie['rating']
        plot = movie.get('plot outline')
        plot1 = plot.replace("'", "").replace('"', '').replace('--', '')
        poster = movie['full-size cover url']
        file.write(f"('{title1}', '{genre1}', '{year}-01-01', '{director2}', '{poster}', '{plot1}', '2023.03.12', '{rating:.1f}'),\n")
