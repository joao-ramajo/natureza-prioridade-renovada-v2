#!/bin/bash

docker compose down
git fetch origin main
git reset --hard FETCH_HEAD
docker compose -f docker-compose.prod.yaml up -d --build
