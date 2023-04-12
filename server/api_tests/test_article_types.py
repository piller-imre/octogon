"""
Article type endpoint tests
"""

import json
import unittest

import requests


class ArticleTypesTest(unittest.TestCase):

    def test_collect_unauthenticated(self):
        ...

    def test_collect_empty(self):
        with prepare_test_context('empty'):
            req = {}
            # TODO: Perform a login and use the token in the header!
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            self.assertEqual([], resp.json())

    def test_collect_multiple(self):
        ...

    def test_get_successful(self):
        ...

    def test_get_invalid_request(self):
        ...

    def test_get_missing_id(self):
        ...

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_missing_name(self):
        ...

    def test_create_existing_name(self):
        ...

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        ...

    def test_update_invalid_request(self):
        ...

    def test_update_missing_type_id(self):
        ...

    def test_update_missing_name(self):
        ...

    def test_update_existing_name(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_missing_id(self):
        ...

    def test_remove_in_use(self):
        ...

