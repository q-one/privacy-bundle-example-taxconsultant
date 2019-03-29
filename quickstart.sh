#!/usr/bin/env bash
set -e
trap "docker-compose rm -f -s -v" SIGHUP SIGINT SIGTERM

. .env
docker-compose up -d

echo -n "Waiting for mysql to be ready"
while ! docker-compose exec mysql mysql --protocol TCP -h localhost -u root "-p$MYSQL_ROOT_PASSWORD" -e "show databases;" > /dev/null 2>&1; do
    sleep 1
    echo -n "."
done
echo

docker-compose exec web composer install
docker-compose exec web bin/console doctrine:schema:drop -f
docker-compose exec web bin/console doctrine:schema:create
docker-compose exec web bin/console doctrine:schema:update -f
docker-compose exec web bin/console doctrine:fixtures:load -n

docker-compose logs -f

exit 0
