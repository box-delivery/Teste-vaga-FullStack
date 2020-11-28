#!/usr/bin/env bash

set -o errexit
set -o pipefail
docker-compose --project-name box \
		up --detach \
		--force-recreate \
		--build \
		--remove-orphans
echo "Created box movies api"
