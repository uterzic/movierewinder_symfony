# MovieRewinder made using Symfony
MovieRewinder is a web application that allows users to explore, rate, and review movies. With an intuitive interface and a vast database of movies, users can discover new films, keep track of their favorites, and share their thoughts with the community. Powered by Symfony and tailored with modern web technologies, MovieRewinder offers a seamless experience for movie enthusiasts to engage, discuss, and discover the world of cinema.

## Project overview
- Creation, editing, deletion, and updating of movie reviews
- User registration and login functionalities
- Ability for registered users to like movie reviews, post comments, and engage in discussions
- Exclusive reviewer role for creating movie reviews
- Full administrative control, including editing or deleting reviews and managing comments


## Prerequisites
Symfony CLI is needed in order to successfuly prepare and start the project. It can be downloaded from Symfony's official website **https://symfony.com/download**

Composer package manager is required to download required packages for MovieRewinder. You can find out more about composer instalation on https://getcomposer.org/

Like composer, NPM is required so the node packages can be downloaded and properly installed. Find out about installing npm on https://www.npmjs.com/package/npm

## Setting up project on your machine
1. Download project from releases or clone it using git.
2. Open project directory using favourite text editor. I recommend using Visual Studio Code.
3. Edit .env file (make a connect to your MySQL server)
4. Using terminal locate project directory and type next commands
5. npm install
6. composer install
5. **symfony console doctrine:database:create** (to create database 'movies')
6. **symfony console doctrine:migrations:migrate** (to populate 'movies' with tables and columns)
7. After successful migration run command **symfony console doctrine:fixtures:load** (to load dummy data and try project's functionality)

## Starting MovieRewinder
After completing the setting up steps you are ready to visit and try MovieRewinder. 
Start symfony's server using **symfony start:server** command and goto URL addres server has provided. **e.g. 127.0.0.1:8000/**
I hope this project will give you ideas for your projects and help you understand Symfony better on your developer journey.

Thanks and enjoy!
