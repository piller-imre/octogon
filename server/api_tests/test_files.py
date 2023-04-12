"""
Files endpoint tests
"""

import json
import unittest

import requests


class FilesTest(unittest.TestCase):

    def test_upload_unauthenticated(self):
        ...

    def test_upload_successful(self):
        ...

    def test_upload_invalid_request(self):
        ...

    def test_upload_existing_file(self):
        ...

    def test_upload_empty_file(self):
        ...

    def test_upload_too_large(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_name(self):
        ...

