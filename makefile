THIS_FILE := $(lastword $(MAKEFILE_LIST))

.PHONY: all run rabbitmq hyperf kafka redis minio mongodb zookeeper postgresql clickhouse

all: hyperf rabbitmq kafka redis minio mongodb zookeeper postgresql clickhouse

run: hyperf mongodb redis

hyperf:
	docker-compose --env-file ./.env -f ./docker-compose.yml up -d

kafka:
	docker-compose --env-file ./.env -f ./docker/kafka/docker-compose.yml up -d

redis:
	docker-compose --env-file ./.env -f ./docker/redis/docker-compose.yml up -d

minio:
	docker-compose --env-file ./.env -f ./docker/minio/docker-compose.yml up -d

mongodb:
	docker-compose --env-file ./.env -f ./docker/mongodb/docker-compose.yml up -d

zookeeper:
	docker-compose --env-file ./.env -f ./docker/zookeeper/docker-compose.yml up -d

postgresql:
	docker-compose --env-file ./.env -f ./docker/postgresql/docker-compose.yml up -d

clickhouse:
	docker-compose --env-file ./.env -f ./docker/clickhouse/docker-compose.yml up -d

rabbitmq:
	docker-compose --env-file ./.env -f ./docker/rabbitmq/docker-compose.yml up -d
