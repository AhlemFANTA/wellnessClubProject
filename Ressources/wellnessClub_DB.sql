Drop database if exists wellnessClub;

create database wellnessClub;
use wellnessClub;

create table blog_post (
id int (11),
titre varchar(255),
author varchar(255),
content longtext,
date datetime  
);
insert into blog_post values (1, "titre 1", "Albert Einstein", "L'imagination est plus importante que le savoir.","2020/02/20");
insert into blog_post values (2, "titre 2", "Napoléon Bonaparte", "Je gagne mes batailles avec le rêve de mes soldats.", "2020/01/20");
insert into blog_post values (3, "titre 3", "Charles Baudelaire","Comme l'imagination a créé le monde, elle le gouverne.", "2019/02/20");
insert into blog_post values (4, "titre 4","André Breton", "La rêverie... une jeune femme merveilleuse, imprévisible, tendre, énigmatique, provocante, à qui je ne demande jamais compte de ses fugues.", "2017/02/20");
