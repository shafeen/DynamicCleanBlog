Main Database Table Structures
==============================

posts
-----
- id
- title 
- subtitle
- clean_url_title
- body_id (foreign key)
- created 
- modified
- author

post_body
---------
- id
- body_text

images
------
- id
- post_id (foreign key)
- name 
- location (hard drive location)

tags
----
- id 
- tagname

tagged_posts
------------
- post_id (foreign_key)
- tag_id (foreign key)

authors
-------
- id
- name
