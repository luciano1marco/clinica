DROP TABLE IF EXISTS admin_preferences;

CREATE TABLE IF NOT EXISTS admin_preferences (
  id SERIAL NOT NULL,
  user_panel smallint NOT NULL DEFAULT '0',
  sidebar_form smallint NOT NULL DEFAULT '0',
  messages_menu smallint NOT NULL DEFAULT '0',
  notifications_menu smallint NOT NULL DEFAULT '0',
  tasks_menu smallint NOT NULL DEFAULT '0',
  user_menu smallint NOT NULL DEFAULT '1',
  ctrl_sidebar smallint NOT NULL DEFAULT '0',
  transition_page smallint NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
); 

INSERT INTO admin_preferences 
(
	user_panel, 
	sidebar_form, 
	messages_menu, 
	notifications_menu, 
	tasks_menu, 
	user_menu, 
	ctrl_sidebar, 
	transition_page
) 
VALUES
(0, 0, 0, 0, 0, 1, 0, 0);

DROP TABLE IF EXISTS menus;

CREATE TABLE menus
(
    id serial NOT NULL,
    titulo character varying(250),
    controller character varying(250),
    ordem integer,
    icone character varying(100),
    publicado boolean NOT NULL DEFAULT true,
    CONSTRAINT admin_menus_pk PRIMARY KEY (id)
);

DROP TABLE IF EXISTS groups;

CREATE TABLE IF NOT EXISTS groups (
  id serial NOT NULL,
  name varchar(20) NOT NULL,
  description varchar(100) NOT NULL,
  bgcolor char(7) NOT NULL DEFAULT '#607D8B',
  PRIMARY KEY (id)
);

INSERT INTO groups (
	name, 
	description, 
	bgcolor
) 
VALUES
('admin', 'Administrator', '#F44336'),
('members', 'General User', '#2196F3');

DROP TABLE IF EXISTS login_attempts;

CREATE TABLE IF NOT EXISTS login_attempts (
  id serial NOT NULL,
  ip_address varchar(15) NOT NULL,
  login varchar(100) NOT NULL,
  time integer DEFAULT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS public_preferences;

CREATE TABLE IF NOT EXISTS public_preferences (
  id serial NOT NULL,
  transition_page smallint NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);

INSERT INTO public_preferences 
(   
    transition_page
) 
VALUES 
(0);

DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
  id serial NOT NULL,
  ip_address varchar(15) NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  salt varchar(255) DEFAULT NULL,
  email varchar(100) NOT NULL,
  activation_code varchar(40) DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time integer DEFAULT NULL,
  remember_code varchar(40) DEFAULT NULL,
  created_on integer NOT NULL,
  last_login integer DEFAULT NULL,
  active smallint DEFAULT NULL,
  first_name varchar(50) DEFAULT NULL,
  last_name varchar(50) DEFAULT NULL,
  company varchar(100) DEFAULT NULL,
  phone varchar(20) DEFAULT NULL,
  PRIMARY KEY (id)
);

INSERT INTO users 
(
	ip_address, 
	username, 
	password, 
	salt, 
	email, 
	activation_code, 
	forgotten_password_code, 
	forgotten_password_time, 
	remember_code, 
	created_on, 
	last_login, 
	active, 
	first_name, 
	last_name, 
	company, 
	phone) 
	VALUES
('127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, NULL, 1, 'Admin', 'istrator', 'ADMIN', '0');

CREATE TABLE public.users_groups
(
    id serial NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL,
    CONSTRAINT users_groups_pkey PRIMARY KEY (id),    
    CONSTRAINT fk_users_groups_groups FOREIGN KEY (group_id)
        REFERENCES public.groups (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_users_groups_users FOREIGN KEY (user_id)
        REFERENCES public.users (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
         UNIQUE (user_id, group_id)
);

INSERT INTO users_groups 
(
	user_id, 
	group_id) 
VALUES
(1, 1);

/*Se precisar chamar uma Sequence para determinado valor*/
/*SELECT setval('users_groups_id_seq', 2); */  