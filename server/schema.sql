-- sqlite3 octogon.db < schema.sql

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL,
    password TEXT NOT NULL
);

CREATE TABLE article_types (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL DEFAULT ''
);

CREATE TABLE volumes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    volume INTEGER NOT NULL,
    number INTEGER NOT NULL,
    year INTEGER NOT NULL,
    month INTEGER NOT NULL,
    cover_image TEXT NOT NULL,
    is_visible INTEGER NOT NULL
);

CREATE TABLE documents (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    upload_date TEXT NOT NULL
);

CREATE TABLE articles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    article_type_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    abstract TEXT NOT NULL DEFAULT '',
    volume_id INTEGER NOT NULL,
    first_page INTEGER NOT NULL,
    last_page INTEGER NOT NULL,
    document_id INTEGER DEFAULT NULL,
    FOREIGN KEY(article_type_id) REFERENCES article_types(id),
    FOREIGN KEY(volume_id) REFERENCES volumes(id),
    FOREIGN KEY(document_id) REFERENCES documents(id)
);

CREATE TABLE contributors (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    given_name TEXT NOT NULL,
    family_name TEXT NOT NULL,
    affiliation TEXT NOT NULL,
    email TEXT NOT NULL
);

CREATE TABLE authorships (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    article_id INTEGER NOT NULL,
    contributor_id INTEGER NOT NULL,
    indx INTEGER NOT NULL,
    given_name TEXT NOT NULL,
    family_name TEXT NOT NULL,
    affiliation TEXT NOT NULL,
    email TEXT NOT NULL,
    FOREIGN KEY(article_id) REFERENCES articles(id),
    FOREIGN KEY(contributor_id) REFERENCES contributors(id)
);

CREATE TABLE editors (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    contributor_id INTEGER NOT NULL,
    indx INTEGER NOT NULL,
    FOREIGN KEY(contributor_id) REFERENCES contributors(id)
);

CREATE TABLE pages (
    name TEXT NOT NULL,
    content TEXT NOT NULL,
    upload_date TEXT NOT NULL
);

CREATE TABLE posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    upload_date TEXT NOT NULL
);
