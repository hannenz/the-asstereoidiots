#!/bin/bash
rsync -cave ssh ./ the-asstereoidiots.de:/www/ --exclude=".git*" --exclude="node_modules" --exclude="database.php" --exclude="app/tmp/" --exclude="webroot/src/" --exclude="deploy.sh"
