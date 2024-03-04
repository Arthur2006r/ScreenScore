create database bdAtividade03PWII;

use bdAtividade03PWII;

create table Adiministrador (
  codAdiministrador int not null,
    senha varchar(255) not null,
    primary key(codAdiministrador)
);

create table Avaliador (
  codAvaliador int auto_increment,
    username varchar(255) not null unique,
    email varchar(255) not null unique,
  senha varchar(255) not null,
    avatar varchar(255),
    biografia varchar(1000),
    primary key(codAvaliador)
);

create table Filme (
  codFilme int auto_increment,
    titulo varchar(255) not null,
    diretor varchar(255) not null,
    dataEstreia date not null,
    tema varchar(255) not null,
  sinopse varchar(800) not null,
    capa varchar(255) not null,
    banner varchar(255) not null,
  primary key(codFilme)
);

create table Avaliacao (
  codFilme int,
    codAvaliador int,
    avaliacao int not null,
    primary key(codFilme, codAvaliador)
);

create table Comentario (
  codComentario int auto_increment,
    codFilme int not null,
    codAvaliador int not null,
    comentario varchar(800) not null,
    primary key(codComentario)
);

create table Vizualizacao (
  codFilme int,
    codAvaliador int,
    primary key(codFilme, codAvaliador)
);

create table Curtida (
  codFilme int,
    codAvaliador int,
    primary key(codFilme, codAvaliador)
);

create table Deslike (
  codFilme int,
    codAvaliador int,
    primary key(codFilme, codAvaliador)
);

create table CurtidaComentario (
	codComentario int,
    codAvaliador int,
    primary key(codComentario, codAvaliador)
);

create table DeslikeComentario (
	codComentario int,
    codAvaliador int,
    primary key(codComentario, codAvaliador)
);

alter table Avaliacao add constraint FK_Avaliacao_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table Avaliacao add constraint FK_Avaliacao_Filme foreign key(codFilme) references Filme(codFilme);

alter table Comentario add constraint FK_Comentario_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table Comentario add constraint FK_Comentario_Filme foreign key(codFilme) references Filme(codFilme);

alter table Vizualizacao add constraint FK_Vizualizacao_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table Vizualizacao add constraint FK_Vizualizacao_Filme foreign key(codFilme) references Filme(codFilme);

alter table Curtida add constraint FK_Curtida_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table Curtida add constraint FK_Curtida_Filme foreign key(codFilme) references Filme(codFilme);

alter table Deslike add constraint FK_Deslike_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table Deslike add constraint FK_Deslike_Filme foreign key(codFilme) references Filme(codFilme);

alter table CurtidaComentario add constraint FK_CurtidaComentario_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table CurtidaComentario add constraint FK_CurtidaComentario_Filme foreign key(codComentario) references Comentario(codComentario);

alter table DeslikeComentario add constraint FK_DeslikeComentario_Avaliador foreign key(codAvaliador) references Avaliador(codAvaliador);
alter table DeslikeComentario add constraint FK_DeslikeComentario_Filme foreign key(codComentario) references Comentario(codComentario);

insert into Adiministrador(codAdiministrador, senha) values(101, "admin-260906");