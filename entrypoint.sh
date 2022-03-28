#!/usr/bin/env bash
set -e
composer install
exec "$@"