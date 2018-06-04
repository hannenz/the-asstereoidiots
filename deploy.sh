#!/bin/bash
rsync -cave ssh ./ the-asstereoidiots.de:/www/ --exclude-from=".deployignore*"
