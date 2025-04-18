--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-04-18 14:25:55

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 219 (class 1259 OID 16578)
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    nom character varying(100) NOT NULL
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 16651)
-- Name: commande_vinyles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commande_vinyles (
    id integer NOT NULL,
    commande_id integer NOT NULL,
    vinyle_id integer NOT NULL,
    quantite integer NOT NULL
);


ALTER TABLE public.commande_vinyles OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16650)
-- Name: commande_vinyles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commande_vinyles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commande_vinyles_id_seq OWNER TO postgres;

--
-- TOC entry 4902 (class 0 OID 0)
-- Dependencies: 225
-- Name: commande_vinyles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commande_vinyles_id_seq OWNED BY public.commande_vinyles.id;


--
-- TOC entry 224 (class 1259 OID 16643)
-- Name: commandes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commandes (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.commandes OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16642)
-- Name: commandes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commandes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commandes_id_seq OWNER TO postgres;

--
-- TOC entry 4903 (class 0 OID 0)
-- Dependencies: 223
-- Name: commandes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commandes_id_seq OWNED BY public.commandes.id;


--
-- TOC entry 218 (class 1259 OID 16567)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16566)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 4904 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 222 (class 1259 OID 16598)
-- Name: vinyles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vinyles (
    id integer NOT NULL,
    titre character varying(100) NOT NULL,
    description text,
    prix numeric(10,2) NOT NULL,
    image_url text,
    quantite integer DEFAULT 0 NOT NULL,
    categorie_id integer
);


ALTER TABLE public.vinyles OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 16595)
-- Name: vinyles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vinyles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vinyles_id_seq OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16597)
-- Name: vinyles_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vinyles_id_seq1
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vinyles_id_seq1 OWNER TO postgres;

--
-- TOC entry 4905 (class 0 OID 0)
-- Dependencies: 221
-- Name: vinyles_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vinyles_id_seq1 OWNED BY public.vinyles.id;


--
-- TOC entry 4722 (class 2604 OID 16654)
-- Name: commande_vinyles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande_vinyles ALTER COLUMN id SET DEFAULT nextval('public.commande_vinyles_id_seq'::regclass);


--
-- TOC entry 4720 (class 2604 OID 16646)
-- Name: commandes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes ALTER COLUMN id SET DEFAULT nextval('public.commandes_id_seq'::regclass);


--
-- TOC entry 4716 (class 2604 OID 16570)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 4718 (class 2604 OID 16601)
-- Name: vinyles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vinyles ALTER COLUMN id SET DEFAULT nextval('public.vinyles_id_seq1'::regclass);


--
-- TOC entry 4889 (class 0 OID 16578)
-- Dependencies: 219
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, nom) FROM stdin;
1	Rock
2	Jazz
3	Hip-Hop
4	Électro
5	Classique
\.


--
-- TOC entry 4896 (class 0 OID 16651)
-- Dependencies: 226
-- Data for Name: commande_vinyles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commande_vinyles (id, commande_id, vinyle_id, quantite) FROM stdin;
\.


--
-- TOC entry 4894 (class 0 OID 16643)
-- Dependencies: 224
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commandes (id, user_id, created_at) FROM stdin;
\.


--
-- TOC entry 4888 (class 0 OID 16567)
-- Dependencies: 218
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, email, password, created_at) FROM stdin;
15	admin	admin.admin@admin.com	$2y$10$TkusgPOzjDIBPnjE7mnM/.V90pKjKOB4Ymb54WnRWMeAxs5CZF9g6	2025-04-11 11:56:49.827733
20	test2	test2.test2@gmail.com	$2y$10$xuMl1t7RLu0rYVbr7db8Uuxne/MAAvNsKfS5cuYgdaMIB.SwjnZBy	2025-04-14 10:35:46.973738
21	john_doe	john@example.com	hashed_password_1	2025-04-14 10:40:48.932896
23	alice_wonder	alice@example.com	hashed_password_3	2025-04-14 10:40:48.932896
24	bob_martin	bob@example.com	hashed_password_4	2025-04-14 10:40:48.932896
28	Simon	simon.hanot@bhc.be	$2y$10$rPCqPjZ.DoiPzbS2N4.Bqe8asWC86MRCl0DRC5dNZEUUK9IZT6kZa	2025-04-18 14:23:33.510706
\.


--
-- TOC entry 4892 (class 0 OID 16598)
-- Dependencies: 222
-- Data for Name: vinyles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vinyles (id, titre, description, prix, image_url, quantite, categorie_id) FROM stdin;
47	Electro Album 2	Vinyle de Electro	16.99	https://pngimg.com/d/vinyl_PNG95.png	22	4
50	Jazz Album 9	Vinyle de Jazz	25.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	10	2
52	HipHop Album 4	Vinyle de HipHop	19.99	https://pngimg.com/d/vinyl_PNG102.png	15	3
53	Jazz Album 4	Vinyle de Jazz	24.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	15	2
54	Rock Album 5	Vinyle de Rock	20.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	18	1
55	Electro Album 5	Vinyle de Electro	17.99	https://pngimg.com/d/vinyl_PNG95.png	20	4
56	Jazz Album 10	Vinyle de Jazz	24.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	8	2
57	Classical Album 4	Vinyle de Classique	30.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	10	5
58	HipHop Album 5	Vinyle de HipHop	20.99	https://pngimg.com/d/vinyl_PNG102.png	8	3
59	Electro Album 4	Vinyle de Electro	18.99	https://pngimg.com/d/vinyl_PNG95.png	15	4
60	Classical Album 2	Vinyle de Classique	27.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	12	5
61	Rock Album 4	Vinyle de Rock	18.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	22	1
62	Jazz Album 7	Vinyle de Jazz	21.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	8	2
63	Classical Album 3	Vinyle de Classique	28.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	15	5
64	Rock Album 2	Vinyle de Rock	17.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	30	1
65	Electro Album 3	Vinyle de Electro	15.99	https://pngimg.com/d/vinyl_PNG95.png	10	4
66	Classical Album 6	Vinyle de Classique	32.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	18	5
67	Jazz Album 1	Vinyle de Jazz	19.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	10	2
68	Rock Album 6	Vinyle de Rock	21.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	24	1
69	Jazz Album 2	Vinyle de Jazz	21.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	8	2
70	Electro Album 6	Vinyle de Electro	18.99	https://pngimg.com/d/vinyl_PNG95.png	22	4
71	HipHop Album 2	Vinyle de HipHop	18.99	https://pngimg.com/d/vinyl_PNG102.png	10	3
72	Classical Album 7	Vinyle de Classique	34.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	12	5
73	Jazz Album 3	Vinyle de Jazz	23.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	6	2
74	Electro Album 7	Vinyle de Electro	19.99	https://pngimg.com/d/vinyl_PNG95.png	18	4
75	Rock Album 7	Vinyle de Rock	22.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	15	1
45	Classical Album 5	Vinyle de Classique	26.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	12	5
49	Jazz Album 5	Vinyle de Jazz	19.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	11	2
51	Rock Album 3	Vinyle de Rock	19.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	24	1
46	Rock Album 1	Vinyle de Rock	15.99	https://static.vecteezy.com/system/resources/previews/001/206/675/non_2x/rock-music-icon-vinyl-record-png.png	19	1
43	Jazz Album 6	Vinyle de Jazz	22.99	https://www.jazzrecordsbarcelona.com/wp-content/uploads/2020/11/barcelona-jazz_vinyl.png	5	2
48	Classical Album 1	Vinyle de Classique	25.99	https://png.pngtree.com/png-vector/20250326/ourmid/pngtree-retro-vinyl-record-with-classic-black-finish-png-image_15865587.png	5	5
\.


--
-- TOC entry 4906 (class 0 OID 0)
-- Dependencies: 225
-- Name: commande_vinyles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commande_vinyles_id_seq', 131, true);


--
-- TOC entry 4907 (class 0 OID 0)
-- Dependencies: 223
-- Name: commandes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commandes_id_seq', 56, true);


--
-- TOC entry 4908 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 28, true);


--
-- TOC entry 4909 (class 0 OID 0)
-- Dependencies: 220
-- Name: vinyles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vinyles_id_seq', 20, true);


--
-- TOC entry 4910 (class 0 OID 0)
-- Dependencies: 221
-- Name: vinyles_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vinyles_id_seq1', 75, true);


--
-- TOC entry 4730 (class 2606 OID 16582)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- TOC entry 4736 (class 2606 OID 16656)
-- Name: commande_vinyles commande_vinyles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande_vinyles
    ADD CONSTRAINT commande_vinyles_pkey PRIMARY KEY (id);


--
-- TOC entry 4734 (class 2606 OID 16649)
-- Name: commandes commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id);


--
-- TOC entry 4724 (class 2606 OID 16577)
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- TOC entry 4726 (class 2606 OID 16573)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 4728 (class 2606 OID 16575)
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- TOC entry 4732 (class 2606 OID 16606)
-- Name: vinyles vinyles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vinyles
    ADD CONSTRAINT vinyles_pkey PRIMARY KEY (id);


--
-- TOC entry 4739 (class 2606 OID 16657)
-- Name: commande_vinyles commande_vinyles_commande_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande_vinyles
    ADD CONSTRAINT commande_vinyles_commande_id_fkey FOREIGN KEY (commande_id) REFERENCES public.commandes(id) ON DELETE CASCADE;


--
-- TOC entry 4740 (class 2606 OID 16662)
-- Name: commande_vinyles commande_vinyles_vinyle_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande_vinyles
    ADD CONSTRAINT commande_vinyles_vinyle_id_fkey FOREIGN KEY (vinyle_id) REFERENCES public.vinyles(id) ON DELETE CASCADE;


--
-- TOC entry 4741 (class 2606 OID 16672)
-- Name: commande_vinyles fk_commande_vinyles_commande; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande_vinyles
    ADD CONSTRAINT fk_commande_vinyles_commande FOREIGN KEY (commande_id) REFERENCES public.commandes(id) ON DELETE CASCADE;


--
-- TOC entry 4738 (class 2606 OID 16667)
-- Name: commandes fk_commandes_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT fk_commandes_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 4737 (class 2606 OID 16607)
-- Name: vinyles vinyles_categorie_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vinyles
    ADD CONSTRAINT vinyles_categorie_id_fkey FOREIGN KEY (categorie_id) REFERENCES public.categories(id);


-- Completed on 2025-04-18 14:25:56

--
-- PostgreSQL database dump complete
--

