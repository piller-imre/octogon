FROM debian:bullseye
MAINTAINER Imre Piller <piller.imre@gmail.com>
LABEL Description="Octogon"
RUN apt update
RUN apt install -y apache2
RUN apt install -y php php-common
RUN apt install -y libapache2-mod-php
RUN apt install -y php7.4-sqlite3
RUN apt install -y procps bash curl
# RUN rm -rf /var/lib/apt/lists/*
COPY files/start.sh .
COPY files/show_error_log.sh .
ENTRYPOINT ["/bin/bash", "start.sh"]
