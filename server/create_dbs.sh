#!/bin/sh

echo 'Prepare the directory for test databases ...'
rm -rf test_dbs 2> /dev/null
mkdir test_dbs

echo 'Create empty database ...'
rm empty.db 2> /dev/null
sqlite3 empty.db < schema.sql
chmod 666 empty.db
mv empty.db test_dbs/empty.db

echo 'Create demo database ...'
rm demo.db 2> /dev/null
sqlite3 demo.db < schema.sql
sqlite3 demo.db < demo.sql
chmod 666 demo.db
mv demo.db test_dbs/demo.db

echo '[OK]'
