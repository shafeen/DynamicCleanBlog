INSERT INTO tags(tagname)
VALUES ('draft');

INSERT INTO tagged_posts(post_id, tag_id)
VALUES (1, 1), (2, 2), (3, 2), (4, 2);