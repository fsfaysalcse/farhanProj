CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    quantity INT NOT NULL
);
INSERT INTO books (title, author, quantity) VALUES ('The Great Gatsby', 'F. Scott Fitzgerald', 5);
INSERT INTO books (title, author, quantity) VALUES ('To Kill a Mockingbird', 'Harper Lee', 8);
INSERT INTO books (title, author, quantity) VALUES ('1984', 'George Orwell', 10);
INSERT INTO books (title, author, quantity) VALUES ('Pride and Prejudice', 'Jane Austen', 6);
INSERT INTO books (title, author, quantity) VALUES ('The Catcher in the Rye', 'J.D. Salinger', 4);
