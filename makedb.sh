#!/bin/sh
bin/console propel:sql:build --overwrite
bin/console propel:sql:insert --force
bin/console propel:model:build
composer dump-autoload
mysql -u root -p sil_nti < populate.sql
