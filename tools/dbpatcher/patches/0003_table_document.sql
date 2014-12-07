
CREATE TABLE document(
    id INT NOT NULL auto_increment,
    owner INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created DATETIME NOT NULL,
    PRIMARY KEY(id)
);
