DROP TABLE IF EXISTS users;
CREATE TABLE users(
  username VARCHAR(50) PRIMARY KEY,
  password VARCHAR(100) NOT NULL,
  additional_email VARCHAR(100),
  phone VARCHAR(20)
  name VARCHAR(20)
);

INSERT INTO users(username, password, additional_email, phone) VALUES ('waph_team08', md5('Pa$$w0rd'), 'example@example.com', '1234567890');
INSERT INTO users(username, password, additional_email, phone) VALUES ('test', md5('test'), NULL, NULL);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts(
  postID VARCHAR(100) INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  content VARCHAR(100),
  posttime VARCHAR(100),
  owner VARCHAR(100),
  FOREIGN KEY (owner) REFERENCES users (username) ON DELETE CASCADE
);

INSERT INTO posts(postID, title, content, posttime, owner) VALUES ('1', 'First Post', 'This is the content of the first post.', NOW(), 'waph_team08');
INSERT INTO posts(postID, title, content, posttime, owner) VALUES ('2', 'Second Post', 'This is the content of the second post.', NOW(), 'waph_team08');


CREATE TABLE comments (
    commentID INT AUTO_INCREMENT PRIMARY KEY,
    postID INT,
    commenter VARCHAR(50),
    comment TEXT,
    comment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (postID) REFERENCES posts(postID),
    FOREIGN KEY (commenter) REFERENCES users(username)
);
