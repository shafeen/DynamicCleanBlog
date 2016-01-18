_**TODO:**_

Tagged (Posts) Module
---------------------

This module will list tagged posts if possible.
The urls should look something like:

`dynamiccleanblog.com/tagged/tag1--tag2--tag3/page/1`


**MVC tasks:**

1. Set tags as `$_GET["tag"] `variable (parse tags into an array in controller)
2. Set page number from the clean url (defaults to `/page/1`)
3. List all posts (summaries) that have the specified tags.
   Paginate at 5 posts per page.
4. [OPTIONAL] Create a tag label to display post tags in the "HOME" and "TAGGED" modules.


**How to handle DB Changes**

1. Use a simple naming scheme when making db_changes.
   For example: if you are making a change on 5th May 2016,
   place all your sql in a .sql file and name that file
   05-05-2016.sql and place that file under "framework/config/db_changes/"
