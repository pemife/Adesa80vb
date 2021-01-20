#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U adesa80 -d adesa80 < $BASE_DIR/adesa80.sql
fi
psql -h localhost -U adesa80 -d adesa80_test < $BASE_DIR/adesa80.sql
