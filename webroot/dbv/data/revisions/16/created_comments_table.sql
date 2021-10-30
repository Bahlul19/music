CREATE TABLE comments(
    id INT NOT NULL AUTO_INCREMENT,
    comment VARCHAR(255),
    post_id INT, 
    user_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY(post_id) REFERENCES posts(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);