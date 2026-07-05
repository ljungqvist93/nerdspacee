#!/usr/bin/env bash
# Convert a MySQL/MariaDB dump to SQLite-compatible SQL.
# Usage: ./mysql2sqlite.sh < mariadb_dump.sql | sqlite3 target.db

sed -e 's/^[[:space:]]*--.*$//g' \
    -e 's/\/\*![0-9]*.*\*\///g' \
    -e 's/\/\*.*\*\///g' \
    -e 's/`//g' \
    -e 's/ ENGINE=[^ ]*//g' \
    -e 's/ AUTO_INCREMENT=[0-9]*//g' \
    -e 's/ DEFAULT CHARSET=[^;]*//g' \
    -e 's/ COLLATE=[^ ]*//g' \
    -e 's/ CHARACTER SET [^ ]*//g' \
    -e 's/ UNSIGNED//g' \
    -e 's/ on update current_timestamp(\\?)/ /ig' \
    -e 's/\\r\\n/\\n/g' \
    -e 's/\\r/\\n/g' \
    -e 's/BOOL/INTEGER/ig' \
    -e 's/TINYINT(1)/INTEGER/ig' \
    -e 's/INT([0-9]\+)/INTEGER/ig' \
    -e 's/DOUBLE([0-9, ]*)/REAL/ig' \
    -e 's/FLOAT([0-9, ]*)/REAL/ig' \
    -e 's/DECIMAL([0-9, ]*)/REAL/ig' \
    -e 's/DATETIME/TEXT/ig' \
    -e 's/TIMESTAMP/TEXT/ig' \
    -e 's/ENUM([^)]*)/TEXT/ig' \
    -e 's/SET([^)]*)/TEXT/ig' \
    -e 's/\\0/\\x00/g' \
    -e 's/^LOCK TABLES.*;/BEGIN;/' \
    -e 's/^UNLOCK TABLES;/COMMIT;/' \
    -e 's/^DROP TABLE IF EXISTS /DROP TABLE IF EXISTS /' \
| awk '
/^CREATE TABLE/ { increate=1 }
increate==1 { 
  gsub(/, *KEY [^,]*\([^;]*\)/,""); 
  gsub(/, *UNIQUE KEY [^,]*\([^;]*\)/,""); 
}
increate==1 && /\);/ { increate=0 }
{ print }
' \
| sed -e 's/\\\"/"/g' -e 's/\\\047/\047/g'
