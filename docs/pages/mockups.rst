Web pages and their functions
=============================

Sign in
-------

For editing the content of the webpage a privilegized access is needed.
Currently, the webpage manage an administrative role.
The administrator has to sign in into the webpage via the following form:

.. image:: /pages/images/login.png

* ``email``: email address of the administrator
* ``password``: a secret code, as ususal

The webpage shows possible login problems.
After a successful sign in the following menus appear:

* volumes
* authors
* article types
* posts
* files
* rules
* contact

For closing the privilegized session, it is necessary a ``Sign out`` button.

News (Posts)
------------

List the posts (which are available on *News* page)

.. image:: /pages/images/list_posts.png

* The posts are in descending order by date.

Edit the post data:

.. image:: /pages/images/edit_post.png

* The posts are identified by dates.
* The date set automatically on creation but can be edited.
* The posting considered as a rare event, which means that only one post is possible for a given date. (Maximum 1 post per day.)

Edit rules and contact information
----------------------------------

There is a link from the menu to edit the rules:

.. image:: /pages/images/edit_rules.png

The editing of contact information is similar:

.. image:: /pages/images/edit_contact.png

.. warning::
    
    After editing these pages, the previous versions are only available from the backups.

Files
-----

There is a separate page for listing and uploading files:

.. image:: /pages/images/files.png

* The filename is the name of the uploaded file.
* You can get the download link directly from the listing.
* The files are uploaded to the :code:`/files` directory.

.. warning::

    All of the uploaded files become publicly available after uploading! (Regardless of citing links.)

Volume data
-----------

All of the available volumes are listed on the following page:

.. image:: /pages/images/volume_list.png

The volumes are ordered decrementally by volume and number. (Presumably, these pairs are unique.)
After clicking the ``New volume`` button or any of the ``Edit`` links, the following page will appear:

.. image:: /pages/images/edit_volume.png

* The ``cover image`` is an image in PNG format.
* The ``visible`` checkbox is necessary for showing the content on the public page after editing.

The page for listing the articles of the selected volume:

.. image:: /pages/images/volume.png


Article data
------------

All articles are categorized in a specific type. (It is necessary for further filtering.)
The administrator can list and create these types:

.. image:: /pages/images/article_types.png

The creation/editing of a new article type is possible on the following page:

.. image:: /pages/images/edit_article_type.png

* The ``name`` will appear when the administrator create/edit an article.
* The ``description`` is optional. It is needed for the administrator as the description of the type.

.. warning::

    The removation of a type in usage, is not possible.


After selecting an article from the list of articles, the following page will appear:

.. image:: /pages/images/article.png

* It is necessary to upload all of the articles in PDF format.
* The range is checked and can be saved independently.

For editing its title and its abstract (after clicking the ``Edit article data`` button):

.. image:: /pages/images/edit_article.png


Author data
-----------

The data of the contributors (authors and editors) are managed independently from articles:

.. image:: /pages/images/contributor_list.png

* The filter expression is an arbitrary text. In simple cases the webpage apply substring search.
* All contributors should be unique in the database.

For create/edit a contributor:

.. image:: /pages/images/edit_contributor.png


Authorship management
---------------------

Authorship management is necessary, because in some cases (typically) the affiliation or the email address is different for published papers.

.. image:: /pages/images/edit_authorship.png

* The authorship is a binding between the articles and authors.
* The fields on this page is uploaded automatically after the selection of the given author.
* It results that, the author data can be edited independently for public pages, while the references to the same person (and legacy data) will do not break.

Archive page
------------

.. image:: /pages/images/archive.png

* The latest issue is at first.

Editorial Board page
--------------------

* List of names and affiliations

Edit the Editorial Board
------------------------

.. image:: /pages/images/editor_list.png

* This page is available for the administrator.
* The *Create contributor* button opens the *Edit contributor* page.

.. TODO: Define pages for news and its editing for the home page!

