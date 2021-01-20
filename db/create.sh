#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE adesa80_test;"
    psql -U postgres -c "CREATE USER adesa80 PASSWORD 'adesa80' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists adesa80
    sudo -u postgres dropdb --if-exists adesa80_test
    sudo -u postgres dropuser --if-exists adesa80
    sudo -u postgres psql -c "CREATE USER adesa80 PASSWORD 'adesa80' SUPERUSER;"
    sudo -u postgres createdb -O adesa80 adesa80
    sudo -u postgres psql -d adesa80 -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O adesa80 adesa80_test
    sudo -u postgres psql -d adesa80_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:adesa80:adesa80"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
