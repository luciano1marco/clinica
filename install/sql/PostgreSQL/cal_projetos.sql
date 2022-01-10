
CREATE TABLE projetos
(
    id serial NOT NULL,
    titulo character varying(200),	
    slug character varying(200),
    descricao text,
    link character varying(200),
    imagem character varying(200),
    publicado boolean,
    CONSTRAINT projetos_pkey PRIMARY KEY (id)
)