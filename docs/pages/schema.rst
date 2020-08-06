Schema of the Data Model
========================

Article data
------------

* ``title``: title of the paper
* ``authors``: list of the authors' names
* ``abstract``: abstract of the paper in LaTeX format
* ``page_start``: number of the first page in the volume
* ``page_end``: number of the last page in the volume
* ``volume_id``: reference to the volume
* ``path``: path of the file for downloading (when available). It worth to organize downloadable files per number.


Volume data
-----------

* ``volume_id``: an integer value, for instance ``28_1``
* ``volume``: volume
* ``number``: number
* ``year``: year of publishing


Author data
-----------

* ``name``: full name of the author
* ``affiliation``: affiliation (university, country, ...)
* ``orcid``: ORCID
* ``homepage``: URL of the homepage of the author
* ``email``: email address

