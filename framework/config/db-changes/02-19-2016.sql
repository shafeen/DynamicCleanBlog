INSERT INTO tags (tagname)
VALUES ('command-line');

-- tagging posts with the tag 'command-line'
INSERT INTO codingitreal.tagged_posts(post_id, tag_id)
VALUES
  (2, 3),
  (3, 3),
  (4, 3);