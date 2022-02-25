--
-- PostgreSQL database dump
--

-- Dumped from database version 14.1
-- Dumped by pg_dump version 14.1

-- Started on 2022-02-25 12:08:09

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 3430 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 219 (class 1259 OID 17876)
-- Name: exercises; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.exercises (
    ex_id bigint NOT NULL,
    user_id bigint NOT NULL,
    ex_descr text NOT NULL,
    ex_type integer NOT NULL
);


ALTER TABLE public.exercises OWNER TO demo;

--
-- TOC entry 218 (class 1259 OID 17875)
-- Name: exercises_ex_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.exercises_ex_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.exercises_ex_id_seq OWNER TO demo;

--
-- TOC entry 3431 (class 0 OID 0)
-- Dependencies: 218
-- Name: exercises_ex_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.exercises_ex_id_seq OWNED BY public.exercises.ex_id;


--
-- TOC entry 215 (class 1259 OID 17852)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO demo;

--
-- TOC entry 214 (class 1259 OID 17851)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO demo;

--
-- TOC entry 3432 (class 0 OID 0)
-- Dependencies: 214
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 210 (class 1259 OID 17828)
-- Name: migrations; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO demo;

--
-- TOC entry 209 (class 1259 OID 17827)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO demo;

--
-- TOC entry 3433 (class 0 OID 0)
-- Dependencies: 209
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 226 (class 1259 OID 18007)
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO demo;

--
-- TOC entry 227 (class 1259 OID 18018)
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO demo;

--
-- TOC entry 213 (class 1259 OID 17845)
-- Name: password_resets; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO demo;

--
-- TOC entry 223 (class 1259 OID 17986)
-- Name: permissions; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO demo;

--
-- TOC entry 222 (class 1259 OID 17985)
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO demo;

--
-- TOC entry 3434 (class 0 OID 0)
-- Dependencies: 222
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- TOC entry 217 (class 1259 OID 17864)
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO demo;

--
-- TOC entry 216 (class 1259 OID 17863)
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO demo;

--
-- TOC entry 3435 (class 0 OID 0)
-- Dependencies: 216
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- TOC entry 228 (class 1259 OID 18029)
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO demo;

--
-- TOC entry 225 (class 1259 OID 17997)
-- Name: roles; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO demo;

--
-- TOC entry 224 (class 1259 OID 17996)
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO demo;

--
-- TOC entry 3436 (class 0 OID 0)
-- Dependencies: 224
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- TOC entry 212 (class 1259 OID 17835)
-- Name: users; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO demo;

--
-- TOC entry 211 (class 1259 OID 17834)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO demo;

--
-- TOC entry 3437 (class 0 OID 0)
-- Dependencies: 211
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 221 (class 1259 OID 17890)
-- Name: workouts; Type: TABLE; Schema: public; Owner: demo
--

CREATE TABLE public.workouts (
    w_id bigint NOT NULL,
    ex_id bigint NOT NULL,
    weight1 double precision NOT NULL,
    weight2 double precision NOT NULL,
    count1 integer NOT NULL,
    count2 integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.workouts OWNER TO demo;

--
-- TOC entry 220 (class 1259 OID 17889)
-- Name: workouts_w_id_seq; Type: SEQUENCE; Schema: public; Owner: demo
--

CREATE SEQUENCE public.workouts_w_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.workouts_w_id_seq OWNER TO demo;

--
-- TOC entry 3438 (class 0 OID 0)
-- Dependencies: 220
-- Name: workouts_w_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: demo
--

ALTER SEQUENCE public.workouts_w_id_seq OWNED BY public.workouts.w_id;


--
-- TOC entry 3220 (class 2604 OID 17879)
-- Name: exercises ex_id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.exercises ALTER COLUMN ex_id SET DEFAULT nextval('public.exercises_ex_id_seq'::regclass);


--
-- TOC entry 3217 (class 2604 OID 17855)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 3215 (class 2604 OID 17831)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3222 (class 2604 OID 17989)
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- TOC entry 3219 (class 2604 OID 17867)
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- TOC entry 3223 (class 2604 OID 18000)
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- TOC entry 3216 (class 2604 OID 17838)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3221 (class 2604 OID 17893)
-- Name: workouts w_id; Type: DEFAULT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.workouts ALTER COLUMN w_id SET DEFAULT nextval('public.workouts_w_id_seq'::regclass);


--
-- TOC entry 3415 (class 0 OID 17876)
-- Dependencies: 219
-- Data for Name: exercises; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.exercises VALUES (1, 1, 'Id vel assumenda.', 2);
INSERT INTO public.exercises VALUES (2, 2, 'Porro rerum a a.', 1);
INSERT INTO public.exercises VALUES (3, 2, 'Commodi repudiandae voluptatem.', 2);
INSERT INTO public.exercises VALUES (4, 1, 'Iusto non est quia maxime.', 0);
INSERT INTO public.exercises VALUES (5, 1, 'Sit est quas autem.', 0);
INSERT INTO public.exercises VALUES (6, 1, 'Natus velit aut.', 1);
INSERT INTO public.exercises VALUES (7, 2, 'Iure quibusdam.', 3);
INSERT INTO public.exercises VALUES (8, 2, 'Eum placeat est.', 1);
INSERT INTO public.exercises VALUES (9, 1, 'Pariatur odio soluta nihil.', 1);
INSERT INTO public.exercises VALUES (10, 2, 'Excepturi voluptatibus quia.', 1);
INSERT INTO public.exercises VALUES (11, 1, 'Voluptatem est voluptates nostrum.', 0);
INSERT INTO public.exercises VALUES (12, 2, 'Aperiam repellendus atque ipsum.', 1);
INSERT INTO public.exercises VALUES (13, 2, 'Et laborum sunt expedita.', 2);
INSERT INTO public.exercises VALUES (14, 2, 'Molestiae veritatis aut dignissimos.', 3);
INSERT INTO public.exercises VALUES (15, 1, 'Sapiente perferendis nostrum.', 0);
INSERT INTO public.exercises VALUES (16, 2, 'Libero velit dolor.', 2);
INSERT INTO public.exercises VALUES (17, 2, 'Quidem maiores minima.', 2);
INSERT INTO public.exercises VALUES (18, 1, 'Qui error magnam corrupti.', 2);
INSERT INTO public.exercises VALUES (19, 1, 'Nihil dolores iure rerum.', 1);
INSERT INTO public.exercises VALUES (20, 2, 'Consequatur error mollitia est.', 1);
INSERT INTO public.exercises VALUES (21, 2, 'Dolorem et magnam.', 2);
INSERT INTO public.exercises VALUES (22, 1, 'Id quidem ut.', 1);
INSERT INTO public.exercises VALUES (23, 2, 'Ut velit id sapiente.', 3);
INSERT INTO public.exercises VALUES (24, 1, 'Ullam culpa non.', 2);
INSERT INTO public.exercises VALUES (25, 1, 'Officia rerum.', 0);
INSERT INTO public.exercises VALUES (26, 2, 'Repudiandae libero aut unde.', 3);
INSERT INTO public.exercises VALUES (27, 1, 'Beatae saepe eligendi qui.', 1);
INSERT INTO public.exercises VALUES (28, 2, 'Dolorem alias et.', 0);
INSERT INTO public.exercises VALUES (29, 1, 'Placeat occaecati culpa quia.', 1);
INSERT INTO public.exercises VALUES (30, 2, 'Soluta deserunt explicabo quam.', 3);
INSERT INTO public.exercises VALUES (31, 2, 'Aut quisquam enim.', 2);
INSERT INTO public.exercises VALUES (32, 2, 'Eaque sit corporis.', 0);
INSERT INTO public.exercises VALUES (34, 2, 'Maiores nisi qui ut.', 3);
INSERT INTO public.exercises VALUES (35, 2, 'Autem ipsam cupiditate ut.', 3);
INSERT INTO public.exercises VALUES (36, 1, 'Et aliquam quod sit.', 2);
INSERT INTO public.exercises VALUES (37, 2, 'Dolor molestiae quis ut.', 0);
INSERT INTO public.exercises VALUES (38, 1, 'Quia et est culpa.', 2);
INSERT INTO public.exercises VALUES (39, 1, 'Rerum veritatis facere placeat.', 0);
INSERT INTO public.exercises VALUES (40, 1, 'Expedita consequatur sint corporis.', 2);
INSERT INTO public.exercises VALUES (41, 1, 'qwert', 0);
INSERT INTO public.exercises VALUES (42, 1, 'qwert', 0);
INSERT INTO public.exercises VALUES (43, 1, 'qwert', 0);
INSERT INTO public.exercises VALUES (33, 1, 'Eum non repudiandae.', 3);
INSERT INTO public.exercises VALUES (44, 1, 'Отжимания', 0);


--
-- TOC entry 3411 (class 0 OID 17852)
-- Dependencies: 215
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3406 (class 0 OID 17828)
-- Dependencies: 210
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.migrations VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO public.migrations VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO public.migrations VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO public.migrations VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO public.migrations VALUES (5, '2022_02_07_121512_create_exercises_table', 1);
INSERT INTO public.migrations VALUES (6, '2022_02_10_070850_create_workouts_table', 1);
INSERT INTO public.migrations VALUES (7, '2022_02_25_075749_create_permission_tables', 2);


--
-- TOC entry 3422 (class 0 OID 18007)
-- Dependencies: 226
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3423 (class 0 OID 18018)
-- Dependencies: 227
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.model_has_roles VALUES (1, 'App\Models\User', 1);
INSERT INTO public.model_has_roles VALUES (2, 'App\Models\User', 1);
INSERT INTO public.model_has_roles VALUES (2, 'App\Models\User', 2);


--
-- TOC entry 3409 (class 0 OID 17845)
-- Dependencies: 213
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3419 (class 0 OID 17986)
-- Dependencies: 223
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3413 (class 0 OID 17864)
-- Dependencies: 217
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3424 (class 0 OID 18029)
-- Dependencies: 228
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: demo
--



--
-- TOC entry 3421 (class 0 OID 17997)
-- Dependencies: 225
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.roles VALUES (1, 'role_superadmin', 'web', '2022-02-25 08:05:34', '2022-02-25 08:05:34');
INSERT INTO public.roles VALUES (2, 'role_user', 'web', '2022-02-25 08:05:44', '2022-02-25 08:05:44');


--
-- TOC entry 3408 (class 0 OID 17835)
-- Dependencies: 212
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.users VALUES (1, 'Victor', 'victor@victor.ru', '2022-02-10 11:15:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'P2fmjCe5OGkDq7fP4gXVyiPtMuXxNcuRiYu68zcKhx28HQ9RsXUGdi7iK3qu', '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.users VALUES (2, 'Nastya', 'nastya@victor.ru', '2022-02-10 11:15:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '77PDYUkVWd3vDrCbCzMdEOxUEigRbHyFuRPPaHVX4l10Ye8BAbO716NXeSJz', '2022-02-10 11:15:03', '2022-02-10 11:15:03');


--
-- TOC entry 3417 (class 0 OID 17890)
-- Dependencies: 221
-- Data for Name: workouts; Type: TABLE DATA; Schema: public; Owner: demo
--

INSERT INTO public.workouts VALUES (8, 30, 23, 104, 8, 17, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (9, 14, 158, 24, 10, 5, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (10, 12, 73, 36, 14, 7, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (12, 34, 72, 135, 3, 10, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (14, 28, 99, 82, 1, 4, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (15, 32, 75, 50, 17, 11, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (16, 8, 168, 166, 16, 20, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (17, 37, 167, 149, 10, 1, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (19, 21, 7, 69, 4, 15, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (25, 8, 160, 16, 13, 17, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (27, 14, 189, 45, 3, 1, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (29, 31, 192, 151, 20, 1, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (30, 2, 103, 147, 10, 14, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (31, 35, 66, 127, 7, 14, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (32, 30, 79, 16, 14, 1, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (34, 16, 4, 118, 18, 3, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (35, 20, 149, 12, 14, 9, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (36, 34, 174, 20, 14, 2, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (37, 35, 84, 96, 5, 10, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (39, 8, 178, 122, 3, 15, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (40, 12, 61, 22, 10, 8, '2022-02-10 11:15:03', '2022-02-10 11:15:03');
INSERT INTO public.workouts VALUES (33, 4, 0, 0, 5, 0, '2022-02-10 11:15:03', '2022-02-14 12:37:44');
INSERT INTO public.workouts VALUES (24, 39, 0, 0, 3, 0, '2022-02-10 11:15:03', '2022-02-14 12:39:35');
INSERT INTO public.workouts VALUES (46, 44, 0, 0, 1, 0, '2022-02-14 12:38:04', '2022-02-21 08:10:58');
INSERT INTO public.workouts VALUES (5, 44, 0, 0, 16, 0, '2022-02-10 11:15:03', '2022-02-21 08:11:17');
INSERT INTO public.workouts VALUES (28, 11, 0, 0, 19, 0, '2022-02-10 11:15:03', '2022-02-21 08:11:33');
INSERT INTO public.workouts VALUES (47, 44, 0, 0, 40, 0, '2022-02-21 08:11:50', '2022-02-21 08:11:50');
INSERT INTO public.workouts VALUES (26, 44, 0, 0, 13, 0, '2022-02-10 11:15:03', '2022-02-24 11:39:23');
INSERT INTO public.workouts VALUES (18, 11, 0, 0, 2, 0, '2022-02-10 11:15:03', '2022-02-24 11:39:41');
INSERT INTO public.workouts VALUES (48, 44, 0, 0, 30, 0, '2022-02-24 13:08:44', '2022-02-24 13:08:44');
INSERT INTO public.workouts VALUES (49, 44, 0, 0, 50, 0, '2022-02-24 13:09:03', '2022-02-24 13:09:03');


--
-- TOC entry 3439 (class 0 OID 0)
-- Dependencies: 218
-- Name: exercises_ex_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.exercises_ex_id_seq', 44, true);


--
-- TOC entry 3440 (class 0 OID 0)
-- Dependencies: 214
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 3441 (class 0 OID 0)
-- Dependencies: 209
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.migrations_id_seq', 7, true);


--
-- TOC entry 3442 (class 0 OID 0)
-- Dependencies: 222
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.permissions_id_seq', 1, false);


--
-- TOC entry 3443 (class 0 OID 0)
-- Dependencies: 216
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 27, true);


--
-- TOC entry 3444 (class 0 OID 0)
-- Dependencies: 224
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.roles_id_seq', 2, true);


--
-- TOC entry 3445 (class 0 OID 0)
-- Dependencies: 211
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- TOC entry 3446 (class 0 OID 0)
-- Dependencies: 220
-- Name: workouts_w_id_seq; Type: SEQUENCE SET; Schema: public; Owner: demo
--

SELECT pg_catalog.setval('public.workouts_w_id_seq', 49, true);


--
-- TOC entry 3241 (class 2606 OID 17883)
-- Name: exercises exercises_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.exercises
    ADD CONSTRAINT exercises_pkey PRIMARY KEY (ex_id);


--
-- TOC entry 3232 (class 2606 OID 17860)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3234 (class 2606 OID 17862)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 3225 (class 2606 OID 17833)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3254 (class 2606 OID 18017)
-- Name: model_has_permissions model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- TOC entry 3257 (class 2606 OID 18028)
-- Name: model_has_roles model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- TOC entry 3245 (class 2606 OID 17995)
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- TOC entry 3247 (class 2606 OID 17993)
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- TOC entry 3236 (class 2606 OID 17871)
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- TOC entry 3238 (class 2606 OID 17874)
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- TOC entry 3259 (class 2606 OID 18043)
-- Name: role_has_permissions role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- TOC entry 3249 (class 2606 OID 18006)
-- Name: roles roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- TOC entry 3251 (class 2606 OID 18004)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- TOC entry 3227 (class 2606 OID 17844)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 3229 (class 2606 OID 17842)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3243 (class 2606 OID 17895)
-- Name: workouts workouts_pkey; Type: CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.workouts
    ADD CONSTRAINT workouts_pkey PRIMARY KEY (w_id);


--
-- TOC entry 3252 (class 1259 OID 18010)
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: demo
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);


--
-- TOC entry 3255 (class 1259 OID 18021)
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: demo
--

CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);


--
-- TOC entry 3230 (class 1259 OID 17850)
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: demo
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- TOC entry 3239 (class 1259 OID 17872)
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: demo
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- TOC entry 3260 (class 2606 OID 17884)
-- Name: exercises exercises_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.exercises
    ADD CONSTRAINT exercises_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- TOC entry 3262 (class 2606 OID 18011)
-- Name: model_has_permissions model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 3263 (class 2606 OID 18022)
-- Name: model_has_roles model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 3264 (class 2606 OID 18032)
-- Name: role_has_permissions role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 3265 (class 2606 OID 18037)
-- Name: role_has_permissions role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 3261 (class 2606 OID 17896)
-- Name: workouts workouts_ex_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: demo
--

ALTER TABLE ONLY public.workouts
    ADD CONSTRAINT workouts_ex_id_foreign FOREIGN KEY (ex_id) REFERENCES public.exercises(ex_id);


-- Completed on 2022-02-25 12:08:10

--
-- PostgreSQL database dump complete
--

