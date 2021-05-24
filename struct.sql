
CREATE TABLE user (
    id integer primary key auto_increment,
    username varchar(18) not null unique,
    password varchar(255) not null,
    email varchar(60) not null unique,
    name varchar(30) not null,
    surname varchar(40) not null
    

) Engine = InnoDB;


CREATE TABLE posts (
    id integer primary key auto_increment,
    comment integer not null,
    content varchar(100)
)Engine = InnoDB;


CREATE TABLE posts_anime (
    id integer primary key auto_increment,
    comment integer not null,
    content varchar(100)
)Engine = InnoDB;


CREATE TABLE posts_serie (
    id integer primary key auto_increment,
    comment integer not null,
    content varchar(100)
)Engine = InnoDB;


CREATE TABLE comments (
    id integer primary key auto_increment,
    userc integer not null,
    post integer not null,
    time timestamp not null default current_timestamp,
    text varchar(255),
    foreign key (post) references posts(id) on delete cascade on update cascade, 
    foreign key (userc) references user(id) on delete cascade on update cascade
) Engine = InnoDB;



CREATE TABLE comments_anime (
    id integer primary key auto_increment,
    userc integer not null,
    post integer not null,
    time timestamp not null default current_timestamp,
    text varchar(255),
    foreign key (post) references posts_anime(id) on delete cascade on update cascade, 
    foreign key (userc) references user(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE comments_serie (
    id integer primary key auto_increment,
    userc integer not null,
    post integer not null,
    time timestamp not null default current_timestamp,
    text varchar(255),
    foreign key (post) references posts_serie(id) on delete cascade on update cascade, 
    foreign key (userc) references user(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE cookies (
    id integer primary key auto_increment,
    name varchar(255) not null,
    userc integer not null,
    val bigint not null,
    foreign key(userc) references user(id) on delete cascade on update cascade
)Engine = InnoDB;



CREATE TABLE preferiti (
    id integer primary key auto_increment,
    userp integer not null,
    post integer not null,
    index us(userp),
    index p(post),
    foreign key(userp) references user(id) on delete cascade on update cascade ,
    foreign key(post) references posts(id) on delete cascade on update cascade 
)Engine = InnoDB

CREATE TABLE preferiti_serie (
    id integer primary key auto_increment,
    userp integer not null,
    post integer not null,
    index us(userp),
    index p(post),
    foreign key(userp) references user(id) on delete cascade on update cascade ,
    foreign key(post) references posts_serie(id) on delete cascade on update cascade 
)Engine = InnoDB


CREATE TABLE preferiti_anime (
    id integer primary key auto_increment,
    userp integer not null,
    post integer not null,
    index us(userp),
    index p(post),
    foreign key(userp) references user(id) on delete cascade on update cascade ,
    foreign key(post) references posts_anime(id) on delete cascade on update cascade 
)Engine = InnoDB

DELIMITER //
CREATE TRIGGER oncomment
AFTER INSERT ON comments
FOR EACH ROW 
BEGIN
UPDATE posts
SET comment=comment+1
WHERE id=new.post;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER oncomment_serie
AFTER INSERT ON comments
FOR EACH ROW 
BEGIN
UPDATE posts_serie
SET comment=comment+1
WHERE id=new.post;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER oncomment_anime
AFTER INSERT ON comments
FOR EACH ROW 
BEGIN
UPDATE posts_anime
SET comment=comment+1
WHERE id=new.post;
END //
DELIMITER ;