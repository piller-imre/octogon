"""
Posts endpoint tests
"""

import json
import unittest

import requests


class PostsTest(unittest.TestCase):

    def test_collect_successful(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_get_successful(self):
        ...

    def test_get_invalid_request(self):
        ...

    def test_get_invalid_post_id(self):
        ...

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_missing_content(self):
        ...

    def test_create_missing_date(self):
        ...

    def test_create_invalid_date_format(self):
        ...

    def test_create_nonsense_date(self):
        ...

    def test_create_existing_date(self):
        ...

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        ...

    def test_update_invalid_request(self):
        ...

    def test_update_missing_content(self):
        ...

    def test_update_missing_date(self):
        ...

    def test_update_invalid_date_format(self):
        ...

    def test_update_nonsense_date(self):
        ...

    def test_update_existing_date(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_post_id(self):
        ...

