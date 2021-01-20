#!/bin/sh

[ "$1" = "test" ] && BD="_test"
psql -h localhost -U adesa80 -d adesa80$BD
