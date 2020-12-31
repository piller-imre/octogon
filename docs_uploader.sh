#!/bin/bash
rsync -avz docs/_build/html/* imre@mat76.mat.uni-miskolc.hu:/home/imre/public_html/octogon
echo 'http://mat76.mat.uni-miskolc.hu/~imre/octogon/'
