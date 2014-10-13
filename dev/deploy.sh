#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
lessc "$DIR/../assets/less/application.less" "$DIR/../assets/css/application.css"
lessc "$DIR/../assets/less/admin.less" "$DIR/../assets/css/admin.css"
