#!/usr/bin/env bash

[[ ! -d "tools/php-cs-fixer" ]] && mkdir -p -m 0770 tools/php-cs-fixer
[[ -d "tools/php-cs-fixer" ]] && composer require --with-all-dependencies --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

exit 0
