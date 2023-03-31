-- cat schema.sql demo.sql | sqlite3 demo.db

INSERT INTO users
(id, email, password)
VALUES
(1, 'admin@octogon.com', 'nothing');

INSERT INTO article_types
(id, name, description)
VALUES
(1, 'research', 'Research paper'),
(2, 'competition', 'Mathematical competition'),
(3, 'proposed problems', 'Some proposed problems');

INSERT INTO volumes
(id, volume, number, year, month, cover_image, is_visible)
VALUES
(1, 18, 1, 2010,  4, 'cover_2010_1.png', 1),
(2, 18, 2, 2010, 10, 'cover_2010_2.png', 1),
(3, 19, 1, 2011,  4, 'cover_2011_1.png', 1),
(4, 19, 2, 2011, 10, 'cover_2011_2.png', 0),
(5, 20, 1, 2012,  4, 'cover_2012_1.png', 0);

INSERT INTO documents
(id, name, upload_date)
VALUES
(1, 'Wildt_2010_1.pdf', '2023-03-20'),
(2, 'PP_2010_1.pdf', '2023-03-21'),
(3, 'OQ_2010_1.pdf', '2023-03-22'),
(4, 'PP_2010_2.pdf', '2023-03-24'),
(5, 'OQ_2010_2.pdf', '2023-03-25');

INSERT INTO contributors
(id, given_name, family_name, affiliation, email)
VALUES
(1, 'Mihály', 'Bencze', 'Sacele-Négyfalu, Brasov, Romania', 'benczemihaly@octogon.com'),
(2, 'Zhao', 'Changjian', 'China Jiliang University, Hangzhou, China', 'zhao@octogon.com'),
(3, 'José Luis', 'Díaz-Barrero', 'Universitat Politechnica de Catalunya, Barcelona, Spain', 'barrero@octogon.com'),
(4, 'Sever S.', 'Dragomir', 'Victoria University, Melbourne, Australia', 'dragomir@octogon.com'),
(5, 'Péter', 'Körtesi', 'University of Miskolc, Miskolc, Hungary', 'pkortesi@octogon.com'),
(6, 'Ovodiu T.', 'Pop', 'National College Mihai Eminescu, Satu Mare, Romania', 'pop@octogon.com');

INSERT INTO articles
(id, article_type_id, title, abstract, volume_id, first_page, last_page, document_id)
VALUES
(1, 1, 'A new research paper', 'Some abstract here.', 1, 1, 10, NULL),
(2, 1, 'The second research paper', 'Other abstract here.', 1, 11, 15, NULL),
(3, 1, 'The third research paper', 'Further abstract here.', 1, 16, 22, NULL),
(4, 2, 'Wildt competition', 'Math. Competition', 1, 23, 34, 1),
(5, 3, 'Proposed problems', 'Many problems', 1, 35, 40, 2),
(6, 1, 'First in second volume', 'Nothing special', 2, 1, 12, NULL),
(7, 1, 'Second in second volume', 'Still nothing special', 2, 13, 19, NULL),
(8, 3, 'Proposed problems', 'Exciting problems', 2, 20, 33, 4),
(9, 1, 'A new one', 'Without authors', 3, 1, 50, NULL);

INSERT INTO authorships
(id, article_id, contributor_id, indx, given_name, family_name, affiliation, email)
VALUES
(1, 1, 1, 1, 'Mihály', 'Bencze', 'Brasov', 'benczemihaly@gmail.com'),
(2, 2, 2, 1, 'Zhao', 'Changjian', 'China', 'zhao@octogon.com'),
(3, 2, 3, 2, 'José Luis', 'Díaz-Barrero', 'Spain', 'barrero@octogon.com'),
(4, 3, 5, 1, 'Péter', 'Körtesi', 'Hungary', 'matkp@uni-miskolc.hu'),
(5, 4, 1, 1, 'Mihály', 'Bencze', 'Brasov', 'benczemihaly@gmail.com'),
(6, 5, 4, 1, 'Sever S.', 'Dragomir', 'Australia', 'dragomir@octogon.com'),
(7, 6, 5, 1, 'Péter', 'Körtesi', 'Hungary', 'matkp@uni-miskolc.hu'),
(8, 6, 1, 2, 'Mihály', 'Bencze', 'Brasov', 'benczemihaly@gmail.com'),
(9, 6, 6, 3, 'Ovidiu T.', 'Pop', 'Satu Mare, Romania', 'pop@satumare.ro'),
(10, 7, 4, 1, 'Sever S.', 'Dragomir', 'Australia', 'dragomir@octogon.com'),
(11, 8, 1, 1, 'Mihály', 'Bencze', 'Brasov', 'benczemihaly@gmail.com');

INSERT INTO editors
(id, contributor_id, indx)
VALUES
(1, 5, 2),
(2, 6, 4),
(3, 2, 3),
(4, 3, 1);

INSERT INTO pages
(name, content, upload_date)
VALUES
('rules', 'Some rules here', '2023-03-28'),
('contacts', 'Contact me here', '2023-03-29');

INSERT INTO posts
(id, content, upload_date)
VALUES
(1, 'Oldest post', '2010-02-03'),
(2, 'Second post', '2018-10-12'),
(3, 'Third post', '2022-04-20'),
(4, 'Latest post', '2023-03-30');

