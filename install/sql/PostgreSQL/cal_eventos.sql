

CREATE TABLE secretaria
(
    id serial NOT NULL,
    titulo character varying(100),
    sigla character varying(20),
    icone character varying(100),
    cor character varying(100),
    publicado boolean NOT NULL DEFAULT true,    
    CONSTRAINT secretaria_pkey PRIMARY KEY (id)
)

CREATE TABLE tipo_eventos
(
    id serial NOT NULL,
    titulo character varying(250),
    descricao character varying(250) ,
    icone character varying(100),
    cor character varying(100),
    publicado boolean NOT NULL DEFAULT true,
    CONSTRAINT tipo_eventos_pk PRIMARY KEY (id)
)

CREATE TABLE calendario
(
    id serial NOT NULL,
    titulo character varying(200),
    ano integer NOT NULL,
    id_secretaria integer NOT NULL,
    publicado boolean NOT NULL DEFAULT true,
    CONSTRAINT calendario_pk PRIMARY KEY (id),
    CONSTRAINT calendario_unique UNIQUE (id),
    CONSTRAINT titulo_unique UNIQUE (titulo),
    CONSTRAINT id_secretaria_fk FOREIGN KEY (id_secretaria)
        REFERENCES secretaria (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE NO ACTION
)

CREATE TABLE eventos
(
    id serial NOT NULL,
    titulo_evento character varying(250),
    id_calendario integer,
    dt_inicio timestamp without time zone,
    dt_termino timestamp without time zone,
    descricao text,
    link_evento character varying(250),
    id_tipo_evento integer,
    id_tipo_data integer,
    latitude character varying(50),
    longitude character varying(50),
    mapa integer NOT NULL DEFAULT 0,
    mes_mensal integer,
    imagem character varying(255),
    publicado boolean NOT NULL DEFAULT true,
    CONSTRAINT eventos_pkey PRIMARY KEY (id),
    CONSTRAINT id_calendario_fk FOREIGN KEY (id_calendario)
        REFERENCES calendario (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE NO ACTION
)












INSERT INTO public.secretaria
(
	titulo, sigla, icone, cor
)
	VALUES 
	('Secretaria Municipal de Cidadania e Assistencial Social','SMCAS','handshake-o','deeppink'),
	('Secretaria Municipal de Turismo, Esporte e Lazer','SMTEL','bicycle','blueviolet'),
	('Secretaria Municipal de Pesca','SMP','anchor','aqua'),
	('Secretaria de Municipio de Desenvolvimento Primario','SMDP','leaf','darkgreen'),
	('Prefeitura Municipal do Rio Grande','PMRG','building','black'),
	('Secretaria de Desenvolvimento, Inovacao e Turismo','SMDIT','star','blue'),
	('Secretaria da Fazenda','SMF','eur','darkgoldenrod'),
	('Secretaria da Educacao','SMED','graduation-cap','cornflowerblue'),
	('Secretaria da Cultura','SMCULT','book','darkorange'),
	('Secretaria de Gestao Administrativa','SMGA','user','deeppink'),
	('Secretaria Municipal de Saude','SMS','plus','red'),
	('Secretaria Municipal de Meio Ambiente','SMMA','tree','green')
