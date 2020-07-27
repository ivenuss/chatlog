# Chat Log

![GitHub All Releases](https://img.shields.io/github/downloads/ivenuss/chatlog/total) ![GitHub last commit](https://img.shields.io/github/last-commit/ivenuss/chatlog) ![GitHub repo size](https://img.shields.io/github/repo-size/ivenuss/chatlog) 

## Description
Saves all posted user messages in database.

## Database preview

![ddisp](https://i.imgur.com/Voscu0D.png)

## Web preview

![ddisp](https://i.imgur.com/cdUKhv4.png)

## Installation:
connect to your mysql in ``databases.cfg``
```sh
"chatlog"
{
    "driver"                        "mysql"
    "host"                          "localhost"
    "database"                      ""
    "user"                          ""
    "pass"                          ""
}
```

connect to your mysql in ``database.php``
```sh
// DB hostname
$servername = "localhost";

// DB username
$username = "";

// DB password
$password = "";

// DB name
$dbname = "";
```

## ConVars
```sh
sm_chatlog_cleartable_enabled "1" //Enable/Disable clearing table (1/0) 0 - disabled
sm_chatlog_cleartable_duration "1 MONTH" //How often will table restart
```

## Note
Please, keep in mind I am not webdev and this is my second work with web development, so bugs may appear.