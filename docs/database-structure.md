Main Database Table Structures
==============================

posts [x]
-----
- id
- title 
- subtitle
- clean_url_title
- post_body_id (foreign key)
- created 
- modified
- author

post_body [x]
---------
- id
- body_text

images
------
- id
- post_id (foreign key)
- name 
- location (hard drive location)

tags [x]
----
- id 
- tagname

tagged_posts [x]
------------
- post_id (foreign_key)
- tag_id (foreign key)

authors [x]
-------
- id
- name
