CREATE TABLE answers(

    id INT(11) NOT NULL AUTO_INCREMENT,
    answer VARCHAR(255),
    question_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (question_id) REFERENCES questions(id)
);