#!/bin/bash
docker run -it \
-p 80:80 \
--mount type=bind,source="$(pwd)"/../server,target=/var/www/html \
imre/octogon-dev /bin/bash
