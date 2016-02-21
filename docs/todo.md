TODO:
=====

[Task] We should be able to paginate posts retrived from the tagged module.
       We only display 10 tagged posts at the moment, fix this later.


Contact Module
---------------

When clicking the "Send" button on the contact page, the page sends
the form data to "/mail/contact_me.php". This should either be
overwritten to send to a different controller or we have to make
sure that the "main/contact_me.php" is available to handle the form.

[Task] move database access to a separate component -> DbAccessor.php



DONE (reverse chrono order):
============================

Tagged (Posts) Module
---------------------

This module will list tagged posts if possible.
The urls should look something like:
`dynamiccleanblog.com/tagged/tag1--tag2--tag3/page/1`
MVC tasks
---------
1. Set tags as `$_GET["tag"] `variable (parse tags into an array in controller)
2. Set page number from the clean url (defaults to `/page/1`)
3. List all posts (summaries) that have the specified tags.
   Paginate at 5 posts per page.
4. [OPTIONAL] Create a tag label to display post tags in the "HOME" and "TAGGED" modules.



Page Not Found module
----------------------
Have a page/module to go to for erroneous urls or module addresses.



About Module
-------------
The About module could either be left alone and the about.phtml page
could be updated manually OR we can assign a model to the view through
the AboutController.
Updating the about.phtml page manually is a better option in this case,
given the fact that this page does not need to be dynamic.