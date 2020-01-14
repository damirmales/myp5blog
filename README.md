"# myp5blog" 
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3e309f372a5c40ea8b3af54be896ecd4)](https://www.codacy.com/manual/d.males/myp5blog?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=damirmales/myp5blog&amp;utm_campaign=Badge_Grade)

Purpose
This is the 5th project in the Openclassrooms "PHP/Symfony" Course.
The main goal on this project is to create a personnal blog with PHP. 
Everything is done with PHP instead of the blog design which is made with a Bootstrap Template.
https://startbootstrap.com/themes/clean-blog/

The project on Github:
https://github.com/damirmales/myp5blog

Link to issues on Github
https://github.com/damirmales/myp5blog/issues

Url of the project
https://damirweb.com/oc/p5/myp5blog/


Dependency :
I use Composer to manage my classes' with an autoloading
https://getcomposer.org/doc/01-basic-usage.md

What you need before installation
You need Apache, MySQL and PHP : you can download a server ( WAMP, MAMP, LAMP, XAMPP).
Personnaly I use XAMPP server

Installation
Download project or clone it in the accurate server file (www for windows, htdocs for MAC...).

1. Make a gitclone from Github repo
2. Use Composer update to install dependencies 
3. Fill in Database.php with necessary parameters: 
    host=localhost
    dbname=p5blog
    'root' (this is the username by default).
    '' (this is the password by default with XAMPP on windows 10 : if you use WAMP and MacOs, 'root' password).
4. Then create your database as followed:
First : log to your database server 
click on "Import".
Select a file and choose "p5blog.sql" in project file root.
Execute



