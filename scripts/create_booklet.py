import json
import os
import sys

from template import render_template


if __name__ == '__main__':
    contents_path = 'volume/contents.json'
    with open(contents_path) as contents_json:
        contents = json.load(contents_json)
    booklet_path = 'volume/booklet.tex'
    tex = render_template('templates', 'booklet.tex', items=contents)
    with open(booklet_path, 'w') as booklet_file:
        booklet_file.write(tex)

