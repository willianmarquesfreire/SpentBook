DROP TABLE categorias;
DROP TABLE CONTAS;
DROP TABLE financeiro;
DROP TABLE USUARIOS;

create table contas (
	usuario varchar(60) not null,
	id int not null primary key auto_increment,
	descricao varchar(60) not null,
	observacoes varchar(100) not null,
        saldoinicial double not null,
        saldoatual double not null,
        tipo varchar(10)
);

create table categorias (
	usuario varchar(60) not null,
	descricao varchar(60) not null,
	observacoes varchar(100),
	CONSTRAINT pk_categoria PRIMARY KEY(usuario,descricao)
);

create table financeiro (
	usuario varchar(60) not null,
	descricao varchar(60),
	id int not null primary key auto_increment,
	categoria varchar(60) not null,
	status varchar(15) not null, /**aberto, fechado, cancelado*/
	tipo varchar(10) not null, /**crédito, débito*/
	dtemissao date,
	dtpagamento date,
	vlrbruto double, 
	vlrdesconto double,
	vlrjuros double,
	vlrliquido double,
	conta varchar(60),
	observacoes varchar(100)
);

create table usuarios (
	login varchar(60) not null,
	senha varchar(60) not null
);