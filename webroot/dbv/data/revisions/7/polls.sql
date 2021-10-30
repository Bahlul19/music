CREATE TABLE polls(

    id INT(11) NOT NULL AUTO_INCREMENT,
    question_id INT, 
    answer_id INT,
    user_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (question_id) REFERENCES questions(id),
    FOREIGN KEY (answer_id) REFERENCES answers(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);