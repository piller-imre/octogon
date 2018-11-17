import json
import os
import sys

from template import render_template


if __name__ == '__main__':
    if len(sys.argv) != 2:
        raise ValueError('Missing or too many asset path!')
    base_path = sys.argv[1]
    contents_path = os.path.join(base_path, 'assets', 'contents.json')
    with open(contents_path) as contents_json:
        contents = json.load(contents_json)
    booklet_path = os.path.join(base_path, 'booklet.tex')
    tex = render_template('templates', 'booklet.tex', items=contents)
    with open(booklet_path, 'w') as booklet_file:
        booklet_file.write(tex)

