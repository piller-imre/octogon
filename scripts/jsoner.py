#
# This scripts converts the contents.py file to contents.json file.
# The file must be next to the contents.py file.
#

import json
from contents import contents

with open('contents.json', 'w') as json_file:
    json.dump(contents, json_file)

