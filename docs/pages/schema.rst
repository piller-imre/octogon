Schema of the Data Model
========================

Relational schema
-----------------

.. image:: /pages/images/schema.png

* The ``authorships`` table always contains any information for which should be displayed on the page. (It causes some redundancy, but makes possible to modify the e-mail address or the affiliation per article.)
* The ``article_type.name`` field is unique.
* The ``documents.name`` field is unique.
* The ``content`` of ``pages`` and ``posts`` cannot be empty.
* The ``articles.title`` cannot be empty.
* The ``authorships.index`` considered only for a given article.
